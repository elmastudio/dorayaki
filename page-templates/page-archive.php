<?php
/**
 * Template Name: Archive Page Template
 * Description: An archive page template
 *
 * @package Dorayaki 
 * @since Dorayaki 1.0
 */

get_header(); ?>

	<div id="main-wrap">
		<div id="site-content">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- end .entry-header -->

			<div class="entry-content clearfix">
				<h3><?php _e('Filter by Tags', 'dorayaki') ?></h3>
				<div class="archive-tags clearfix">
					<?php wp_tag_cloud('orderby=count&number=30'); ?> 
				</div><!-- end .archive-tags -->

				<h3><?php _e('The Latest 30 Posts', 'dorayaki') ?></h3>
				<ul class="latest-posts-list">
					<?php wp_get_archives('type=postbypost&limit=30'); ?>  
				</ul><!-- end .latest-posts-list -->

				<h3><?php _e('The Monthly Archive', 'dorayaki') ?></h3>
				<ul class="monthly-archive-list">
					<?php wp_get_archives('type=monthly'); ?>  
				</ul><!-- end .monthly-archive-list -->
			</div><!-- end .entry-content -->

		</article><!-- end post-<?php the_ID(); ?> -->

		</div><!-- end #site-content -->

		<?php get_sidebar(); ?>

	</div><!-- end #main-wrap -->

<?php get_footer(); ?>
