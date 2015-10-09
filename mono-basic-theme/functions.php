<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'mono', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'mono' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Mono Basic Theme', 'mono' ) );
define( 'CHILD_THEME_URL', 'https://github.com/mbernth/Mono-Genesis' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'mono_enqueue_scripts_styles' );
function mono_enqueue_scripts_styles() {

	wp_enqueue_script( 'mono-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );

}

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

/** Conditional html element classes */
remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', 'child_do_doctype' );
function child_do_doctype() {
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]> <html class="ie6" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <?php
}

//* Add custom meta tag for mobile browsers
add_action( 'genesis_meta', 'mono_viewport_meta_tag' );
function mono_viewport_meta_tag() {
	echo '<meta name="HandheldFriendly" content="True">';
	echo '<meta name="MobileOptimized" content="320">';
}
// Change favicon location and add touch icons
add_filter( 'genesis_pre_load_favicon', 'mono_favicon_filter' );
function mono_favicon_filter( $favicon ) {
	echo '<link rel="shortcut icon" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon.ico" type="image/x-icon" />';
	echo '<link rel="apple-touch-icon" sizes="57x57" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-57x57.png">';
	echo '<link rel="apple-touch-icon" sizes="60x60" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-60x60.png">';
	echo '<link rel="apple-touch-icon" sizes="72x72" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-72x72.png">';
	echo '<link rel="apple-touch-icon" sizes="76x76" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-76x76.png">';
	echo '<link rel="apple-touch-icon" sizes="114x114" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-114x114.png">';
	echo '<link rel="apple-touch-icon" sizes="120x120" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-120x120.png">';
	echo '<link rel="apple-touch-icon" sizes="144x144" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-144x144.png">';
	echo '<link rel="apple-touch-icon" sizes="152x152" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-152x152.png">';
	echo '<link rel="apple-touch-icon" sizes="180x180" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-icon-180x180.png">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon-16x16.png" sizes="16x16">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon-32x32.png" sizes="32x32">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/favicon-96x96.png" sizes="96x96">';
	echo '<link rel="icon" type="image/png" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/android-chrome-192x192.png" sizes="192x192">';
	echo '<meta name="msapplication-square70x70logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//smalltile.png" />';
	echo '<meta name="msapplication-square150x150logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//mediumtile.png" />';
	echo '<meta name="msapplication-wide310x150logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//widetile.png" />';
	echo '<meta name="msapplication-square310x310logo" content="'.get_bloginfo( 'stylesheet_directory' ).'/images//largetile.png" />';

}

//* Unregister the header right widget area
unregister_sidebar( 'header-right' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Remove output of primary navigation right extras
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header', 'genesis_do_subnav', 5 );

//* Add secondary-nav class if secondary navigation is used
add_filter( 'body_class', 'crone_secondary_nav_class' );
function crone_secondary_nav_class( $classes ) {

	$menu_locations = get_theme_mod( 'nav_menu_locations' );

	if ( ! empty( $menu_locations['secondary'] ) ) {
		$classes[] = 'secondary-nav';
	}
	return $classes;

}

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add custom body class to the head
add_filter( 'body_class', 'mono_custom_body_class' );
function mono_custom_body_class( $classes ) {

	$classes[] = 'mono';
	return $classes;

}

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_after_header', 'genesis_do_subnav', 15 );

//* Hook before header widget area above header
add_action( 'genesis_before_header', 'beautiful_before_header' );
function beautiful_before_header() {

	genesis_widget_area( 'before-header', array(
		'before' => '<div class="before-header" class="widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'before-header',
	'name'        => __( 'Before Header', 'mono' ),
	'description' => __( 'This is the before header widget area.', 'mono' ),
) );

//* Add svg upload
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );	

// check if the flexible content field has rows of data
function mono_flexible_gridset() {
	
	if( have_rows('content') ):

		// loop through the rows of data
    	while ( have_rows('content') ) : the_row();

        	if( get_row_layout() == 'full_width_column' ):
				echo '<div class="gridcontainer">';
					echo '<div class="coll1">';
        				the_sub_field('gridset_1_1');
					echo '</div>';
				echo '</div>';
				
        	elseif( get_row_layout() == 'two_columns' ):
				echo '<div class="gridcontainer">';
					echo '<div class="coll2">';
        				the_sub_field('gridset_2_1');
					echo '</div>';
					echo '<div class="coll2">';
						the_sub_field('gridset_2_2');
					echo '</div>';
				echo '</div>';
				
			elseif( get_row_layout() == 'three_columns' ):
				echo '<div class="gridcontainer">';
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
				
			elseif( get_row_layout() == 'four_columns' ):
				echo '<div class="gridcontainer">';
					echo '<div class="coll4">';
        				the_sub_field('gridset_4_1');
					echo '</div>';
					echo '<div class="coll4">';
						the_sub_field('gridset_4_2');
					echo '</div>';
					echo '<div class="coll4">';
						the_sub_field('gridset_4_3');
					echo '</div>';
					echo '<div class="coll4">';
						the_sub_field('gridset_4_4');
					echo '</div>';
				echo '</div>';
				
			elseif( get_row_layout() == 'five_columns' ):
				echo '<div class="gridcontainer">';
					echo '<div class="coll5">';
        				the_sub_field('gridset_5_1');
					echo '</div>';
					echo '<div class="coll5">';
						the_sub_field('gridset_5_2');
					echo '</div>';
					echo '<div class="coll5">';
						the_sub_field('gridset_5_3');
					echo '</div>';
					echo '<div class="coll5">';
						the_sub_field('gridset_5_4');
					echo '</div>';
					echo '<div class="coll5">';
						the_sub_field('gridset_5_5');
					echo '</div>';
				echo '</div>';
				
			elseif( get_row_layout() == 'six_columns' ):
				echo '<div class="gridcontainer">';
					echo '<div class="coll6">';
        				the_sub_field('gridset_6_1');
					echo '</div>';
					echo '<div class="coll6">';
						the_sub_field('gridset_6_2');
					echo '</div>';
					echo '<div class="coll6">';
						the_sub_field('gridset_6_3');
					echo '</div>';
					echo '<div class="coll6">';
						the_sub_field('gridset_6_4');
					echo '</div>';
					echo '<div class="coll6">';
						the_sub_field('gridset_6_5');
					echo '</div>';
					echo '<div class="coll6">';
						the_sub_field('gridset_6_6');
					echo '</div>';
				echo '</div>';
				
        	endif;

    	endwhile;

	else :

    // no layouts found

	endif;

}
add_action( 'genesis_entry_content', 'mono_flexible_gridset', 15 );

//* STICK FOOTER AT THE BUTTOM

//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'sk_sticky_footer' );
function sk_sticky_footer() {
	wp_enqueue_script( 'sticky-footer', get_bloginfo( 'stylesheet_directory' ) . '/js/sticky-footer.js', array( 'jquery' ), '1.0.0' );
 
}

//*  Move Footer widgets and Footer outside Site Container 
//* Reposition the footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_after', 'genesis_footer_widget_areas' );
 
//* Reposition the footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
add_action( 'genesis_after', 'genesis_footer_markup_open', 11 );
add_action( 'genesis_after', 'genesis_do_footer', 12 );
add_action( 'genesis_after', 'genesis_footer_markup_close', 13 );