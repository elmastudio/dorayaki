<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="entry-details">
			<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
			<div class="entry-author"><span><?php _e('by', 'dorayaki') ?></span>
				<?php
					printf( __( '<a href="%1$s" title="%2$s">%3$s</a>', 'dorayaki' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					sprintf( esc_attr__( 'All posts by %s', 'dorayaki' ), get_the_author() ),
					get_the_author() );
				?>
			</div>
			<div class="entry-edit"><?php edit_post_link(__( 'Edit', 'dorayaki') ); ?></div>
			<div class="entry-cats"><?php the_category(); ?></div>
		</div><!--end .entry-details -->
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!--end .entry-header -->

	<div class="entry-content clearfix">
		<?php if ( has_post_thumbnail() ): ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
		<?php endif; ?>

		<?php the_content(); ?>	
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'dorayaki' ), 'after' => '</div>' ) ); ?>
	</div><!-- end .entry-content -->
	

		<?php if ( get_post_format() ) : // Show author bio only for standard post format posts ?>	
			<?php else: ?>
			<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
		<div class="author-info">
					<h3><?php printf( __( 'Author: %s', 'dorayaki' ), "<a href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='author'>" . get_the_author() . "</a>" ); ?></h3>
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'dorayaki_author_bio_avatar_size', 60 ) ); ?>
					<p class="author-description"><?php the_author_meta( 'description' ); ?></p>	
			</div><!-- end .author-info -->
			<?php endif; ?>
				<?php endif; ?>

	<footer class="entry-meta clearfix">
		<?php $tags_list = get_the_tag_list(); 
		if ( $tags_list ): ?>
		<div class="entry-tags"><span><?php _e('Tags', 'dorayaki') ?></span> <?php the_tags( '', '', '' ); ?></div>
		<?php endif; // get_the_tag_list() ?>
	</footer><!-- end .entry-meta -->

</article><!-- end .post-<?php the_ID(); ?> -->
