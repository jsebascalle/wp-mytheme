<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?>
			</div>
		</div>

		<footer>
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
	</div><!-- #container -->

<?php wp_footer(); ?>
</body>
</html>