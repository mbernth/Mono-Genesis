<?php

//* Simple Social Icon Defaults
add_filter( 'simple_social_default_styles', 'mono_social_default_styles' );
function mono_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'alignleft',
		'background_color'       => '#00aeef',
		'background_color_hover' => '#000000',
		'border_radius'          => 0,
		'icon_color'             => '#ffffff',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 42,
	);
		
	$args = wp_parse_args( $args, $defaults );
	
	return $args;
	
}