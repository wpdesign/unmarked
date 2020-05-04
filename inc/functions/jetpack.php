<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function unmarked_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container-fluid' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'unmarked_jetpack_setup' );
