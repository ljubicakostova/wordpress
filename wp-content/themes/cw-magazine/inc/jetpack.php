<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package cw-magazine
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function cw_magazine_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'cw_magazine_jetpack_setup' );
