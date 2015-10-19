<?php

//* Simple Social Icon Defaults
add_filter( 'simple_social_default_styles', 'mono_social_default_styles' );
function mono_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'center',
		'background_color'       => '#ffffff',
		'background_color_hover' => '#231f20',
		'border_radius'          => 0,
		'icon_color'             => '#000000',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 42,
	);
		
	$args = wp_parse_args( $args, $defaults );
	
	return $args;
	
}