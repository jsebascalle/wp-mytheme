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
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
			echo ' | ' . sprintf( __( 'Page %s', 'mytheme' ), max( $paged, $page ) );

		?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <!--CSS -->
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap-responsive.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/jquery-ui-1.10.0.custom.css">
        <!--SCRIPTS -->
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		
		<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); 
			$options = get_option('wpb_options');
			
			if(strlen($options['headcode']) > 0) {
				echo $options['headcode'];
			}
		?>
		
    </head>
<body <?php body_class(); ?>>
	<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
<header id="header" class="hfeed container">
<?php do_action( 'before' ); ?>
	<div class="row-fluid">
		<div id="header-content" class="span12">
			<hgroup>
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
		</div>
	</div>
</header><!--Fin header-->
<nav class="container">
	<div class="navbar ">
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
    				<form class="navbar-search pull-right"action="<?php echo home_url( '/' ); ?>" method="get" class="form-search">
							<input type="text" class="search-query" placeholder="Search" value="<?php the_search_query(); ?>" name="s" id="search">
					</form>
  				</div>

			</div>
		</div>
	</div>
</nav><!--Fin nav-->
