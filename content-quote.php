<?php
/**
 * The template for displaying posts in the Quote Post Format
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
	</header><!--end .entry-header -->
			
	<div class="entry-content clearfix">
		<?php if ( has_post_thumbnail() ): ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
		<?php endif; ?>
		
		<?php the_content('<span class="morelink-icon">Read more</span>', 'dorayaki' ); ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'dorayaki' ), 'after' => '</div>' ) ); ?>
	</div><!-- end .entry-content -->

	<footer class="entry-meta clearfix">
		<?php if ( comments_open() ) : ?>
			<div class="entry-comments">
				<?php comments_popup_link( '<span class="leave-reply">' . __( '0 comments', 'dorayaki' ) . '</span>', __( '1 comment', 'dorayaki' ), __( '% comments', 'dorayaki' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>
	</footer><!-- end .entry-meta -->

</article><!-- end post -<?php the_ID(); ?> -->