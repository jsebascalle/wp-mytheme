<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

	<div id="primary">
		<div id="content" role="main" class="span8">

			<article id="post-0" class="post error404 not-found">
				<div class="entry-content">
					<img src="<?php echo get_template_directory_uri(); ?>/img/holdoutprogrammer.png" style="margin-left: 275px;" /><br /><br />
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'toolbox' ); ?></p>

					<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-search" style="margin-left: 312px;">
						<div class="input-append">
							<input type="text" class="span5 search-query" value="<?php the_search_query(); ?>" name="s" id="search" >
							<button type="submit" class="btn btn-inverse"><i class="icon-search icon-white" style="margin-left: -6px;"></i>&nbsp;Search</button>
						</div>
					</form>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<div class="widget">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'toolbox' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>

					<?php
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . __( 'Alternatively, you can try looking in the monthly archives:', 'toolbox' ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=0', "after_title=</h2>$archive_content" );
					?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>