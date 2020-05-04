<?php
/* 
* This file handle enqueue scripts and styles in WordPress way.
* Developed by: Jihan Ahmed
* URL: http://wpunmarked.com
*/

function unmarked_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper  around ie stylesheet the WordPress way
  
  if (!is_admin()) {
    
    // Add Bootstrap
	wp_enqueue_script( 'bootstrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array('jquery'), NULL, true );   
	wp_enqueue_style( 'bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css', false, NULL, 'all' );
	
    //wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css', array(), '4.0.0');
	//wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array(), '4.0.0', true);
	
	// Add Font Awesome
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/inc/font-awesome/font-awesome.min.css', array(), '4.6.3');
    
	// Register Smart Menu
	wp_enqueue_style( 'smart-menu-css', get_stylesheet_directory_uri() . '/inc/smart-menu/css/sm-core-css.css', array(), '');
	wp_enqueue_style( 'smart-menu-custom', get_stylesheet_directory_uri() . '/inc/smart-menu/css/sm-custom.css', array(), '');
	wp_enqueue_script( 'smart-menu', get_template_directory_uri() . '/inc/smart-menu/js/jquery.smartmenus.js', array(), '', true );
	
	// Register WP Essential Style
    wp_enqueue_style( 'unmarked-essential', get_stylesheet_directory_uri() . '/css/wp-essential.css', array(), '0.1.2');
	
	// Register Theme Main Style
    wp_enqueue_style( 'unmarked', get_stylesheet_directory_uri() . '/css/theme.css', array(), '0.1.2');
	
	// Register Custom Optional Style
    wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/style.css', array(), '', 'all' );
	 
	// Adding scripts file in the footer
	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '', true );
	wp_enqueue_script( 'unmarked-scripts', get_template_directory_uri() . '/js/scripts.min.js', array('jquery'), '', true );
    
    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
 }
}
add_action('wp_enqueue_scripts', 'unmarked_scripts', 999);


// Registers an editor stylesheet for the theme.
function unmarked_editor_styles() {
    add_editor_style( 'inc/css/editor-style.css' );
}
add_action( 'admin_init', 'unmarked_editor_styles' );


