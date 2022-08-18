<?php
/**
 * The template for displaying 404 error pages.
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */

get_header(); ?>

	<div id="main-wrap">
		<div id="site-content" class="fullwidth">

			<article id="post-0" class="page error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Not Found', 'dorayaki' ); ?></h1>
				</header><!--end .entry-header -->

				<div class="entry-content clearfix">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'dorayaki' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- end .entry-content -->
			</article><!-- end #post-0 -->

		</div><!-- end #site-content .fullwidth -->
		
		<?php get_sidebar(); ?>

	</div><!-- end #main-wrap -->

<?php get_footer(); ?>