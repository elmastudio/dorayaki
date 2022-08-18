<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */

get_header(); ?>

	<div id="main-wrap">
		<div id="site-content" class="fullwidth">
			
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- end #site-content .fullwidth -->
	</div><!-- end #main-wrap -->

<?php get_footer(); ?>