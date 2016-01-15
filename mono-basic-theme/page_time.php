<?php
/**
 * This file adds the Landing template to the Danish Justice Foundation Pro Theme.
 *
 * @author mono voce aps
 * @package Mono Basic Theme
 * @subpackage Customizations
*/

/*
Template Name: Time test
*/

// check if the flexible content field has rows of data
add_action( 'genesis_entry_content', 'mono_time_test', 15 );
function mono_time_test() {
	$time = get_field( 'my_date' );
	$today = date('d.m.Y');
	$events = get_field( 'event_roll' );
	
	if ( is_single() || is_page()) {
		
		echo '<h2>Time Test</h2>';
		echo '<p>Current date: ' . $today . '</p>';
		
		if($events) {
			echo '<h3>Upcoming</h3>';
			foreach($events as $event) {
				
				if ( $event['my_date'] >= $today ) {
					
					echo '<p>' . $event['my_date']. '</p>';
					
				// }elseif ( $event['my_date'] >= $today ){
					
				// echo '<p><strong>' . $event['my_date']. '</strong></p>';
					
				}
				
			}
			
		}
		
	}
}

//* Run the Genesis loop
genesis();
