<?php
/**
 * The Footer widget areas.
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */
?>

<?php
	/* Check if any of the footer widget areas have widgets.
	 *
	 * If none of the footer widget areas have widgets, let's bail early.
	 */
	if (   ! is_active_sidebar( 'sidebar-footer-1' )
		&& ! is_active_sidebar( 'sidebar-footer-2' )
		&& ! is_active_sidebar( 'sidebar-footer-3' )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>
<div id="footerwidget-wrap" class="clearfix">
	<?php if ( is_active_sidebar( 'sidebar-footer-1' ) ) : ?>
	<div id="sidebar-footer-1" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
	</div><!-- .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) : ?>
	<div id="sidebar-footer-2" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
	</div><!-- .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) : ?>
	<div id="sidebar-footer-3" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
	</div><!-- .widget-area -->
	<?php endif; ?>

</div><!-- #footer-widget-wrap -->