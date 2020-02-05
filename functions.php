<?php
/**
 * log-book functions and definitions
 * @package log-book
 * @version 1.0.1
 */

/**
 * log-book only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/include/back-compat.php';
	return;
}


// Widgets.

require( get_template_directory() . '/widgets/recent-post-widget.php' );

require( get_template_directory() . '/widgets/author-widget.php' );


 //Sets up theme defaults and registers support for various WordPress features.
function log_book_setup() {
	
	//Make theme available for translation.
	load_theme_textdomain( 'log-book' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

    //Enable Header image.
	add_theme_support( 'custom-header' );

	//Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'log-book-featured-image', 1450, 480, true );
	
	
	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'footer-menu' => __( 'Footer Menu', 'log-book' ),
		'primary'     => __( 'Primary Menu', 'log-book' ),
		'social'      => __( 'Social Links Menu', 'log-book' ),
	) );

	//Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 550,
		'height'      => 99,
		'flex-width'  => true,
		'flex-height' => true,
	) );

    

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
    
    // Add woocommerce support
    add_theme_support( 'woocommerce' );

   // Add theme support for gutenberg-editor
	
	 add_theme_support( 'align-wide' );
	
}
add_action( 'after_setup_theme', 'log_book_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * @global int $content_width
 */
function log_book_content_width() {

	$content_width = $GLOBALS['content_width'];
	
	// Get layout.
	$page_layout   = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {

		if ( log_book_is_frontpage() ) {

			$content_width = 644;

		} elseif ( is_page() ) {

			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter log-book content width of the theme.
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'log_book_content_width', $content_width );
}
add_action( 'template_redirect', 'log_book_content_width', 0 );


/**
 * Add preconnect for Google Fonts.
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function log_book_resource_hints( $urls, $relation_type ) {

	if ( wp_style_is( 'log-book-fonts', 'queue' ) && 'preconnect' === $relation_type ) {

		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'log_book_resource_hints', 10, 2 );

/**
 * Register widget areas.
 */
function log_book_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'log-book' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'log-book' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s categories">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title widget-heading">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'log_book_widgets_init' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 */
function log_book_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'log_book_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function log_book_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo( 'pingback_url' )) );
	}
}
add_action( 'wp_head', 'log_book_pingback_header' );



/**
 * Enqueue scripts and styles.
 */

function log_book_scripts() {


	/*google font  */
	wp_enqueue_style( 'log-book-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,800', array(), null );

	//Bootstrap stylesheet.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

	//font-awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );

	//color.
	wp_enqueue_style( 'log-book-color', get_template_directory_uri() . '/assets/css/color.css' );

	//typography.
	wp_enqueue_style( 'log-book-typography', get_template_directory_uri() . '/assets/css/typography.css' );
    
    //svg.
	wp_enqueue_style( 'svg', get_template_directory_uri() . '/assets/css/svg.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'log-book', get_stylesheet_uri() );
	
    //owl-carousel
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' );

	//owl-carousel-default
	wp_enqueue_style( 'owl-carousel-default', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css' );

	//dlmenu
	wp_enqueue_style( 'dlmenu', get_template_directory_uri() . '/assets/css/dlmenu.css' );

	//responsive
	wp_enqueue_style( 'log-book-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );

	
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), '1.0', true );
		
	wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/assets/js/owl.carousel.min.js' ), array( 'jquery' ), '1.0', true );
    
	wp_enqueue_script( 'modernizr', get_theme_file_uri( '/assets/js/modernizr.custom.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-dlmenu', get_theme_file_uri( '/assets/js/jquery.dlmenu.js' ), array( 'jquery' ), '1.0', true );

	 $hide_sticky_sidebar = log_book_get_option( 'sticky_sidebar' );
    
    if( $hide_sticky_sidebar != 1 )
	{
        
        wp_enqueue_script( 'log-book-sticky-sidebar', get_template_directory_uri() . '/assets/js/sticky-sidebar.js', array('jquery'), time(), true );

		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array('jquery'), time(), true );
	}	

	wp_enqueue_script( 'log-book-custom', get_theme_file_uri( '/assets/js/custom.js' ), array( 'jquery' ), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'log_book_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *	values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function log_book_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'log_book_content_image_sizes_attr', 10, 2 );


/**
 * Add custom image sizes attribute to enhance responsive image functionality for post thumbnails.
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function log_book_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'log_book_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function log_book_front_page_template( $template ) {
	
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'log_book_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size and use list format for better accessibility.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function log_book_widget_tag_cloud_args( $args ) {
	$args['largest']  = 12;
	$args['smallest'] = 12;
	$args['unit']     = 'px';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'log_book_widget_tag_cloud_args' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/include/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/include/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/include/customizer.php' );

/**
 * breadcrumb.
 */
require get_parent_theme_file_path( '/template-parts/header/breadcrumb.php' );


/**
 * hooks function.
 */
require get_parent_theme_file_path( '/include/hooks.php' );

/**
 * Load TGM File
*/
require get_template_directory() . '/include/class-tgm-plugin-activation.php';

/**
 * Plugin recommendation using TGM
*/
require get_template_directory() . '/include/tgm-plugin-activation.php';


/**
 * Load Upgrade to pro
 */
require get_template_directory() . '/include/customizer-pro/class-customize.php';

// woocommerce images popup code
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );