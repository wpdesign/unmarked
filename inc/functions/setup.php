<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
}

if ( ! function_exists( 'unmarked_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function unmarked_setup() {

	//Make theme available for translation.
	load_theme_textdomain( 'unmarked', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	//Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	
	//Enable support for custom logo in customizer.
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 280,
		'flex-height' => true,
		'flex-width'  => true,
	) );
		
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'unmarked' ),
	) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
    
	/*
	 * Enable support for Post Formats. We are not supporting post formats here. 
	 * I feel post formats are not very useful while developing a custom website. 
	 * You may consider enabling it if developing a Blog website.
	 * See http://codex.wordpress.org/Post_Formats
	*/

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'unmarked_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // unmarked_setup
add_action( 'after_setup_theme', 'unmarked_setup' );