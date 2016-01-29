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

//* Don't Remove site footer elements
// remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
// remove_action( 'genesis_footer', 'genesis_do_footer' );
// remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

//* Display content including Advanced Custom Fields
add_action ('genesis_entry_content', 'lustre_add_landing_content' );

function lustre_add_landing_content() {
	echo '<section class="content-section" id="section-1">';
		echo '<div class="subhed-img" id="01-subhed"><img src="' . get_home_url() .'/wp-content/uploads/2016/01/01-Lustre-Jewels.jpg"</div>';
		echo '<div class="callout" id="01-callout">' . get_field('01_callout') . '</div>';
		echo '<div class="section-text one-half first" id="01-text">' . get_field('01_text') . '</div>';
		echo '<div class="one-half" id="01-jewel-img"><img src="' . get_home_url() .'/wp-content/uploads/2016/01/01-blue-bracelet.jpg"</div>';
	echo '</section>'; /* end section-1 */

	echo '<div class="callout" id="dictionary">Lustre [luhs-ter] noun:<br />Radiant or luminous brightness;<br />brilliance; radiance</div>';

	echo '<section class="content-section" id="section-2">';
		echo '<div class="subhed-img" id="02-subhed"><img src="' . get_home_url() .'/wp-content/uploads/2016/01/02-Lustre-Services.jpg"></div>';
		echo '<div id="approach-and-custom" class="one-half first"> 
			<img id="02-pink-ring-img" src="' . get_home_url() .'/wp-content/uploads/2016/01/02-pink-ring.jpg">'.
			get_field('02_approach');
			echo ''.
			get_field('02_custom_pieces');
			echo '
			<img id="02-aqua-earrings-img" src="' . get_home_url() .'/wp-content/uploads/2016/01/02-aqua-earrings.jpg">
			</div>'; /* end approach-and-custom */

		echo '<div id="sourcing-and-events" class="one-half">'. 
			get_field('02_sourcing').'
			<img id="02-pink-ring-img" src="' . get_home_url() .'/wp-content/uploads/2016/01/02-gold-bracelet.jpg">'. 
			get_field('02_events').'
			</div>'; /* end sourcing-and-events */

	echo '</section>'; /* end section-2 */

	echo '<div class="divider">&nbsp;</div>';

	echo '<section class="content-section" id="section-3">';
		echo '<div class="subhed-img" id="03-subhed"><img src="' . get_home_url() .'/wp-content/uploads/2016/01/03-Lustre-About.jpg"></div>';
		echo '<div class="callout" id="03-callout">' . get_field('03_callout') . '</div>';
		echo '<div class="one-fourth first" id="03-lisa-img"><img src="' . get_home_url() .'/wp-content/uploads/2016/01/Lisa-Serabian.jpg"></div>';
		echo '<div class="three-fourths" id="03-about-text">' .get_field('03_about').'</div>';
	echo '</section>'; /* end section-3 */

	echo '<div class="divider">&nbsp;</div>';

	echo '<section class="content-section" id="section-4">';
		echo '<div class="subhed-img" id="04-subhed"><img src="' . get_home_url() .'/wp-content/uploads/2016/01/04-Lustre-Contact.jpg"></div>';

	echo '</section>'; /* end section-4 */

}

//* Display Contact forms after content

/* found in genesis / lib / structure / layout.php */
// add_action( 'genesis_after_content', 'genesis_get_sidebar' );

/* put where i want instead */
remove_action( 'genesis_after_content', 'genesis_get_sidebar' ); 

add_action ('genesis_after_content', 'lustre_add_contact_form' );
function lustre_add_contact_form() {
	echo '<div id="contact-div">';

		echo '<div id="contact-left" class="five-twelfths first">';
		echo '<h3>Schedule a Consultation</h3><p class="form-info">Phone: 999-999-9999<br/>Email: lisa@lustrejewels.net<br/>Or simply have Lisa contact you...</p>';
		echo	do_shortcode('[vfb id="1"]');
		echo '</div>'; /* end contact-left */

		echo '<div class="two-twelfths"><img src="' . get_home_url() .'/wp-content/uploads/2016/01/04-drop-earrings.jpg"></div>';

				echo '<div id="contact-right" class="five-twelfths">';
		echo '<h3>Do you like a good story?</h3><p>Sign up to receive Lisa’s jewelry stories—monthly tales of rare and beautiful pieces, jewel-related history and behind-the-scenes details.</p>';
		genesis_get_sidebar();
		echo '</div>'; /* end contact-right */
	
	echo '</div>'; /* end contact-div */

}
// add_action( 'genesis_after_content', 'genesis_get_sidebar' );

//* Run the Genesis loop
genesis();