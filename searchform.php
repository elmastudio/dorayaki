<?php
/**
 * Template for displaying the search forms
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Type to Search', 'dorayaki' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'dorayaki' ); ?>" />
	</form>