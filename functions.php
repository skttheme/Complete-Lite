<?php
/**
 * SKT Complete Lite functions and definitions
 *
 * @package SKT Complete Lite
 */

// Set the word limit of post content 

add_action('the_content','complete_lite_limit_the_content');

function complete_lite_limit_the_content($content){
$word_limit =40;
$words = explode(' ', $content);
if (!is_single() && !is_page()) {
return implode(' ', array_slice($words, 0, $word_limit));
} else {
return $content;
}
}

function complete_lite_short_the_content($content){
  $word_limit = 12;
  $words = explode(' ', $content);
  return implode(' ', array_slice($words, 0, $word_limit));
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'complete_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function complete_lite_setup() {
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'complete-lite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 25,
		'width'       => 210,
		'flex-height' => true,
	) );	
	add_theme_support( 'custom-header', array( 'header-text' => false ) );
	add_image_size('completelite-homepage-thumb',240,145,true);
	register_nav_menu( 'primary', esc_attr__( 'Primary Menu', 'complete-lite' ) );
	$args = array(
		'default-color' => 'f2f2f2',
	);
	add_theme_support( 'custom-background', $args );
	add_editor_style( 'editor-style.css' );
}
endif; // complete_lite_setup
add_action( 'after_setup_theme', 'complete_lite_setup' );


function complete_lite_widgets_init() {	
	
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'complete-lite' ),
		'description'   => __( 'Appears on blog page sidebar', 'complete-lite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div class="widget" id="%1$s"><div class="widget_wrap">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><span class="widget_border"></span>',
	) );	
	
	register_sidebar( array(
		'name'          => __( 'Latest News', 'complete-lite' ),
		'description'   => __( 'Appears on footer', 'complete-lite' ),
		'id'            => 'footer-1',
		'before_widget' => '<div id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'complete_lite_widgets_init' );


function complete_lite_font_url(){
		$font_url = '';		
		
		/* Translators: If there are any character that are not
		* supported by Oswald, trsnalate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on','Roboto:on or off','complete-lite');
		$piedra = _x('on','Piedra:on or off','complete-lite');
		
		/* Translators: If there has any character that are not supported 
		*  by Scada, translate this to off, do not translate
		*  into your own language.
		*/		
		
		if('off' !== $roboto){
			$font_family = array();
			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:300,400,600,700,800,900';
			}			
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
		if('off' !== $piedra){
			$font_family = array();
			
			if('off' !== $piedra){
				$font_family[] = 'Piedra:300,400,600,700,800,900';
			}			
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}		
		
	return $font_url;
	}


function complete_lite_scripts() {
	wp_enqueue_style('complete_lite-font', complete_lite_font_url(), array());
	wp_enqueue_style( 'complete_lite-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'complete_lite-editor-style', get_template_directory_uri().'/editor-style.css' );
	wp_enqueue_style( 'complete_lite-nivoslider-style', get_template_directory_uri().'/css/nivo-slider.css' );
	wp_enqueue_style( 'complete_lite-main-style', get_template_directory_uri().'/css/responsive.css' );		
	wp_enqueue_style( 'complete_lite-base-style', get_template_directory_uri().'/css/style_base.css' );
	wp_enqueue_script( 'complete_lite-nivo-script', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'complete_lite-custom_js', get_template_directory_uri() . '/js/custom.js' );
	wp_enqueue_style( 'complete_lite-font-awesome-style', get_template_directory_uri().'/css/font-awesome.css' );	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'complete_lite_scripts' );

function complete_lite_ie_stylesheet(){
	global $wp_styles;
	
	/** Load our IE-only stylesheet for all versions of IE.
	*   <!--[if lt IE 9]> ... <![endif]-->
	*
	*  Note: It is also possible to just check and see if the $is_IE global in WordPress is set to true before
	*  calling the wp_enqueue_style() function. If you are trying to load a stylesheet for all browsers
	*  EXCEPT for IE, then you would HAVE to check the $is_IE global since WordPress doesn't have a way to
	*  properly handle non-IE conditional comments.
	*/
	wp_enqueue_style('completelite-ie', get_template_directory_uri().'/css/ie.css', array('completelite-style'));
	$wp_styles->add_data('completelite-ie','conditional','IE');
	}
add_action('wp_enqueue_scripts','complete_lite_ie_stylesheet');

define('SKT_THEME_URL','https://www.sktthemes.org/themes');
define('SKT_THEME_DOC','https://sktthemesdemo.net/documentation/complete-documentation/');
define('SKT_PRO_THEME_URL','https://www.sktthemes.org/shop/complete-wordpress-theme/');
define('SKT_LIVE_DEMO','https://sktthemesdemo.net/complete/');
define('SKT_THEME_FEATURED_SET_VIDEO_URL','https://www.youtube.com/watch?v=310YGYtGLIM');
define('SKT_FREE_THEME_URL','https://www.sktthemes.org/shop/free-premium-wordpress-theme/');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template for about theme.
 */
require get_template_directory() . '/inc/about-themes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// get slug by id
function complete_lite_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}

if ( ! function_exists( 'complete_lite_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function complete_lite_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

// Add a Custom CSS file to WP Admin Area
function complete_lite_admin_theme_style() {
    wp_enqueue_style('custom-admin-style', get_template_directory_uri() . '/css/admin.css');
}
add_action('admin_enqueue_scripts', 'complete_lite_admin_theme_style');


// WordPress wp_body_open backward compatibility
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
} 