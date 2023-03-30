<?php
add_filter( 'cmb_meta_boxes', 'theplus_ele_clients_setting_metaboxes' );


function theplus_ele_clients_setting_metaboxes( array $meta_boxes ) {

	$prefix = 'theplus_clients_';
	$post_name=theplus_client_post_name();
	$meta_boxes[] = array(
		'id'         => 'clients_setting_metaboxes',
		'title'      => __('TP Clients options', 'theplus'),
		'pages'      => array($post_name),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, 
		'fields'     => array(
				array(
			       'name'	=> __('Url', 'theplus'),
         		       'desc'	=> '',
        		       'id'	=> $prefix . 'url',
         		       'type'	=> 'text_url',
					   'default' => '#',
           		),				
		),
	);	

	return $meta_boxes;
}
