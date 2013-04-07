<?php

/*
* This file declares the metaboxes to add to the post edit screens.
* and initialises the metabox class to load them into wp
*
* To learn all the available options for metaboxes, please see the
* example-functions.php file in pxjn/metaboxes folder
*/

/***************************************************************
* Function pxjn_metaboxes()
* Defines the additional metaboxes you want to add.
***************************************************************/
function pxjn_metaboxes( $meta_boxes ) {
	
	/* sets a prefix for all metaboxes */
	$prefix = 'pxjn_';
	
	/* repeat this for each metabox you require */
	$meta_boxes[] = array(
		'id' => 'test_metabox',
		'title' => 'Test Metabox',
		'pages' => array( 'page' ), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Test Text',
				'desc' => 'field description (optional)',
				'id' => $prefix . 'test_text',
				'type' => 'text'
			),
		),
	);

	return $meta_boxes;
}

add_filter( 'cmb_meta_boxes', 'pxjn_metaboxes' );

/***************************************************************
* Function pxjn_initialize_meta_boxes()
* Initialises the metaboxes class and adds it to wp ready to
* load in your metaboxes.
***************************************************************/
function pxjn_initialize_meta_boxes() {
	
	/* check whether metabox class does not already exist */
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		
		/* load the metaboxes init file */
		require_once( 'pxjn/metaboxes/init.php' );
	
	}
	
}

add_action( 'init', 'pxjn_initialize_meta_boxes', 9999 );