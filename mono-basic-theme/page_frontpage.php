<?php
/**
 * This file adds the Landing template to the Danish Justice Foundation Pro Theme.
 *
 * @author mono voce aps
 * @package Mono Basic Theme
 * @subpackage Customizations
*/

/*
Template Name: Front page
*/

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'thumbnail_enqueue_scripts_styles' );
function thumbnail_enqueue_scripts_styles() {
	wp_enqueue_script( 'mono-modernizr', get_bloginfo( 'stylesheet_directory' ) . '/js/modernizr.custom.79639.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'mono-jquery', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'ba-cond', get_stylesheet_directory_uri() . '/js/jquery.ba-cond.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'slitslider', get_stylesheet_directory_uri() . '/js/jquery.slitslider.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'slide-nav', get_stylesheet_directory_uri() . '/js/slide.nav.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'image-height', get_stylesheet_directory_uri() . '/js/image.height.js', array( 'jquery' ), '1.0.0', true );

}
//* Enqueue parallax script
add_action( 'wp_enqueue_scripts', 'parallax_enqueue_parallax_script' );
function parallax_enqueue_parallax_script() {
	if ( ! wp_is_mobile() ) {
		wp_enqueue_script( 'parallax-script', get_bloginfo( 'stylesheet_directory' ) . '/js/parallax.js', array( 'jquery' ), '1.0.0' );
	}
}
remove_action( 'wp_enqueue_scripts', 'sk_sticky_footer' );

//* Add landing body class to the head
add_filter( 'body_class', 'mono_add_body_class' );
function mono_add_body_class( $classes ) {

	$classes[] = 'front-page';
	return $classes;

}

//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

//* Remove the entry header markup (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove site footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

//* Remove site footer elements
// remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
// remove_action( 'genesis_footer', 'genesis_do_footer' );
// remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );


// Fullscreen Slit Slider Widget
add_action( 'genesis_entry_content', 'full_screen_slider', 15 );
function full_screen_slider() {
	$rows = get_field( 'slider' );  //this is the ACF instruction to get everything in the repeater field
	
	if ( is_single() || is_page() ) {
		
		if($rows) {
			
			echo '<div class="container image-section">
					<div id="slider" class="sl-slider-wrapper image-section">
						<div class="sl-slider">';
			
				foreach($rows as $row) {
					
					echo '<div class="sl-slide bg-1" data-orientation="vertical" data-slice1-rotation="0" data-slice2-rotation="0" data-slice1-scale="0" data-slice2-scale="0">';
					
						echo '<div class="sl-slide-inner front-page-1" style="background-image:url(' . $row['image']. ');">';
						echo 	'<img src="' . $row['logo']. '">';
						echo 	'<h3>' . $row['headline']. '</h3>';
						echo 	'<div class="slider-text">' . $row['text']. '</div>';
						echo	'<div class="slider-link"><a class="button" href="#">See the case</a></div>';
						echo '</div> <!-- /sl-slide-inner -->';
						
					echo '</div> <!-- /sl-slide -->';
				}
			
					echo '<nav id="nav-arrows" class="nav-arrows">
				  			<span class="nav-arrow-prev">Previous</span>
				 			<span class="nav-arrow-next">Next</span>
		  		 		  </nav>';
						  
		}
		
		echo '</div></div></div>';
	}
}

//* Run the Genesis loop
genesis();