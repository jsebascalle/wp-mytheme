<?php
/**
 *
 * @package Mytheme
 * @since MyTheme 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * Tell WordPress to run  'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'mytheme_setup' );

if ( ! function_exists( 'newtheme_setup' ) ):
 
function mytheme_setup() {
 
	add_editor_style();

	add_theme_support( 'automatic-feed-links' );

	register_nav_menu( 'primary', __( 'Primary Menu', 'mytheme' ) );

	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	add_theme_support( 'post-thumbnails' );

	//set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );
	//add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
	//add_image_size( 'small-feature', 500, 300 );
}
 endif;


	/**
	 * Sets the post excerpt length to 40 words.
	 *
	 * To override this length in a child theme, remove the filter and add your own
	 * function tied to the excerpt_length filter hook.
	 */
	function excerpt_length( $length ) {
		return 40;
	}
	add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

	/**
	 * Returns a "Continue Reading" link for excerpts
	 */
	function continue_reading_link() {
		return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'newtheme' ) . '</a>';
	}

	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and newtheme_continue_reading_link().
	 *
	 * To override this in a child theme, remove the filter and add your own
	 * function tied to the excerpt_more filter hook.
	 */
	function auto_excerpt_more( $more ) {
		return ' &hellip;' . continue_reading_link();
	}
	add_filter( 'excerpt_more', 'newtheme_auto_excerpt_more' );

	/**
	 * Adds a pretty "Continue Reading" link to custom post excerpts.
	 *
	 * To override this link in a child theme, remove the filter and add your own
	 * function tied to the get_the_excerpt filter hook.
	 */
	function custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= continue_reading_link();
		}
		return $output;
	}
	add_filter( 'get_the_excerpt', 'custom_excerpt_more' );
	/**
	 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	 */
	function page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
	add_filter( 'wp_page_menu_args', 'page_menu_args' );



/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since MyTheme 1.0
 */
function widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar 1', 'toolbox' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Sidebar 2', 'toolbox' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional second sidebar area', 'toolbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'init', 'widgets_init' );

 
if ( ! function_exists( 'content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function content_nav( $nav_id ) {
	global $wp_query;
 
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'mytheme' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'mytheme' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mytheme' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // newtheme_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @return string|bool URL or false when no link is present.
 */
function url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;
 
	return esc_url_raw( $matches[1] );
}

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 */
function body_classes( $classes ) {
 
	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';
 
	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';
 
	return $classes;
}
add_filter( 'body_class', 'body_classes' );

/*OTRAS FUNCIONES UTILES*/

/**
 * mostrar las imágenes miniatura en el RSS
 */

function rss_post_thumbnail($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
	$content = '<p>' . get_the_post_thumbnail($post->ID) .
	'</p>' . get_the_content();
	}
	return $content;
}
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');

/**
 * Puedes añadir tu logo al panel de administración, justo al lado del enlace hacia el blog en la parte superior izquierda, añadiendo el siguiente código al archivo functions.php:
 */
//add_action('admin_head', 'logo_admin');
function logo_admin() {
	echo '
	<style type="text/css">
	#header-logo { background-image: url('.get_bloginfo('template_directory').'/assets/img/custom-logo.gif) !important; }
	</style>
	';
}

/**
 * Si quieres eliminar los widgets por defecto de WordPress como Enlaces, Archivos, Calendario, etc, solo debes añadir el siguiente código al archivo functions.php:
 */
function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	//unregister_widget('WP_Widget_Search');
	//unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	//unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	//unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

/**
 * Desbloquear botones útiles en el editor visual
 */

function habilitar_mas_botones($buttons) {
	$buttons[] = 'hr';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[] = 'styleselect';
	return $buttons;
}
add_filter("mce_buttons_3", "habilitar_mas_botones");

/**
 *  Permitir más etiquetas HTML en el editor HTML de WordPress
 */

function cambiar_opciones_mce($initArray) {
	$ext = 'pre[id|name|class|style],iframe[align|longdesc| name|width|height|frameborder|scrolling|marginheight| marginwidth|src]';

	if ( isset( $initArray['extended_valid_elements'] ) ) {
	$initArray['extended_valid_elements'] .= ',' . $ext;
	} else {
	$initArray['extended_valid_elements'] = $ext;
	}

	return $initArray;
}
add_filter('tiny_mce_before_init', 'cambiar_opciones_mce');

/**
 * Paginación de artículos sin necesidad de un plugin
 */

function pagination($prev = '«', $next = '»') {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$pagination = array(
	'base' => @add_query_arg('paged','%#%'),
	'format' => '',
	'total' => $wp_query->max_num_pages,
	'current' => $current,
	'prev_text' => __($prev),
	'next_text' => __($next), 'type' => 'plain'
	);
	if( $wp_rewrite->using_permalinks() )
	$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	if( !empty($wp_query->query_vars['s']) )
	$pagination['add_args'] = array( 's' => get_query_var( 's' ) ); echo paginate_links( $pagination );
}

/*uso:<div class="pagination"><?php pagination('»', '«');?></div>*/


/**
 * Eliminar contenido de wp_head()
 */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

add_filter('the_generator','killVersion');
function killVersion() { return ''; }
remove_action('wp_head', 'wp_generator');


/**
 *  Obtener el número de visitas de un artículo sin plugin
 * 
 * Loop single.php:    setPostViews(get_the_ID());
 * 
 * para ver: echo getPostViews(get_the_ID());
 * 
 */


function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
	delete_post_meta($postID, $count_key);
	add_post_meta($postID, $count_key, '0');
	return "0 View";
	}
	return $count.' Views';
}


function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
	$count = 0;
	delete_post_meta($postID, $count_key);
	add_post_meta($postID, $count_key, '0');
	}else{
	$count++;
	update_post_meta($postID, $count_key, $count);
	}
}

/**
 * Theme Options
 */
include_once( 'includes/theme-options.php' );

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );