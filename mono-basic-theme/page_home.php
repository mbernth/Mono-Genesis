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

//* Remove the entry title
remove_action( 'genesis_after_header', 'genesis_do_post_title', 9 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove site footer widgets
// remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

//* Remove site footer elements
// remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
// remove_action( 'genesis_footer', 'genesis_do_footer' );
// remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );


// Fullscreen Slit Slider Widget
add_action( 'genesis_entry_content', 'full_screen_slider', 10 );
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
						if( $row['logo'] ){
							echo 	'<img src="' . $row['logo']. '">';
						}
						if( $row['headline'] ){
							echo 	'<h3>' . $row['headline']. '</h3>';
						}
						if( $row['text'] ){
							echo 	'<div class="slider-text">' . $row['text']. '</div>';
						}
						if( $row['link'] ){
							echo	'<div class="slider-link"><a class="button" href="' . $row['link']. '">View the case</a></div>';
						}
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

//* Run the Genesis loop
genesis();