<?php
	global $time_start;

	$time_start = microtime(true);
	
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/bootstrap.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/bootstrap-responsive.css" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
<?php wp_head(); 
	$options = get_option('wpb_options');
	
	if(strlen($options['headcode']) > 0) {
		echo $options['headcode'];
	}
?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
<?php do_action( 'before' ); ?>
		<div class="navbar navbar-fixed-top">
  			<div class="navbar-inner">
    			<div class="container">
      				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
      				</a>
 
      				<!-- Be sure to leave the brand out there if you want it shown -->
      				<a class="brand" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
 
      				<!-- Everything you want hidden at 940px or less, place within here -->
      				<div class="nav-collapse">
      					<ul class="nav">
 							<li<?php if(is_home()) { ?> class="active"<?php } ?>><a href="<?php echo home_url( '/' ); ?>">Home</a></li>						
						</ul>
						<?php if(current_user_can('manage_options')) { ?>
      					<ul class="nav pull-right">
 							<li><a href="<?php echo home_url( '/' ); ?>wp-admin/">Admin Interface</a></li>						
						</ul>						
						<?php } ?>      					
        				<form class="navbar-search pull-right"action="<?php echo home_url( '/' ); ?>" method="get" class="form-search">
  							<input type="text" class="search-query" placeholder="Search" value="<?php the_search_query(); ?>" name="s" id="search">
						</form>
      				</div>
 
    			</div>
  			</div>
		</div>
		
		<div class="container">
			<div class="content">
				<div class="page-header">
					<h1><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	if(is_search()) {
		printf( __( 'Search Results for: %s', 'toolbox' ), '<span>' . get_search_query() . '</span>' );
	} else {
		if(is_tag()) echo "Tag Archive: ";
		if(is_category()) echo "Category Archive: ";  
	
		wp_title( '', true, 'right' );
	
		// Add the blog name.
		if(is_home() || is_front_page()) bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );
	}

	?></h1>
				</div>
				<div class="row">