<?php
/**
 * Dorayaki functions and definitions
 *
 * @package Dorayaki
 * @since Dorayaki 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Set the content width based on the theme's design and stylesheet.
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 960; /* pixels */

function dorayaki_adjust_content_width() {
	global $content_width;

	if ( is_page_template( 'page-templates/full-width.php' ) )
		$content_width = 1180;
}
add_action( 'template_redirect', 'dorayaki_adjust_content_width' );


/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers support for various WordPress features.
/*-----------------------------------------------------------------------------------*/
/**
 * Tell WordPress to run dorayaki_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'dorayaki_setup' );

if ( ! function_exists( 'dorayaki_setup' ) ):
/**
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override dorayaki_setup() in a child theme, add your own dorayaki_setup to your child theme's
 * functions.php file.
 */
function dorayaki_setup() {

	// Make Dorayaki available for translation. Translations can be added to the /languages/ directory.
	load_theme_textdomain( 'dorayaki', get_template_directory() . '/languages' );

	// Remove support form block widget screens.
	remove_theme_support( 'widgets-block-editor' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for editor font sizes.
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __( 'small', 'dorayaki' ),
			'shortName' => __( 'S', 'dorayaki' ),
			'size' => 16,
			'slug' => 'small'
		),
		array(
			'name' => __( 'regular', 'dorayaki' ),
			'shortName' => __( 'M', 'dorayaki' ),
			'size' => 18,
			'slug' => 'regular'
		),
		array(
			'name' => __( 'large', 'dorayaki' ),
			'shortName' => __( 'L', 'dorayaki' ),
			'size' => 21,
			'slug' => 'large'
		),
		array(
			'name' => __( 'larger', 'dorayaki' ),
			'shortName' => __( 'XL', 'dorayaki' ),
			'size' => 25,
			'slug' => 'larger'
		)
	) );

	// Disable custom editor font sizes.
	add_theme_support('disable-custom-font-sizes');

	// Add editor color palette.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __( 'black', 'dorayaki' ),
			'slug' => 'black',
			'color' => '#000000',
		),
		array(
			'name' => __( 'white', 'dorayaki' ),
			'slug' => 'white',
			'color' => '#ffffff',
		),
		array(
			'name' => __( 'light grey', 'dorayaki' ),
			'slug' => 'light-grey',
			'color' => '#f4f4f4',
		),
		array(
			'name' => __( 'light yellow', 'dorayaki' ),
			'slug' => 'light-yellow',
			'color' => '#FFF2BD',
		),
		array(
			'name' => __( 'light red', 'dorayaki' ),
			'slug' => 'light-red',
			'color' => '#FCD3D1',
		),
		array(
			'name' => __( 'light green', 'dorayaki' ),
			'slug' => 'light-green',
			'color' => '#ceead9',
		),
		array(
			'name' => __( 'light blue', 'dorayaki' ),
			'slug' => 'light-blue',
			'color' => '#d6e8f2',
		),
		array(
		'name' => __( 'blue', 'dorayaki' ),
		'slug' => 'blue',
		'color' => '#5cace2',
		),
	) );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Load up the Dorayaki theme options page and related code.
	require( get_template_directory() . '/inc/theme-options.php' );

	// Grab the Dorayaki Custom widgets.
	require( get_template_directory() . '/inc/widgets.php' );

	// Add support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'quote' ) );

	// This theme uses wp_nav_menu().
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'dorayaki' ),
		'optional' => __( 'Footer Navigation (no sub menus supported)', 'dorayaki' )
	) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add support for custom headers.
	$custom_header_support = array(
		'width' => apply_filters( 'dorayaki_header_image_width', 1180 ),
		'height' => apply_filters( 'dorayaki_image_height', 590 ),
		'flex-height' => true,
		'random-default' => true,
		'header-text' => false,
		'wp-head-callback' => '',
		'admin-head-callback' => 'dorayaki_admin_header_style',
		'admin-preview-callback' => 'dorayaki_admin_header_image',
	);

	add_theme_support( 'custom-header', $custom_header_support );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

	// Add Dorayaki's custom image sizes.
	add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'inspiration' => array(
			'url' => '%s/images/headers/inspiration.jpg',
			'thumbnail_url' => '%s/images/headers/inspiration-thumb.jpg',
			'description' => __( 'Inspiration', 'dorayaki' )
		),
		'freedom' => array(
			'url' => '%s/images/headers/freedom.jpg',
			'thumbnail_url' => '%s/images/headers/freedom-thumb.jpg',
			'description' => __( 'Freedom', 'dorayaki' )
		),
		'creativity' => array(
			'url' => '%s/images/headers/creativity.jpg',
			'thumbnail_url' => '%s/images/headers/creativity-thumb.jpg',
			'description' => __( 'Creativity', 'dorayaki' )
		),
		'discovery' => array(
			'url' => '%s/images/headers/discovery.jpg',
			'thumbnail_url' => '%s/images/headers/discovery-thumb.jpg',
			'description' => __( 'Discovery', 'dorayaki' )
		),
		'exploration' => array(
			'url' => '%s/images/headers/exploration.jpg',
			'thumbnail_url' => '%s/images/headers/exploration-thumb.jpg',
			'description' => __( 'Exploration', 'dorayaki' )
		),
		'simplicity' => array(
			'url' => '%s/images/headers/simplicity.jpg',
			'thumbnail_url' => '%s/images/headers/simplicity-thumb.jpg',
			'description' => __( 'Simplicity', 'dorayaki' )
		)
	) );
}
endif; // dorayaki_setup

if ( ! function_exists( 'dorayaki_admin_header_style' ) ) :

/*-----------------------------------------------------------------------------------*/
/*  Returns the Google font stylesheet URL if available.
/*-----------------------------------------------------------------------------------*/

function dorayaki_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Domine or Lato translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$domine = _x( 'on', 'Domine font: on or off', 'dorayaki' );

	$lato = _x( 'on', 'Lato font: on or off', 'dorayaki' );

	if ( 'off' !== $domine || 'off' !== $lato ) {
		$font_families = array();

		if ( 'off' !== $domine )
			$font_families[] = 'Domine:400,700';

		if ( 'off' !== $lato )
			$font_families[] = 'Lato:400,900';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/*-----------------------------------------------------------------------------------*/
/*  Enqueue scripts and styles
/*-----------------------------------------------------------------------------------*/

function dorayaki_scripts() {
	global $wp_styles;

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );


	// Adds JavaScript for scalable videos
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array( 'jquery' ), '1.0' );

	// Adds Custom Dorayaki JavaScript for Off Canvas layout
	wp_enqueue_script( 'dorayaki-custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '1.0' );

	// Add Google Webfonts
	wp_enqueue_style( 'dorayaki-fonts', dorayaki_fonts_url(), array(), null );

	// Loads main stylesheet.
	wp_enqueue_style( 'dorayaki-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'dorayaki_scripts' );

/*-----------------------------------------------------------------------------------*/
/* Load block editor styles.
/*-----------------------------------------------------------------------------------*/
function dorayaki_block_editor_styles() {
 wp_enqueue_style( 'dorayaki-block-editor-styles', get_template_directory_uri() . '/block-editor.css');
 wp_enqueue_style( 'dorayaki-fonts', dorayaki_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'dorayaki_block_editor_styles' );

/*-----------------------------------------------------------------------------------*/
/* Custom header image markup displayed on the Appearance > Header admin panel.
/*-----------------------------------------------------------------------------------*/

function dorayaki_admin_header_image() { ?>
	<div id="headimg">
		<?php
		$image = get_header_image();
		if ( $color && $color != 'blank' )
			$style = ' style="color:#' . $color . '"';
		else
			$style = ' style="display:none"';
		?>
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // dorayaki_admin_header_image


/*-----------------------------------------------------------------------------------*/
/* Creates a nicely formatted and more specific title element text
/* for output in head of document, based on current view.
/*-----------------------------------------------------------------------------------*/

function dorayaki_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'dorayaki' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'dorayaki_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
/*-----------------------------------------------------------------------------------*/

function dorayaki_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'dorayaki_page_menu_args' );


/*-----------------------------------------------------------------------------------*/
/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
/*-----------------------------------------------------------------------------------*/
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {

	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item';
		}
	}

	return $items;
}

/*-----------------------------------------------------------------------------------*/
/* Sets the post excerpt length to 35 characters.
/*-----------------------------------------------------------------------------------*/

function dorayaki_excerpt_length( $length ) {
	return 46;
}
add_filter( 'excerpt_length', 'dorayaki_excerpt_length' );

/*-----------------------------------------------------------------------------------*/
/* Returns a "Continue Reading" link for excerpts
/*-----------------------------------------------------------------------------------*/

function dorayaki_continue_reading_link() {
	return ' <p><a href="'. get_permalink() . '" class="more-link"><span class="morelink-icon">' . __( 'Read more', 'dorayaki' ) . '</span></a></p>';
}

/*-----------------------------------------------------------------------------------*/
/* Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and dorayaki_continue_reading_link().
/*
/* To override this in a child theme, remove the filter and add your own
/* function tied to the excerpt_more filter hook.
/*-----------------------------------------------------------------------------------*/

function dorayaki_auto_excerpt_more( $more ) {
	return ' &hellip;' . dorayaki_continue_reading_link();
}
add_filter( 'excerpt_more', 'dorayaki_auto_excerpt_more' );

/*-----------------------------------------------------------------------------------*/
/* Adds a pretty "Continue Reading" link to custom post excerpts.
/*
/* To override this link in a child theme, remove the filter and add your own
/* function tied to the get_the_excerpt filter hook.
/*-----------------------------------------------------------------------------------*/

function dorayaki_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= dorayaki_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'dorayaki_custom_excerpt_more' );

/*-----------------------------------------------------------------------------------*/
/* Remove inline styles printed when the gallery shortcode is used.
/*-----------------------------------------------------------------------------------*/

function dorayaki_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'dorayaki_remove_gallery_css' );

/**
 * Callback to change just html output on a comment.
 */
function dorayaki_comments_callback($comment, $args, $depth){
	//checks if were using a div or ol|ul for our output
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $args['has_children'] ? 'parent' : '', $comment ); ?>>

	<article id="comment-<?php comment_ID(); ?>" class="comment">
		<div class="comment-avatar">
			<?php echo get_avatar( $comment, 45 ); ?>
		</div>

		<div class="comment-content">
			<ul class="comment-meta">
				<li class="comment-author"><?php printf( __( ' %s ', 'dorayaki' ), sprintf( ' %s ', get_comment_author_link() ) ); ?></li>
				<li class="comment-time"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date */
					printf( __( '%1$s', 'dorayaki' ),
					get_comment_date('d.m.y'));
				?></a></li>
				<li class="comment-edit"><?php edit_comment_link( __( 'Edit', 'dorayaki' ));?></li>
			</ul>
			<div class="comment-text">
				<?php comment_text(); ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'dorayaki' ); ?></p>
				<?php endif; ?>
				<p class="comment-reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'dorayaki' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></p>
			</div><!-- end .comment-text -->

		</div><!-- end .comment-content -->
	</article><!-- end .comment -->

	<?php
}

/*-----------------------------------------------------------------------------------*/
/* Register widgetized areas
/*-----------------------------------------------------------------------------------*/

function dorayaki_widgets_init() {

	register_sidebar( array (
		'name' => __( 'Main Sidebar', 'dorayaki' ),
		'id' => 'sidebar-1',
		'description' => __( 'Widgets will appear in the main sidebar on posts and pages.', 'dorayaki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Header Info', 'dorayaki' ),
		'id' => 'sidebar-header',
		'description' => __( 'Widget will at the top right of your header area. Please only include the Header Info Widget in this widget area.', 'dorayaki' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Column 1', 'dorayaki' ),
		'id' => 'sidebar-footer-1',
		'description' => __( 'Widgets will appear in the first column of the optional 3-column footer widget area.', 'dorayaki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Column 2', 'dorayaki' ),
		'id' => 'sidebar-footer-2',
		'description' => __( 'Widgets will appear in the second column of the optional 3-column footer widget area.', 'dorayaki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Column 3', 'dorayaki' ),
		'id' => 'sidebar-footer-3',
		'description' => __( 'Widgets will appear in the third column of the optional 3-column footer widget area.', 'dorayaki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'init', 'dorayaki_widgets_init' );


if ( ! function_exists( 'dorayaki_content_nav' ) ) :

/*-----------------------------------------------------------------------------------*/
/* Display navigation to next/previous pages when applicable
/*-----------------------------------------------------------------------------------*/

function dorayaki_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="clearfix">
				<div class="nav-previous"><?php next_posts_link( __( '<span>Older Posts</span>', 'dorayaki'  ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( '<span>Newer Posts</span>', 'dorayaki' ) ); ?></div>
			</nav><!-- end #nav-below -->
	<?php endif;
}

endif; // dorayaki_content_nav

/*-----------------------------------------------------------------------------------*/
/* Removes the default CSS style from the WP image gallery
/*-----------------------------------------------------------------------------------*/
add_filter('gallery_style', function( $a ) { return "<div class='gallery'>"; } );

/*-----------------------------------------------------------------------------------*/
/* Extends the default WordPress body classes
/*-----------------------------------------------------------------------------------*/
function dorayaki_body_class( $classes ) {

	if ( ! is_active_sidebar( 'sidebar-1' ) )
		$classes[] = 'no-sidebar';

	if ( is_page_template( 'page-templates/page-archive.php' ) )
		$classes[] = 'template-archive';

	if ( is_page_template( 'page-templates/page-fullwidth.php' ) )
		$classes[] = 'template-fullwidth';

	return $classes;
}
add_filter( 'body_class', 'dorayaki_body_class' );


/*-----------------------------------------------------------------------------------*/
/* Add One Click Demo Import code.
/*-----------------------------------------------------------------------------------*/
require get_template_directory() . '/inc/demo-installer.php';


/*-----------------------------------------------------------------------------------*/
/* Dorayaki Shortcodes
/*-----------------------------------------------------------------------------------*/
// Enable shortcodes in widget areas
add_filter( 'widget_text', 'do_shortcode' );

// Replace WP autop formatting
if (!function_exists( "dorayaki_remove_wpautop")) {
	function dorayaki_remove_wpautop($content) {
		$content = do_shortcode( shortcode_unautop( $content ) );
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
		return $content;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Multi Columns Shortcodes
/* Don't forget to add "_last" behind the shortcode if it is the last column.
/*-----------------------------------------------------------------------------------*/

// Two Columns
function dorayaki_shortcode_two_columns_one( $atts, $content = null ) {
	 return '<div class="two-columns-one">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_columns_one', 'dorayaki_shortcode_two_columns_one' );

function dorayaki_shortcode_two_columns_one_last( $atts, $content = null ) {
	 return '<div class="two-columns-one last">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_columns_one_last', 'dorayaki_shortcode_two_columns_one_last' );

// Three Columns
function dorayaki_shortcode_three_columns_one($atts, $content = null) {
	 return '<div class="three-columns-one">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_one', 'dorayaki_shortcode_three_columns_one' );

function dorayaki_shortcode_three_columns_one_last($atts, $content = null) {
	 return '<div class="three-columns-one last">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_one_last', 'dorayaki_shortcode_three_columns_one_last' );

function dorayaki_shortcode_three_columns_two($atts, $content = null) {
	 return '<div class="three-columns-two">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_two', 'dorayaki_shortcode_three_columns_two' );

function dorayaki_shortcode_three_columns_two_last($atts, $content = null) {
	 return '<div class="three-columns-two last">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_two_last', 'dorayaki_shortcode_three_columns_two_last' );

// Four Columns
function dorayaki_shortcode_four_columns_one($atts, $content = null) {
	 return '<div class="four-columns-one">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_one', 'dorayaki_shortcode_four_columns_one' );

function dorayaki_shortcode_four_columns_one_last($atts, $content = null) {
	 return '<div class="four-columns-one last">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_one_last', 'dorayaki_shortcode_four_columns_one_last' );

function dorayaki_shortcode_four_columns_two($atts, $content = null) {
	 return '<div class="four-columns-two">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_two', 'dorayaki_shortcode_four_columns_two' );

function dorayaki_shortcode_four_columns_two_last($atts, $content = null) {
	 return '<div class="four-columns-two last">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_two_last', 'dorayaki_shortcode_four_columns_two_last' );

function dorayaki_shortcode_four_columns_three($atts, $content = null) {
	 return '<div class="four-columns-three">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_three', 'dorayaki_shortcode_four_columns_three' );

function dorayaki_shortcode_four_columns_three_last($atts, $content = null) {
	 return '<div class="four-columns-three last">' . dorayaki_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_three_last', 'dorayaki_shortcode_four_columns_three_last' );


// Divide Text Shortcode
function dorayaki_shortcode_divider($atts, $content = null) {
	 return '<div class="divider"></div>';
}
add_shortcode( 'divider', 'dorayaki_shortcode_divider' );

/*-----------------------------------------------------------------------------------*/
/* Text Highlight and Info Boxes Shortcodes
/*-----------------------------------------------------------------------------------*/

function dorayaki_shortcode_white_box($atts, $content = null) {
	 return '<div class="white-box">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'white_box', 'dorayaki_shortcode_white_box' );

function dorayaki_shortcode_yellow_box($atts, $content = null) {
	 return '<div class="yellow-box">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'yellow_box', 'dorayaki_shortcode_yellow_box' );

function dorayaki_shortcode_red_box($atts, $content = null) {
	 return '<div class="red-box">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'red_box', 'dorayaki_shortcode_red_box' );

function dorayaki_shortcode_blue_box($atts, $content = null) {
	 return '<div class="blue-box">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'blue_box', 'dorayaki_shortcode_blue_box' );

function dorayaki_shortcode_green_box($atts, $content = null) {
	 return '<div class="green-box">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'green_box', 'dorayaki_shortcode_green_box' );

function dorayaki_shortcode_lightgrey_box($atts, $content = null) {
	 return '<div class="lightgrey-box">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'lightgrey_box', 'dorayaki_shortcode_lightgrey_box' );

function dorayaki_shortcode_grey_box($atts, $content = null) {
	 return '<div class="grey-box">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'grey_box', 'dorayaki_shortcode_grey_box' );

function dorayaki_shortcode_dark_box($atts, $content = null) {
	 return '<div class="dark-box">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'dark_box', 'dorayaki_shortcode_dark_box' );

/*-----------------------------------------------------------------------------------*/
/* Buttons Shortcodes
/*-----------------------------------------------------------------------------------*/
function dorayaki_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'link'	=> '#',
		'target' => '',
		'color'	=> '',
		'size'	=> '',
	 'form'	=> '',
	 'font'	=> '',
		), $atts));

	$color = ($color) ? ' '.$color. '-btn' : '';
	$size = ($size) ? ' '.$size. '-btn' : '';
	$form = ($form) ? ' '.$form. '-btn' : '';
	$font = ($font) ? ' '.$font. '-btn' : '';
	$target = ($target == 'blank') ? ' target="_blank"' : '';

	$out = '<a' .$target. ' class="standard-btn' .$color.$size.$form.$font. '" href="' .$link. '"><span>' .do_shortcode($content). '</span></a>';

		return $out;
}
add_shortcode('button', 'dorayaki_button');

/*-----------------------------------------------------------------------------------*/
/* Special Font + Layout Shortcodes
/*-----------------------------------------------------------------------------------*/
function dorayaki_shortcode_fullwidth_content($atts, $content = null) {
	 return '<div class="fullwidth-content">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'fullwidth_content', 'dorayaki_shortcode_fullwidth_content' );

function dorayaki_shortcode_intro_text($atts, $content = null) {
	 return '<p class="slogan">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</p>';
}
add_shortcode( 'intro_text', 'dorayaki_shortcode_intro_text' );


function dorayaki_shortcode_headline_border($atts, $content = null) {
	 return '<h2 class="centered"><span>' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</span></h2>';
}
add_shortcode( 'headline_border', 'dorayaki_shortcode_headline_border' );

function dorayaki_shortcode_contact_form($atts, $content = null) {
	 return '<div class="contact-form">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'contact_form', 'dorayaki_shortcode_contact_form' );

function dorayaki_shortcode_contact_info($atts, $content = null) {
	 return '<div class="contact-info">' . do_shortcode( dorayaki_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'contact_info', 'dorayaki_shortcode_contact_info' );
