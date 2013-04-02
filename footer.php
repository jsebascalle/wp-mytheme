<?php
/**
 * The template for displaying the footer.
 *
 * @package mytheme
 * @since mytheme 0.1
 */
?>
<footer class="container">
	<p>
	<?php
		global $time_start;
		$time_end = microtime(true);
		$time = $time_end - $time_start;
		echo "Executed in " . round($time, 3) . " seconds.";
		
		$default_options = array('copytxt' => '&copy; ' . date('Y') . ": " .  get_bloginfo('name'));
		$options = get_option('wpb_options', $default_options);
		
		if(strlen($options['copytxt']) > 0) {
			echo " | ";
			echo $options['copytxt'];
		}
	?>
	</p>
</footer>
<?php wp_footer(); ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-ui-1.10.0.custom.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js" type="text/javascript"></script>
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
<script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
</body>
</html>