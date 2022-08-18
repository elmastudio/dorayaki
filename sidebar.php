<?php
/**
 * The Sidebar containing the widget areas.
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="sidebar" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #sidebar .widget-area -->
	<?php endif; ?>