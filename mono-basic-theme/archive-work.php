<?php
/**
 * This file adds the new template to the Mono Basic Theme.
 *
 * @author mono voce
 * @package Mono
 * @subpackage Customizations
 */

/*
Template Name: Work Archive
*/


//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove post title
// remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
 
//* Force full width content
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
 
//* Remove entry meta in entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
 
//* Display values of custom fields (those that are not empty)
// add_action( 'genesis_entry_content', 'sk_display_custom_fields', 5 );
 
//* Remove default post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
// add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );


//* Add post image in Entry Content above Excerpt
add_action( 'genesis_entry_header', 'sk_display_featured_image', 1 );
function sk_display_featured_image() {

	$image = genesis_get_image( $image_args );
 
	if ( $image ) {
		echo '<a href="' . get_permalink() . '">' . $image .'</a>';
	}
 
}


//* To remove empty markup, '<p class="entry-meta"></p>' for entries that have not been assigned to any Genre
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Run the Genesis loop
genesis();