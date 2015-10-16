<?php
/**
 * This file adds the new template to the Mono Basic Theme.
 *
 * @author mono voce
 * @package Mono
 * @subpackage Customizations
 */

/*
Template Name: Work Single
*/

add_action( 'wp_enqueue_scripts', 'mono_enqueue_work_script' );
function mono_enqueue_work_script() {
	wp_enqueue_script( 'mono-jquery', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'mono-image-height', get_stylesheet_directory_uri() . '/js/image.height.js', array( 'jquery' ), '1.0.0', true );
}


//* Reposition Breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_content', 'genesis_do_breadcrumbs' );

//* Force full width content
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Reorder the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action ( 'genesis_after_header', 'genesis_do_post_title', 9 );

//* Remove the entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

 

/**
 * Display Featured Image floated to the right in single Posts.
 *
 * @author Sridhar Katakam
 * @link   http://sridharkatakam.com/how-to-display-featured-image-in-single-posts-in-genesis/
 */

function sk_show_featured_image_single_case_pages() {

 
	genesis_image( $image_args );
 
}



// check if the flexible content field has rows of data
function mono_flexible_fields() {
	
	if( have_rows('content') ):

		// loop through the rows of data
    	while ( have_rows('content') ) : the_row();

        	if( get_row_layout() == 'full_width_column' ):
				echo '<div class="gridcontainer">';
					echo '<div class="gridcoll-all">';
        				the_sub_field('full_width');
					echo '</div>';
				echo '</div>';
				
        	elseif( get_row_layout() == 'two_columns' ):
				echo '<div class="gridcontainer">';
					echo '<div class="gridcoll3">';
        				the_sub_field('left_column');
					echo '</div>';
					echo '<div class="gridcoll3">';
						the_sub_field('right_column');
					echo '</div>';
				echo '</div>';
				
			elseif( get_row_layout() == 'three_columns' ):
				echo '<div class="gridcontainer">';
					echo '<div class="gridcoll2">';
        				the_sub_field('left_column');
					echo '</div>';
					echo '<div class="gridcoll2">';
						the_sub_field('middle_column');
					echo '</div>';
					echo '<div class="gridcoll2">';
						the_sub_field('right_column');
					echo '</div>';
				echo '</div>';
				
        	endif;

    	endwhile;

	else :

    // no layouts found

	endif;

}
add_action( 'genesis_entry_content', 'mono_flexible_fields', 15 );
 
//* To remove empty markup, '<p class="entry-meta"></p>' for entries that have not been assigned to any Genre
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
add_action ( 'genesis_after_header', 'genesis_post_meta', 9 );

//* DISPLAY FULL WIDTH FEATURED IMAGE ON STATIC PAGES
add_action ( 'genesis_after_header', 'full_featured_image', 9 );
/**
 * Display Featured image after header.
 * 
 * Only on the first page when the Page or Post is divided into multiple
 * using next page quicktag.
 *
 * Scope: static Pages and single Posts.
 *
 * @author Sridhar Katakam
 * @author Gary Jones
 * @link   http://sridharkatakam.com/link-to-your-tutorial
 */
function full_featured_image() {
	if ( ! is_singular() )
		return;
		$img = genesis_get_image( array( 'format' => 'url') );
		//* printf( '<div class="bigImage">%s</div>', $img );
		printf( '<div class="image-section" style="background-image:url(%s);"></div>', $img );
}
//* ============================

//* Run the Genesis loop
genesis();