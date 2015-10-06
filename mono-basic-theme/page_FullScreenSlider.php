<?php
/**
 * This file adds the Landing template to the Danish Justice Foundation Pro Theme.
 *
 * @author mono voce aps
 * @package Mono Basic Theme
 * @subpackage Customizations
*/

/*
Template Name: Full Screen Slider
*/

//* Include Fullscreen Slit Slider Widget
include_once( get_stylesheet_directory() . '/lib/FullscreenSlitSlider.php' );

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

//* Run the Genesis loop
genesis();


// Fullscreen Slit Slider Widget
add_filter('dynamic_sidebar_params', 'my_dynamic_sidebar_params');
function my_dynamic_sidebar_params( $params ) {
	
	// get widget vars
	$widget_name = $params[0]['widget_name'];
	$widget_id = $params[0]['widget_id'];
	
	
	// bail early if this widget is not a Text widget
	if( $widget_name != 'Fullscreen Slit Slider' ) {
		
		return $params;
		
	}
	
	echo '<div class="sl-slide bg-1" data-orientation="vertical" data-slice1-rotation="0" data-slice2-rotation="0" data-slice1-scale="0" data-slice2-scale="0">';
	
	if ( get_field('image', 'widget_' . $widget_id)) {
		
		$image = get_field('image', 'widget_' . $widget_id);
		
		echo '<div class="sl-slide-inner front-page-1" style="background-image:url(' . $image. ');">';
		
	}else{
		
		echo '<div class="sl-slide-inner">';
		
	}
	
	if ( get_field('headline', 'widget_' . $widget_id)) {
		
		$headline = get_field('headline', 'widget_' . $widget_id);
		
		echo '<h3>' . $headline. '</h3>';
		
	}
	
	if ( get_field('text', 'widget_' . $widget_id)) {
		
		$text = get_field('text', 'widget_' . $widget_id);
		
		echo '<div class="slider-text">' . $text. '</div>';
		
	}

	echo '</div></div>';
	
	// return
	return $params;

}

//* Add markup for Fullscreen Slit Slider Widget
add_action( 'genesis_entry_content', 'mono_front_page_slider', 1 );
function mono_front_page_slider() {
	
	genesis_widget_area( 'front-page-slider', array(
		'before' => '<div class="container image-section"><div id="slider" class="sl-slider-wrapper image-section"><div class="sl-slider">',
		'after'  => '</div>',
	) );
	
	
	echo '<nav id="nav-arrows" class="nav-arrows">
				<span class="nav-arrow-prev">Previous</span>
				<span class="nav-arrow-next">Next</span>
		  </nav>';
	
	echo '</div>';
	echo '</div></div>';
	
}