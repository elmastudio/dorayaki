<?php
/**
 * The template for displaying standard pages with sidebar.
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */

get_header(); ?>

	<div id="main-wrap">
		<div id="site-content">

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- end #site-content -->

		<?php get_sidebar(); ?>

	</div><!-- end #main-wrap -->

<?php get_footer(); ?>