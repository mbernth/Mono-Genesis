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

/*
add_action( 'wp_enqueue_scripts', 'mono_enqueue_work_script' );
function mono_enqueue_work_script() {
	wp_enqueue_script( 'mono-jquery', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'mono-image-height', get_stylesheet_directory_uri() . '/js/image.height.js', array( 'jquery' ), '1.0.0', true );
}
*/

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

// check if the Work content field has data
add_action( 'genesis_entry_content', 'mono_work_content', 10 );
function mono_work_content() {
	$client = get_field( 'client' );
	$website = get_field( 'website' );
	$brief = get_field( 'brief' );
		
		if( $client || $website || $brief ) {
			
			echo '<div class="gridcontainer float_aside_content">';
			echo '<div class="wrap">';
				echo '<div class="coll_main">';
						echo '' . $brief. '';
				echo '</div>';
				echo '<aside class="coll_aside">';
						echo '<h3>The Client</h3>
							  <h5>' . $client. '</h5>';
					if( $client || $website ) {
						echo '<h3 class="aside_link_title">Visit the website</h3>
							  <a href="' . $website. '" target="_blank">' . $website. '</a>';
					}
				echo '</aside>';
			echo '</div>';
			echo '</div>';
									  
		}

}

// check if the flexible content field has rows of data
add_action( 'genesis_entry_content', 'fontpage_flexible_gridset', 15 );
function fontpage_flexible_gridset() {
	
	if( have_rows('frontpage_content') ):

		// loop through the rows of data
    	while ( have_rows('frontpage_content') ) : the_row();

        	if( get_row_layout() == 'full_width_column' ):
				echo '<div ';
					
					if(get_sub_field("black_background")){
        				echo 'class="gridcontainer black_background"';
					}else{
						echo 'class="gridcontainer"';
					}
					
					echo ' style="';
					
					if(get_sub_field("background_colour")):
						echo 'background-color:';
							the_sub_field('background_colour');
						echo '; ';
					endif;
					
					if(get_sub_field("text_colour")):
						echo 'color:';
							the_sub_field('text_colour');
						echo '; ';
					endif;
					
				echo '">';
					
					echo '<div class="wrap">';
					echo '<div class="coll1">';
						if(get_sub_field("headline")):
						echo '<h1 style="';
							if(get_sub_field("text_colour")):
								echo 'color:';
									the_sub_field('text_colour');
								echo '; ';
							endif;
						echo '">';
							the_sub_field('headline');
						echo '</h1>';
						endif;
						if(get_sub_field("gridset_1_1")):
        					the_sub_field('gridset_1_1');
						endif;
					echo '</div>';
					echo '</div>';
					
				echo '</div>';
			
			elseif( get_row_layout() == 'big_full_width_column' ):
				echo '<div ';
					
					if(get_sub_field("black_background")){
        				echo 'class="gridcontainer black_background">';
					}else{
						echo 'class="gridcontainer">';
					}
					
					echo '<div class="wrap">';
					echo '<div class="coll1">';
						if(get_sub_field("headline")):
						echo '<h1 style="';
							if(get_sub_field("text_colour")):
								echo 'color:';
									the_sub_field('text_colour');
								echo '; ';
							endif;
						echo '">';
							the_sub_field('headline');
						echo '</h1>';
						endif;
						if(get_sub_field("gridset_1_1")):
        					the_sub_field('gridset_1_1');
						endif;
					echo '</div>';
					echo '</div>';
					
				echo '</div>';
				
			elseif( get_row_layout() == 'full_width_image' ):
				echo '<div class="gridcontainer image_container">';
					
						echo '<div class="coll1">';
							if(get_sub_field("big_image")):
        						echo '<img src="';
        							the_sub_field('big_image');
								echo '">';
							endif;
						echo '</div>';
					
				echo '</div>';
				
			elseif( get_row_layout() == 'two_columns_image' ):
				echo '<div class="gridcontainer image_container">';
					
						echo '<div class="coll2">';
							if(get_sub_field("image_left")):
        						echo '<img src="';
        							the_sub_field('image_left');
								echo '">';
							endif;
						echo '</div>';
						
						echo '<div class="coll2">';
							if(get_sub_field("image_right")):
        						echo '<img src="';
        							the_sub_field('image_right');
								echo '">';
							endif;
						echo '</div>';
					
				echo '</div>';
			
        	elseif( get_row_layout() == 'two_columns' ):
				echo '<div ';
					
					if(get_sub_field("black_background")){
        				echo 'class="gridcontainer black_background"';
					}else{
						echo 'class="gridcontainer"';
					}
					
					echo ' style="';
					
					if(get_sub_field("background_colour")):
						echo 'background-color:';
							the_sub_field('background_colour');
						echo '; ';
					endif;
					
					if(get_sub_field("text_colour")):
						echo 'color:';
							the_sub_field('text_colour');
						echo '; ';
					endif;
					
				echo '">';
				echo '<div class="wrap">';
					echo '<div class="coll2">';
        				the_sub_field('gridset_2_1');
					echo '</div>';
					echo '<div class="coll2">';
						the_sub_field('gridset_2_2');
					echo '</div>';
				echo '</div>';
				echo '</div>';
				
			elseif( get_row_layout() == 'three_columns' ):
				echo '<div ';
					
					if(get_sub_field("black_background")){
        				echo 'class="gridcontainer black_background"';
					}else{
						echo 'class="gridcontainer"';
					}
					
					echo ' style="';
					
					if(get_sub_field("background_colour")):
						echo 'background-color:';
							the_sub_field('background_colour');
						echo '; ';
					endif;
					
					if(get_sub_field("text_colour")):
						echo 'color:';
							the_sub_field('text_colour');
						echo '; ';
					endif;
					
				echo '">';
				echo '<div class="wrap">';
					echo '<div class="coll3">';
        				the_sub_field('gridset_3_1');
					echo '</div>';
					echo '<div class="coll3">';
						the_sub_field('gridset_3_2');
					echo '</div>';
					echo '<div class="coll3">';
						the_sub_field('gridset_3_3');
					echo '</div>';
				echo '</div>';
				echo '</div>';
				
        	endif;

    	endwhile;

	else :

    // no layouts found

	endif;

}

 
//* To remove empty markup, '<p class="entry-meta"></p>' for entries that have not been assigned to any Genre
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
add_action ( 'genesis_after_header', 'genesis_post_meta', 9 );

//* Run the Genesis loop
genesis();