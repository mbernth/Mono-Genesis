<?php
/**
 * This file adds the Landing template to the Danish Justice Foundation Pro Theme.
 *
 * @author mono voce aps
 * @package Mono Basic Theme
 * @subpackage Customizations
*/

/*
Template Name: Thumbnail Grid
*/

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'thumbnail_enqueue_scripts_styles' );
function thumbnail_enqueue_scripts_styles() {
	wp_enqueue_script( 'thumbnail-modernizr', get_bloginfo( 'stylesheet_directory' ) . '/js/modernizr.custom.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'thumbnail-jquery', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'thumbnail-grid', get_bloginfo( 'stylesheet_directory' ) . '/js/grid.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'thumbnail-grid-init', get_bloginfo( 'stylesheet_directory' ) . '/js/grid_init.js', array( 'jquery' ), '1.0.0', true );

}
remove_action( 'wp_enqueue_scripts', 'sk_sticky_footer' );

//* Add landing body class to the head
add_filter( 'body_class', 'mono_add_body_class' );
function mono_add_body_class( $classes ) {

	$classes[] = 'thumbnail_grid';
	return $classes;

}

//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Thumbnail grid
add_action( 'genesis_entry_content', 'mono_thumbnail_grid', 15 );
function mono_thumbnail_grid() {
	$thumbs = get_field( 'thumbnail' );
	
	if ( is_single() || is_page() ) {
		
		if($thumbs) {
			echo '<ul id="og-grid" class="og-grid">';
			
			foreach($thumbs as $thumb) {
				echo '<li>';
					echo '<a href="';
							echo '' . $thumb['link']. '';
					echo '" data-largesrc="';	
						echo '' . $thumb['image']. '';
					echo '" data-title="';
							echo '' . $thumb['titel']. '';
					echo '" data-description="';								
							echo '' . $thumb['description']. '';
					echo '">';	
					echo '<img src="';	
						echo '' . $thumb['image']. '';
					echo '"></a>';
				echo '</li>';
			}
			
			echo '</ul>';
		}
	}
}

//* Run the Genesis loop
genesis();
