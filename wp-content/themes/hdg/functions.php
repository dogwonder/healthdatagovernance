<?php
/**
 * sigur functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sigur
 */

 /*********************
SCRIPTS & ENQUEUEING
*********************/
$envs = array(
	'development' => 'http://dev.sigurros.test',
	'production'  => 'https://sigurros.com'
  );

  define('ENVIRONMENTS', serialize($envs));
  
  if ( ! function_exists( 'sigur_env' ) ) :
	function sigur_env($env) {
		$site_url = site_url();
		switch ($env) {
		case 'dev':
				if(strpos($site_url, 'dev.sigurros.test') !== FALSE) {
					return true;
				}
		break;
		default:
			'prod';
		break;
		}
	}
endif;

if ( ! function_exists( 'sigur_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sigur_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on sigur, use a find and replace
		 * to change 'sigur' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sigur', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Image sizes;
		add_image_size( 'sigur-tiny', 16, 0, false ); // For Low quality image placeholders (LQIP)
		add_image_size( 'sigur-small', 320, 0, false );
		add_image_size( 'sigur-medium', 640, 0, false );
		add_image_size( 'sigur-medium-crop', 640, 640, array( 'center', 'center' ) );
		add_image_size( 'sigur-large', 1536, 0, false );
		add_image_size( 'sigur-social-image', 1200, 630 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'sigur' ),
				'footer-links' => __( 'Footer', 'sigur' ), 
				'legal'   => esc_html__( 'Legal', 'sigur' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for block template parts.
		add_theme_support( 'block-template-parts' );

		//Remove patterns that ship with WordPress Core.
		remove_theme_support( 'core-block-patterns' );

		// Prevent the loading of patterns from the WordPress.org Pattern Directory
		add_filter( 'should_load_remote_block_patterns', '__return_false' );
		
        // Disable XML-RPC for authenticated methods
        add_filter('xmlrpc_enabled', '__return_false');

        // Disable all XML-RPC functionality
        add_filter('xmlrpc_methods', '__return_empty_array');

	}

	add_action( 'after_setup_theme', 'sigur_setup' );
endif;


// Remove admin stuff - e.g. Emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Disable all XML-RPC functionality
if (!function_exists("sigur_disable_x_pingback")) :
    function sigur_disable_x_pingback($headers) {
        unset ($headers['X-Pingback']);
	    return $headers;
    }
    add_filter('wp_headers', 'sigur_disable_x_pingback');
endif;

/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'sigur_scripts_styles' ) ) :
	
function sigur_scripts_styles() {

	// Register theme stylesheet.
	$theme_version = wp_get_theme()->get( 'Version' );

	$version_string = is_string( $theme_version ) ? $theme_version : false;
	wp_register_style(
		'sigur-style',
		get_template_directory_uri() . '/style.css',
		array(),
		$version_string
	);

	// Add styles inline.

	// Enqueue theme stylesheet.
	wp_enqueue_style( 'sigur-style' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'sigur_scripts_styles' );

endif;



if ( ! function_exists( 'sigur_editor_styles' ) ) :

	/**
	 * Enqueue editor styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	
	function sigur_editor_styles() {

	}
	
	// add_action( 'admin_init', 'sigur_editor_styles' );
endif;


/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/sigur-template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/sigur-functions.php';

/**
 * Functions for Advanced Custom Fields
 */
require_once get_template_directory() . '/inc/sigur-acf.php';

/**
 * Functions for forms
 */
require_once get_template_directory() . '/inc/sigur-forms.php';
