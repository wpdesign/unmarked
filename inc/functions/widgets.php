<?php
/*
Author: Jihan Ahmed
URL: http://wpunmarked.com

This is where you can add sidebar and widgetized area in WordPress. 
Even you can create complete Widgetized page for example homepage.
*/

// SIDEBARS AND WIDGETIZED AREAS
add_action( 'widgets_init', 'unmarked_register_widgets' );

function unmarked_register_widgets() {
	register_sidebar(array(
		'id' => 'primary-sidebar',
		'name' => __('Primary Sidebar', 'unmarked'),
		'description' => __('The first (primary) sidebar.', 'unmarked'),
		'before_widget' => '<section class="col-sm-6 col-md-12"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'id' => 'footer-left',
		'name' => __('Left Footer', 'unmarked'),
		'description' => __('Left Footer Widget Area', 'unmarked'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'id' => 'footer-center',
		'name' => __('Center Footer', 'unmarked'),
		'description' => __('Center Footer Widget Area', 'unmarked'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'id' => 'footer-right',
		'name' => __('Right Footer', 'unmarked'),
		'description' => __('Right Footer Widget Area', 'unmarked'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'id' => 'fourth-footer-widget-area',
		'name' => __('Fourth Footer Widget Area', 'unmarked'),
		'description' => __('Fourth Footer Widget Area', 'unmarked'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

} // don't remove this bracket!


function my_widget_content_wrap($content) {
    $content = '<div class="widget-content">'.$content.'</div>';
    return $content;
}
add_filter('widget_text', 'my_widget_content_wrap');