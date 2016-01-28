<?php
/**
 * This file adds the Landing template to the Minimum Pro Theme.
 *
 * @author StudioPress
 * @package Minimum Pro
 * @subpackage Customizations
 */

/*
Template Name: Landing
*/

//* Add landing body class to the head
add_filter( 'body_class', 'minimum_add_body_class' );
function minimum_add_body_class( $classes ) {

	$classes[] = 'minimum-landing';
	return $classes;

}

//* Enqueue Backstretch scripts
add_action( 'wp_enqueue_scripts', 'minimum_enqueue_backstretch' );
function minimum_enqueue_backstretch() {

	//* Load scripts only if custom background is being used
	if ( ! get_background_image() )
		return;
	
	//* Load Backstretch scripts
	wp_enqueue_script( 'minimum-backstretch', get_bloginfo( 'stylesheet_directory' ) . '/js/backstretch.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'minimum-backstretch-set', get_bloginfo('stylesheet_directory').'/js/backstretch-set.js' , array( 'jquery', 'minimum-backstretch' ), '1.0.0' );
	wp_localize_script( 'minimum-backstretch-set', 'BackStretchImg', array( 'src' => get_background_image() ) );

}

//* Don't Remove site header elements
// remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
// remove_action( 'genesis_header', 'genesis_do_header' );
// remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

//* Don't Remove navigation
// remove_action( 'genesis_after_header', 'genesis_do_nav', 15 );
// remove_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Remove Minimum after header
remove_action( 'genesis_after_header', 'minimum_site_tagline' );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove site footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

//* Remove site footer elements
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

//* Display content including Advanced Custom Fields
add_action ('genesis_entry_content', 'lustre_add_landing_content' );

function lustre_add_landing_content() {

	echo '<section id="section-1"';
	echo '<div class="subhed-img" id="01-subhed"><img src="' . get_home_url() .'/wp-content/uploads/2016/01/01-Lustre-Jewels.jpg"</div>';
	echo '<div class="callout" id="01-callout">' . get_field('01_callout') . '</div>';
	echo '<div class="section-text one-half first" id="01-text">' . get_field('01_text') . '</div>';
	echo '<div class="one-half" id="01-jewel-img"><img src="' . get_home_url() .'/wp-content/uploads/2016/01/01-blue-bracelet.jpg"</div>';
	echo '</section>'; /* end section-1 */



}

//* Run the Genesis loop
genesis();