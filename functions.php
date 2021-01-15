<?php

if ( ! function_exists( 'maupassant_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function maupassant_setup() {
		load_theme_textdomain( 'maupassant', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		) );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 800, 500, true );

		// Enable support for background image
		add_theme_support( 'custom-background' );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		) );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( 'css/editor-style.css' );

		// Use wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'maupassant' ),
		) );
	}
}

add_action( 'after_setup_theme', 'maupassant_setup' );

/**
 * Register widget area.
 */
function maupassant_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'maupassant' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'maupassant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'maupassant_widgets_init' );

/**
 * Set main content width.
 */
function maupassant_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'maupassant_content_width', 800 );
}

add_action( 'after_setup_theme', 'maupassant_content_width', 0 );

/**
 * Enqueue scripts.
 */
function maupassant_enqueue_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'maupassant_enqueue_scripts' );

/**
 * Enqueue styles.
 */
function maupassant_enqueue_styles() {
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );
	wp_enqueue_style( 'maupassant-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'maupassant_enqueue_styles' );

require get_template_directory() . '/inc/settings.php';
require get_template_directory() . '/inc/template-functions.php';
