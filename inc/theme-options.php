<?php
/**
 * Dorayaki Theme Options
 *
 * @package WordPress
 * @subpackage Dorayaki
 * @since Dorayaki 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Properly enqueue styles and scripts for our theme options page.
/*
/* This function is attached to the admin_enqueue_scripts action hook.
/*
/* @param string $hook_suffix The action passes the current page to the function.
/* We don't do anything if we're not on our theme options page.
/*-----------------------------------------------------------------------------------*/

function dorayaki_admin_enqueue_scripts( $hook_suffix ) {
	if ( $hook_suffix != 'appearance_page_theme_options' )
		return;

	wp_enqueue_style( 'dorayaki-theme-options', get_template_directory_uri() . '/inc/theme-options.css', false, '2013-07-28' );
	wp_enqueue_script( 'dorayaki-theme-options', get_template_directory_uri() . '/inc/theme-options.js', array( 'farbtastic' ), '2013-07-28' );
	wp_enqueue_style( 'farbtastic' );
}
add_action( 'admin_enqueue_scripts', 'dorayaki_admin_enqueue_scripts' );

/*-----------------------------------------------------------------------------------*/
/* Register the form setting for our dorayaki_options array.
/*
/* This function is attached to the admin_init action hook.
/*
/* This call to register_setting() registers a validation callback, dorayaki_theme_options_validate(),
/* which is used when the option is saved, to ensure that our option values are complete, properly
/* formatted, and safe.
/*
/* We also use this function to add our theme option if it doesn't already exist.
/*-----------------------------------------------------------------------------------*/

function dorayaki_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === dorayaki_get_theme_options() )
		add_option( 'dorayaki_theme_options', dorayaki_get_default_theme_options() );

	register_setting(
		'dorayaki_options',       // Options group, see settings_fields() call in theme_options_render_page()
		'dorayaki_theme_options', // Database option, see dorayaki_get_theme_options()
		'dorayaki_theme_options_validate' // The sanitization callback, see dorayaki_theme_options_validate()
	);
}
add_action( 'admin_init', 'dorayaki_theme_options_init' );


/*-----------------------------------------------------------------------------------*/
/* Add our theme options page to the admin menu.
/*
/* This function is attached to the admin_menu action hook.
/*-----------------------------------------------------------------------------------*/

function dorayaki_theme_options_add_page() {
	add_theme_page(
		__( 'Theme Options', 'dorayaki' ), // Name of page
		__( 'Theme Options', 'dorayaki' ), // Label in menu
		'edit_theme_options',                  // Capability required
		'theme_options',                       // Menu slug, used to uniquely identify the page
		'theme_options_render_page'            // Function that renders the options page
	);
}
add_action( 'admin_menu', 'dorayaki_theme_options_add_page' );


/*-----------------------------------------------------------------------------------*/
/* Returns the default options for Dorayaki
/*-----------------------------------------------------------------------------------*/

function dorayaki_get_default_theme_options() {
	$default_theme_options = array(
		'bg_color'   => '#f4f4f4',
		'boxesbg_color'   => '#ffffff',
		'headerbg_color'   => '#ffffff',
		'footerbg_color'   => '#92dadd',
		'link_color'   => '#92dadd',
		'linkhover_color'   => '#2aa3b2',
		'headerwidgetbg_color'   => '#92dadd',
		'custom_logo' => '',
		'custom_footertext' => '',
		'custom_favicon' => '',
		'custom_apple_icon' => '',
		'show-excerpt' => '',
		'share-posts' => '',
		'share-singleposts' => '',
		'use-slider' => '',
		'slider_color' => '#3f3f3f',
		'custom-css' => '',
	);

	return apply_filters( 'dorayaki_default_theme_options', $default_theme_options );
}

/*-----------------------------------------------------------------------------------*/
/* Returns the options array for Dorayaki
/*-----------------------------------------------------------------------------------*/

function dorayaki_get_theme_options() {
	return get_option( 'dorayaki_theme_options' );
}

/*-----------------------------------------------------------------------------------*/
/* Returns the options array for Dorayaki
/*-----------------------------------------------------------------------------------*/

function theme_options_render_page() {
	?>
	<div class="wrap">
		<h2><?php printf( __( '%s Theme Options', 'dorayaki' ), wp_get_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'dorayaki_options' );
				$options = dorayaki_get_theme_options();
				$default_options = dorayaki_get_default_theme_options();
			?>

			<table class="form-table">
			<h3 style="margin-top:30px;"><?php _e( 'Custom Colors', 'dorayaki' ); ?></h3>

				<tr valign="top"><th scope="row"><?php _e( 'Main Background Color', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Main Background Color', 'dorayaki' ); ?></span></legend>
							 <input type="text" name="dorayaki_theme_options[bg_color]" value="<?php echo esc_attr( $options['bg_color'] ); ?>" id="bg-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none; " id="colorpicker5"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your main background color, the default background color is: %s. Do not forget to include the # before the color value.', 'dorayaki' ), $default_options['bg_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Boxes Background Color', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Boxes Background Color', 'dorayaki' ); ?></span></legend>
							 <input type="text" name="dorayaki_theme_options[boxesbg_color]" value="<?php echo esc_attr( $options['boxesbg_color'] ); ?>" id="boxesbg-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;" id="colorpicker6"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose a custom background color for the white background boxes. The default boxes background color value is: %s.', 'dorayaki' ), $default_options['boxesbg_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Header Background Color', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Header Background Color', 'dorayaki' ); ?></span></legend>
							 <input type="text" name="dorayaki_theme_options[headerbg_color]" value="<?php echo esc_attr( $options['headerbg_color'] ); ?>" id="headerbg-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;" id="colorpicker7"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your header background color, the default header background color value is: %s.', 'dorayaki' ), $default_options['headerbg_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Footer Background Color', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Footer Background Color', 'dorayaki' ); ?></span></legend>
							 <input type="text" name="dorayaki_theme_options[footerbg_color]" value="<?php echo esc_attr( $options['footerbg_color'] ); ?>" id="footerbg-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;" id="colorpicker2"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your footer background color, the default color is: %s.', 'dorayaki' ), $default_options['footerbg_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Link Color', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Link Color', 'dorayaki' ); ?></span></legend>
							 <input type="text" name="dorayaki_theme_options[link_color]" value="<?php echo esc_attr( $options['link_color'] ); ?>" id="link-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;" id="colorpicker1"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your link color, the default link color is: %s.', 'dorayaki' ), $default_options['link_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Text Link Hover Color', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Text Link Hover Color', 'dorayaki' ); ?></span></legend>
							 <input type="text" name="dorayaki_theme_options[linkhover_color]" value="<?php echo esc_attr( $options['linkhover_color'] ); ?>" id="linkhover-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;" id="colorpicker3"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your text link hover color, the default link hover color is: %s.', 'dorayaki' ), $default_options['linkhover_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Header Info Background Color', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Header Info Background Color', 'dorayaki' ); ?></span></legend>
							 <input type="text" name="dorayaki_theme_options[headerwidgetbg_color]" value="<?php echo esc_attr( $options['headerwidgetbg_color'] ); ?>" id="headerwidgetbg-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;" id="colorpicker4"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your header widget background color, the default color is: %s.', 'dorayaki' ), $default_options['headerwidgetbg_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>
				</table>

				<table class="form-table">
				<h3 style="margin-top:30px;"><?php _e( 'Custom Logo, Post Excerpts and Footer Text', 'dorayaki' ); ?></h3>
				<tr valign="top"><th scope="row"><?php _e( 'Logo Image', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Logo Image', 'dorayaki' ); ?></span></legend>
							<input class="regular-text" type="text" name="dorayaki_theme_options[custom_logo]" value="<?php echo esc_attr( $options['custom_logo'] ); ?>" />
						<br/><label class="description" for="dorayaki_theme_options[custom_logo]"><?php _e('Upload your own logo image using the ', 'dorayaki'); ?><a href="<?php echo home_url(); ?>/wp-admin/media-new.php" target="_blank"><?php _e('WordPress Media Uploader', 'dorayaki'); ?></a><?php _e('. Then copy your logo image file URL and insert the URL here.', 'dorayaki'); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Post Excerpts', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Post Excerpts', 'dorayaki' ); ?></span></legend>
							<input id="dorayaki_theme_options[show-excerpt]" name="dorayaki_theme_options[show-excerpt]" type="checkbox" value="1" <?php checked( '1', $options['show-excerpt'] ); ?> />
							<label class="description" for="dorayaki_theme_options[show-excerpt]"><?php _e( 'Check this box to show automatic post excerpts. With this option you will not need to add the more tag in posts.', 'dorayaki' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Footer Credit Text', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Footer Credit Text', 'dorayaki' ); ?></span></legend>
							<textarea id="dorayaki_theme_options[custom_footertext]" class="small-text" cols="100" rows="2" name="dorayaki_theme_options[custom_footertext]"><?php echo esc_textarea( $options['custom_footertext'] ); ?></textarea>
						<br/><label class="description" for="dorayaki_theme_options[custom_footertext]"><?php _e( 'Customize the footer credit text. Standard HTML is allowed.', 'dorayaki' ); ?></label>
						</fieldset>
					</td>
				</tr>

				</table>

				<table class="form-table">

				<h3 style="margin-top:30px;"><?php _e( 'Favicon and Apple Touch Icon', 'dorayaki' ); ?></h3>

				<tr valign="top"><th scope="row"><?php _e( 'Custom Favicon', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom Favicon', 'dorayaki' ); ?></span></legend>
							<input class="regular-text" type="text" name="dorayaki_theme_options[custom_favicon]" value="<?php echo esc_attr( $options['custom_favicon'] ); ?>" />
						<br/><label class="description" for="dorayaki_theme_options[custom_favicon]"><?php _e( 'Create a <strong>16x16px</strong> image and generate a .ico favicon using a favicon online generator. Then upload your favicon to your themes folder (via FTP) and enter your Favicon URL here (the URL path should be similar to: yourdomain.com/wp-content/themes/dorayaki/favicon.ico).', 'dorayaki' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Custom Apple Touch Icon', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom Apple Touch Icon', 'dorayaki' ); ?></span></legend>
							<input class="regular-text" type="text" name="dorayaki_theme_options[custom_apple_icon]" value="<?php echo esc_attr( $options['custom_apple_icon'] ); ?>" />
						<br/><label class="description" for="dorayaki_theme_options[custom_apple_icon]"><?php _e('Create a <strong>128x128px png</strong> image for your webclip icon. Upload your image using the ', 'dorayaki'); ?><a href="<?php echo home_url(); ?>/wp-admin/media-new.php" target="_blank"><?php _e('WordPress Media Uploader', 'dorayaki'); ?></a><?php _e('. Now copy the image file URL and insert the URL here.', 'dorayaki'); ?></label>
						</fieldset>
					</td>
				</tr>

				</table>

				<table class="form-table">

				<h3 style="margin-top:30px;"><?php _e( 'Share Buttons', 'dorayaki' ); ?></h3>

				<tr valign="top"><th scope="row"><?php _e( 'Share option for posts', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Share option for posts', 'dorayaki' ); ?></span></legend>
							<input id="dorayaki_theme_options[share-posts]" name="dorayaki_theme_options[share-posts]" type="checkbox" value="1" <?php checked( '1', $options['share-posts'] ); ?> />
							<label class="description" for="dorayaki_theme_options[share-posts]"><?php _e( 'Check this box to include share buttons (for Twitter, Facebook, Google+) on your blogs front page and on single post pages.', 'dorayaki' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Share option on single posts only', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Share option on single posts only', 'dorayaki' ); ?></span></legend>
							<input id="dorayaki_theme_options[share-singleposts]" name="dorayaki_theme_options[share-singleposts]" type="checkbox" value="1" <?php checked( '1', $options['share-singleposts'] ); ?> />
							<label class="description" for="dorayaki_theme_options[share-singleposts]"><?php _e( 'Check this box to include the share post buttons <strong>only</strong> on single posts (below the post content).', 'dorayaki' ); ?></label>
						</fieldset>
					</td>
				</tr>
				</table>

				<table class="form-table">

				<h3 style="margin-top:30px;"><?php _e( 'Responsive Slider', 'dorayaki' ); ?></h3>

				<tr valign="top"><th scope="row"><?php _e( 'Include Responsive Slider', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Include Responsive Slider', 'dorayaki' ); ?></span></legend>
							<input id="dorayaki_theme_options[use-slider]" name="dorayaki_theme_options[use-slider]" type="checkbox" value="1" <?php checked( '1', $options['use-slider'] ); ?> />
							<label class="description" for="dorayaki_theme_options[use-slider]"><?php _e( 'Check this box to automatically include the Responsive Slider on your front page (You need to install and activate the Responsive Slider WordPress plugin first).', 'dorayaki' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Slider Background Color', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Slider Background Color', 'dorayaki' ); ?></span></legend>
							 <input type="text" name="dorayaki_theme_options[slider_color]" value="<?php echo esc_attr( $options['slider_color'] ); ?>" id="slider-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none; " id="colorpicker8"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your slider background color, the default background color is: %s.', 'dorayaki' ), $default_options['slider_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

			</table>

			<table class="form-table">

				<h3 style="margin-top:30px;"><?php _e( 'Custom CSS', 'dorayaki' ); ?></h3>

				<tr valign="top"><th scope="row"><?php _e( 'Include Custom CSS', 'dorayaki' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Include Custom CSS', 'dorayaki' ); ?></span></legend>
							<textarea id="dorayaki_theme_options[custom-css]" class="small-text" style="font-family: monospace;" cols="120" rows="10" name="dorayaki_theme_options[custom-css]"><?php echo esc_textarea( $options['custom-css'] ); ?></textarea>
						<br/><label class="description" for="dorayaki_theme_options[custom-css]"><?php _e( 'Include custom CSS styles, use !important to overwrite existing styles.', 'dorayaki' ); ?></label>
						</fieldset>
					</td>
				</tr>

				</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/*-----------------------------------------------------------------------------------*/
/* Sanitize and validate form input. Accepts an array, return a sanitized array.
/*-----------------------------------------------------------------------------------*/

function dorayaki_theme_options_validate( $input ) {
	global $layout_options, $font_options;

	// custom color must be 3 or 6 hexadecimal characters
	if ( isset( $input['bg_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['bg_color'] ) )
			$output['bg_color'] = '#' . strtolower( ltrim( $input['bg_color'], '#' ) );

	if ( isset( $input['boxesbg_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['boxesbg_color'] ) )
			$output['boxesbg_color'] = '#' . strtolower( ltrim( $input['boxesbg_color'], '#' ) );

	if ( isset( $input['headerbg_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['headerbg_color'] ) )
			$output['headerbg_color'] = '#' . strtolower( ltrim( $input['headerbg_color'], '#' ) );

	if ( isset( $input['link_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['link_color'] ) )
			$output['link_color'] = '#' . strtolower( ltrim( $input['link_color'], '#' ) );

	if ( isset( $input['linkhover_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['linkhover_color'] ) )
			$output['linkhover_color'] = '#' . strtolower( ltrim( $input['linkhover_color'], '#' ) );

	if ( isset( $input['footerbg_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['footerbg_color'] ) )
			$output['footerbg_color'] = '#' . strtolower( ltrim( $input['footerbg_color'], '#' ) );

	if ( isset( $input['headerwidgetbg_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['headerwidgetbg_color'] ) )
			$output['headerwidgetbg_color'] = '#' . strtolower( ltrim( $input['headerwidgetbg_color'], '#' ) );

	if ( isset( $input['slider_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['slider_color'] ) )
			$output['slider_color'] = '#' . strtolower( ltrim( $input['slider_color'], '#' ) );

	// Text options must be safe text with no HTML tags
	$input['custom_logo'] = wp_filter_nohtml_kses( $input['custom_logo'] );
	$input['custom_favicon'] = wp_filter_nohtml_kses( $input['custom_favicon'] );
	$input['custom_apple_icon'] = wp_filter_nohtml_kses( $input['custom_apple_icon'] );

	// checkbox values are either 0 or 1
	if ( ! isset( $input['share-posts'] ) )
		$input['share-posts'] = null;
	$input['share-posts'] = ( $input['share-posts'] == 1 ? 1 : 0 );

	if ( ! isset( $input['share-singleposts'] ) )
		$input['share-singleposts'] = null;
	$input['share-singleposts'] = ( $input['share-singleposts'] == 1 ? 1 : 0 );

	if ( ! isset( $input['show-excerpt'] ) )
		$input['show-excerpt'] = null;
	$input['show-excerpt'] = ( $input['show-excerpt'] == 1 ? 1 : 0 );

	if ( ! isset( $input['use-slider'] ) )
		$input['use-slider'] = null;
	$input['use-slider'] = ( $input['use-slider'] == 1 ? 1 : 0 );

	return $input;
}

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current main background color.
/*-----------------------------------------------------------------------------------*/
function dorayaki_print_bg_color_style() {
	$options = dorayaki_get_theme_options();
	$bg_color = $options['bg_color'];

	$default_options = dorayaki_get_default_theme_options();

	// Don't do anything if the current background color is the default.
	if ( $default_options['bg_color'] == $bg_color )
		return;
?>
<style type="text/css">
/* Custom Main Background Color */
body, .page .entry-content h2 span {background: <?php echo $bg_color; ?>;}
</style>
<?php
}
add_action( 'wp_head', 'dorayaki_print_bg_color_style' );

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current boxes background color.
/*-----------------------------------------------------------------------------------*/
function dorayaki_print_boxesbg_color_style() {
	$options = dorayaki_get_theme_options();
	$boxesbg_color = $options['boxesbg_color'];

	$default_options = dorayaki_get_default_theme_options();

	// Don't do anything if the current boxes background color is the default.
	if ( $default_options['boxesbg_color'] == $boxesbg_color )
		return;
?>
<style type="text/css">
/* Custom Box Background Color */
ul.dorayaki-rp li.rp-box,
.portfolio-box,
.testimonial-box .t-text,
.testimonial-box .t-text-right,
.team-box .tm-quote,
div.wpcf7 {background: <?php echo $boxesbg_color; ?>;}
.testimonial-box .t-text:before,
.testimonial-box .t-text-right:before,
.team-box .tm-quote:before {color: <?php echo $boxesbg_color; ?>;}
</style>
<?php
}
add_action( 'wp_head', 'dorayaki_print_boxesbg_color_style' );

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current header background color.
/*-----------------------------------------------------------------------------------*/
function dorayaki_print_headerbg_color_style() {
	$options = dorayaki_get_theme_options();
	$headerbg_color = $options['headerbg_color'];

	$default_options = dorayaki_get_default_theme_options();

	// Don't do anything if the current header background color is the default.
	if ( $default_options['headerbg_color'] == $headerbg_color )
		return;
?>
<style type="text/css">
/* Custom Header Background Color */
#masthead {background: <?php echo $headerbg_color; ?>;}
@media screen and (min-width: 1260px) {#site-nav {background: <?php echo $headerbg_color; ?>;}}
</style>
<?php
}
add_action( 'wp_head', 'dorayaki_print_headerbg_color_style' );

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current footer background color.
/*-----------------------------------------------------------------------------------*/
function dorayaki_print_footerbg_color_style() {
	$options = dorayaki_get_theme_options();
	$footerbg_color = $options['footerbg_color'];

	$default_options = dorayaki_get_default_theme_options();

	// Don't do anything if the current  footer background color is the default.
	if ( $default_options['footerbg_color'] == $footerbg_color )
		return;
?>
<style type="text/css">
/* Custom Footer Bg Color */
.footerlabel {color: <?php echo $footerbg_color; ?>;}
#colophon {background: <?php echo $footerbg_color; ?>;}
</style>
<?php
}
add_action( 'wp_head', 'dorayaki_print_footerbg_color_style' );

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current link color.
/*-----------------------------------------------------------------------------------*/
function dorayaki_print_link_color_style() {
	$options = dorayaki_get_theme_options();
	$link_color = $options['link_color'];

	$default_options = dorayaki_get_default_theme_options();

	// Don't do anything if the current link color is the default.
	if ( $default_options['link_color'] == $link_color )
		return;
?>
<style type="text/css">
/* Custom Link Color */
a,
.entry-header h2.entry-title a:hover,
.responsive-slider.flexslider .slide h2.slide-title a:hover,
input#submit:hover,
input.wpcf7-submit:hover,
.format-link a.link:hover,
ul.dorayaki-rp li.rp-box h3.rp-title a:hover,
.responsive-slider.flexslider .slide h2.slide-title span,
.portfolio-box h3.portfolio-title a:hover,
.widget h3.widget-title a:hover,
.search-btn-open:before,
.menu-btn-open:before,
#site-nav li a:hover,
a.more-link:hover,
.morelink-icon:hover:after,
#comments .comment-content ul.comment-meta a:hover,
.contact-box .cb-emails span,
a#desktop-search-btn.btn-open:after {
	color: <?php echo $link_color; ?>;
}
.search-btn-open,
.menu-btn-open,
input[type="button"]:hover,
input[type="submit"]:hover,
.jetpack_subscription_widget input[type="submit"]:hover,
input#submit:hover,
input.wpcf7-submit:hover,
.contact-box a.cb-maplink:hover,
.entry-content p.slogan a:hover,
a.service-box:hover,
a#desktop-search-btn:hover,
a#desktop-search-btn.btn-open {
	background: <?php echo $link_color; ?>;
}
.responsive-slider.flexslider .flex-control-nav li a:hover {
	border: 1px solid <?php echo $link_color; ?>;
	background: <?php echo $link_color; ?> !important;
}
#site-title {
	border-top: 5px solid <?php echo $link_color; ?>;
}
.search-btn-open,
.menu-btn-open {
	border-top: 1px solid <?php echo $link_color; ?> !important;
	border-bottom: 1px solid <?php echo $link_color; ?> !important;
}
@media screen and (min-width: 1260px) {
#site-nav li:hover > a {
	color: <?php echo $link_color; ?>;
}
}
</style>
<?php
}
add_action( 'wp_head', 'dorayaki_print_link_color_style' );

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current link hover color.
/*-----------------------------------------------------------------------------------*/
function dorayaki_print_linkhover_color_style() {
	$options = dorayaki_get_theme_options();
	$linkhover_color = $options['linkhover_color'];

	$default_options = dorayaki_get_default_theme_options();

	// Don't do anything if the current link hover color is the default.
	if ( $default_options['linkhover_color'] == $linkhover_color )
		return;
?>
<style type="text/css">
/* Custom Link Hover Color */
a:hover {color:<?php echo $linkhover_color; ?>;}
</style>
<?php
}
add_action( 'wp_head', 'dorayaki_print_linkhover_color_style' );

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current header widget background color.
/*-----------------------------------------------------------------------------------*/
function dorayaki_print_headerwidgetbg_color_style() {
	$options = dorayaki_get_theme_options();
	$headerwidgetbg_color = $options['headerwidgetbg_color'];

	$default_options = dorayaki_get_default_theme_options();

	// Don't do anything if the current header widget background color is the default.
	if ( $default_options['headerwidgetbg_color'] == $headerwidgetbg_color )
		return;
?>
<style type="text/css">
/* Custom Header Widget Bg Color */
#masthead ul.headerinfo-text li span {background: <?php echo $headerwidgetbg_color; ?>;}
</style>
<?php
}
add_action( 'wp_head', 'dorayaki_print_headerwidgetbg_color_style' );


/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current slider background color.
/*-----------------------------------------------------------------------------------*/
function dorayaki_print_slider_color_style() {
	$options = dorayaki_get_theme_options();
	$slider_color = $options['slider_color'];

	$default_options = dorayaki_get_default_theme_options();

	// Don't do anything if the current slider background color is the default.
	if ( $default_options['slider_color'] == $slider_color )
		return;
?>
<style type="text/css">
/* Custom Slider Bg Color */
.header-slider {background: <?php echo $slider_color; ?>;}
</style>
<?php
}
add_action( 'wp_head', 'dorayaki_print_slider_color_style' );


/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for custom css styles.
/*
/* This function is attached to the wp_head action hook.
/*-----------------------------------------------------------------------------------*/

function dorayaki_print_customcss_style() {
	$options = dorayaki_get_theme_options();
	$customcss = $options['custom-css'];

	$default_options = dorayaki_get_default_theme_options();

	// Don't do anything if the current  footer widget background color is the default.
	if ( $default_options['custom-css'] == $customcss )
		return;
?>
<style type="text/css">
/* Custom CSS */
<?php echo $customcss; ?>
</style>
<?php
}
add_action( 'wp_head', 'dorayaki_print_customcss_style' );
