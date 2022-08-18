<?php
/**
 * Template Name: Centered Page Template, No Sidebar
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */

get_header(); ?>

	<div id="main-wrap" class="no-sidebar">
		<div id="site-content">
			
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- end #site-content -->
	</div><!-- end #main-wrap .no-sidebar -->

<?php get_footer(); ?>