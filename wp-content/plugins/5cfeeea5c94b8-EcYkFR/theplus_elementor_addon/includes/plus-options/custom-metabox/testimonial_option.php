<?php
add_filter( 'cmb_meta_boxes', 'theplus_ele_testimonial_setting_metaboxes' );


function theplus_ele_testimonial_setting_metaboxes( array $meta_boxes ) {

	$prefix = 'theplus_testimonial_';
	$post_name=theplus_testimonial_post_name();
	$meta_boxes[] = array(
		'id'         => 'testimonial_setting_metaboxes',
		'title'      => __('ThePlus Testimonial Options', 'theplus'),
		'pages'      => array($post_name),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, 
		'fields'     => array(
				array(
			       'name'	=> __('Author Text', 'theplus'),
         		       'desc'	=> '',
        		       'id'	=> $prefix . 'author_text',
         		       'type'	=> 'wysiwyg',
					   'options' => array(
							'wpautop' => false,
							'media_buttons' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 7),
						),
           		),
				array(
			       'name'	=> __('Title', 'theplus'),
         		       'desc'	=>  __('Enter title of testimonial.', 'theplus'),
        		       'id'	=> $prefix . 'title',
         		       'type'	=> 'text',
           		),
				array(
			       'name'	=> __('Logo Upload', 'theplus'),
         		       'desc'	=> '',
        		       'id'	=> $prefix . 'logo',
         		       'type'	=> 'file',
           		),
				array(
			       'name'	=> __('Designation', 'theplus'),
         		       'desc'	=>  __('Enter author Designation', 'theplus'),
        		       'id'	=> $prefix . 'designation',
         		       'type'	=> 'text',
           		),
		),
	);	

	return $meta_boxes;
}
