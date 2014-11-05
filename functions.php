<?php
/**
 * Stock functions and definitions
 *
 * @package Stock
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 730; /* pixels */
}

if ( ! function_exists( 'stock_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function stock_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Stock, use a find and replace
	 * to change 'stock' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'stock', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'stock' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'stock_custom_background_args', array(
		'default-color' => 'fbfbfb',
		'default-image' => '',
	) ) );

	// Add a custom stylesheet to the editor
	add_editor_style();
}
endif; // stock_setup
add_action( 'after_setup_theme', 'stock_setup' );

/**
 * Return default colors used by the theme.
 */
function stock_get_default_colors() {
	return array(
		'primary'   => '#000000',
		'secondary' => '#f5f5f5',
	);
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function stock_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'stock' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'stock_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function stock_scripts() {
	wp_enqueue_style( 'stock-style', get_stylesheet_uri() );

	wp_enqueue_style( 'stock-fonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic|Crimson+Text:400,400italic,600,600italic' );

	wp_enqueue_script( 'stock-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'stock-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$default_colors  = stock_get_default_colors();
	$primary_color   = get_theme_mod( 'stock_primary_feature_color', isset( $default_colors['primary'] ) ? $default_colors['primary'] : null );
	$secondary_color = get_theme_mod( 'stock_secondary_feature_color', isset( $default_colors['secondary'] ) ? $default_colors['secondary'] : null );

	$custom_css = "
	.entry-content a,
	.entry-content a:visited,
	.comment-content a,
	.comment-content a:visited,
	.comment-author a,
	.comment-author a:visited,
	.entry-footer a,
	.entry-footer a:visited,
	a:hover,
	a:focus,
	a:active {
		color: {$primary_color};
	}
	h2.site-description {
		color: {$secondary_color};
	}";

	wp_add_inline_style( 'stock-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'stock_scripts' );

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

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
