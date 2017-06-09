<?php
/* Plugin Name: Mikes Message Bar
Plugin URI: http://leadsnearby.com/
Description: Creates the most amazing fixed message bar in the world without slowing down your site.

Version: 1.0
Author: Michael Layao
Author URI: http://leadsnearby.com/
License: GPLv2 or later
*/


//Include Titan Framework
require_once( 'titan-framework/titan-framework-embedder.php' );

add_action( 'tf_create_options', 'mikes_message_bar_options' );
	function mikes_message_bar_options() {
// Initialize Titan & options here
	$titan = TitanFramework::getInstance( 'mikes_message_bar' );
//Create Admin Panel
	$panel = $titan->createAdminPanel( array(
		'name' => 'Mikes Message Bar Options',
	) );
//Create Admin Options
	$panel->createOption( array(
		'name' => 'Message Bar Headline',
		'id' => 'my_text_option',
		'type' => 'text',
		'desc' => 'Your Call to Action'
		) );
	$panel->createOption( array(
		'name' => 'Message Bar Background Color',
		'id' => 'background_color',
		'type' => 'color',
		'desc' => 'Pick a color',
		'default' => '#555555',
	) );
		$panel->createOption( array(
		'type' => 'save'
	) );


//Get Saved Options
	add_action( 'after_setup_theme', 'myFunction' );
		function myFunction() {
		$titan = TitanFramework::getInstance( 'my-theme' );
		$myTextOption = $titan->getOption( 'my_text_option' );
		$mySelectOption = $titan->getOption( 'my_select_option' );
		
		// Do stuff here
	}









//End Plugin Script
}