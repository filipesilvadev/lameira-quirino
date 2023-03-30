<?php
add_filter( 'cmb_meta_boxes', 'theplus_ele_team_memmber_setting_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

function theplus_ele_team_memmber_setting_metaboxes( array $meta_boxes ) {

	$prefix = 'theplus_tm_';
	$post_name=theplus_team_member_post_name();
	$meta_boxes[] = array(
		'id'         => 'team_memmber_setting_metaboxes',
		'title'      => __('TP Team member options', 'theplus'),
		'pages'      => array($post_name),
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, 
		'fields'     => array(
				array(
			       'name'	=> __('Custom Url', 'theplus'),
         		       'desc'	=> '',
        		       'id'	=> $prefix . 'custom_url',
         		       'type'	=> 'text_url',
           		),
				array(
			       'name'	=> __('Designation', 'theplus'),
         		       'desc'	=> '',
        		       'id'	=> $prefix . 'designation',
         		       'type'	=> 'text_medium',
           		),
           		array(
			       'name'	=> __('Website Url', 'theplus'),
         		       'desc'	=> '',
        		       'id'	=> $prefix . 'website_url',
         		       'type'	=> 'text',
           		),
				array(
			       'name'	=> __('Website Url', 'theplus'),
         		       'desc'	=> '',
        		       'id'	=> $prefix . 'website_url',
         		       'type'	=> 'text',
           		),
           		array(
	           		'name' => __( 'Facebook Link', 'theplus' ),
	           	        'type' => 'text',
	           	        'id'	=> $prefix . 'face_link',
           		),
           		array(
			       'name'	=> __('Google plus Link', 'theplus'),
         		       'desc'	=> '',
        		       'id'	=> $prefix . 'googgle_link',
         		       'type'	=> 'text',
           		),
           		array(
	           		'name' => __( 'Instagram Link', 'theplus' ),
	           	        'type' => 'text',
	           	        'id'	=> $prefix . 'insta_link',
           		),
          		array(
	           		'name' => __( 'Twitter Link', 'theplus' ),
	           	        'type' => 'text',
	           	        'id'	=> $prefix . 'twit_link',
           		),
				array(
	           		'name' => __( 'Linkedin Link', 'theplus' ),
	           	        'type' => 'text',
	           	        'id'	=> $prefix . 'linked_link',
           		),
		),
	);	

	return $meta_boxes;
}
