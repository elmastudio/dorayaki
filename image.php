<?php
/**
 * The template for displaying image attachments.
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */

get_header(); ?>

	<div id="main-wrap">
		<div id="site-content">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">
					<div class="entry-details">
					<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
						<?php
								$metadata = wp_get_attachment_metadata();
								printf( __( '<div>at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s px</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a></div>', 'dorayaki' ),
									esc_attr( get_the_date( 'c' ) ),
									esc_html( get_the_date() ),
									esc_url( wp_get_attachment_url() ),
									$metadata['width'],
									$metadata['height'],
									esc_url( get_permalink( $post->post_parent ) ),
									esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
									get_the_title( $post->post_parent )
								);
							?>
						<div class="entry-edit"><?php edit_post_link(__( 'Edit', 'dorayaki') ); ?></div>
						<div class="entry-cats"><?php the_category(); ?></div>
					</div><!--end .entry-details -->
				<h1 class="entry-title"><?php the_title(); ?></h1>
		
			</header><!--end .entry-header -->

			<div class="entry-content clearfix">

				<div class="attachment">
<?php
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
	 */
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
						<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php
							$attachment_size = apply_filters( 'theme_attachment_size', 1180 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1180 ) ); // filterable image width with 1200px limit for image height.
						?></a>

						<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</div><!-- .attachment -->
				</div><!-- .entry-content -->

		</article><!-- #post-<?php the_ID(); ?> -->

		<?php comments_template(); ?>

		<nav id="nav-image" class="clearfix">
			<div class="nav-previous"><?php previous_image_link( '%link', __( '<span>Previous</span>', 'dorayaki' )); ?></div>
			<div class="nav-next"><?php next_image_link(  '%link', __( '<span>Next</span>', 'dorayaki' ) ); ?></div>
		</nav><!-- #image-nav -->

		</div><!-- end #site-content -->

		<?php get_sidebar(); ?>

	</div><!-- end #main-wrap -->

<?php get_footer(); ?>