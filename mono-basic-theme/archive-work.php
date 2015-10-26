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
 
//* Force full width content
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
 
//* Remove entry meta in entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_do_post_title' );
 
//* Remove default post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

//* Add post image in Entry Content above Excerpt
add_action( 'genesis_entry_header', 'sk_display_featured_image', 15 );
function sk_display_featured_image() {

	$image = genesis_get_image( $image_args );
 
	if ( $image ) {
		echo '<div class="image-background hover-out"><a href="' . get_permalink() . '">' . $image .'</a></div>';
	}
 
}

//* To remove empty markup, '<p class="entry-meta"></p>' for entries that have not been assigned to any Genre
// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
// add_action( 'genesis_entry_footer', 'genesis_post_meta', 1 );

// remove_action( 'genesis_entry_meta', 'genesis_entry_meta_markup_open', 5 );
// remove_action( 'genesis_entry_meta', 'genesis_entry_meta_markup_close', 15 );

//* Modify the Genesis content limit read more link
remove_filter( 'get_the_content_more_link', 'sp_read_more_link' );
add_filter( 'get_the_content_more_link', 'work_read_more_link' );
function work_read_more_link() {
	return '<a class="button work-btn" href="' . get_permalink() . '">See what we did</a>';
}



//* Run the Genesis loop
genesis();