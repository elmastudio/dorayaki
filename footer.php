<?php
/**
* The template for displaying the footer.
*
* @package Dorayaki
* @since Dorayaki 1.0
*/
?>

 <footer id="colophon" class="site-footer clearfix" role="contentinfo">

		 <?php
			 /* Include the footer widgets. */
			 if ( ! is_404() )
				 get_sidebar( 'footer' );
		 ?>

	 <div id="site-info">

		 <div class="credit-wrap">
		 <?php if (has_nav_menu( 'optional' ) ) {
			 wp_nav_menu( array('theme_location' => 'optional', 'container' => 'nav' , 'container_class' => 'footer-nav', 'depth' => 1 ));}
		 ?>

		 <?php
			 $options = get_option('dorayaki_theme_options');
			 if($options['custom_footertext'] != '' ){
				 echo ('<p class="credittext">');
				 echo stripslashes($options['custom_footertext']);
				 echo ('</p>');
		 } else { ?>
		 <ul class="credit">
			 <li>&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?></li>
			 <?php
				 /* Include Privacy Policy link. */
				 if ( function_exists( 'the_privacy_policy_link' ) ) {
				 the_privacy_policy_link( '<li>', '</li>', 'dorayaki');
				 }
			 ?>
			 <li><?php _e('Proudly powered by', 'dorayaki') ?> <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dorayaki' ) ); ?>" ><?php _e('WordPress', 'dorayaki') ?></a></li>
			 <li><?php printf( __( 'Theme: %1$s by %2$s', 'dorayaki' ), 'Dorayaki', '<a href="https://www.elmastudio.de/en/" title="Elmastudio WordPress Themes">Elmastudio</a>' ); ?></li>
		 </ul><!-- end .credit -->
		 <?php } ?>
		 </div><!-- end .credit-wrap -->

		 <div class="footerlabel">
			 <p class="footerlabel-title"><?php bloginfo( 'name' ); ?></p>
			 <p class="footerlabel-description"><?php bloginfo( 'description' ); ?></p>
		 </div><!-- end .footerlabel -->

	 </div><!-- end #site-info -->

 </footer><!-- end #colophon -->

<?php wp_footer(); ?>

</body>
</html>
