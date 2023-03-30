<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$client_post=theplus_get_option('post_type','client_post_type');
if(isset($client_post) && !empty($client_post) &&  $client_post=='plugin'){
/*------------------------------------clients post type--------------------------------*/
function theplus_ele_clients_function() {
	$post_name=theplus_get_option('post_type','client_plugin_name');	
	if(isset($post_name) && !empty($post_name)){
		$post_name=theplus_get_option('post_type','client_plugin_name');
	}else{
		$post_name='theplus_clients';
	}
	$labels = array(
		'name'                  => _x( 'Tp Clients', 'Post Type General Name', 'theplus' ),
		'singular_name'         => _x( 'Tp Clients', 'Post Type Singular Name', 'theplus' ),
		'menu_name'             => __( 'Tp Clients', 'theplus' ),
		'name_admin_bar'        => __( 'Tp Client', 'theplus' ),
		'archives'              => __( 'Item Archives', 'theplus' ),
		'attributes'            => __( 'Item Attributes', 'theplus' ),
		'parent_item_colon'     => __( 'Parent Item:', 'theplus' ),
		'all_items'             => __( 'All Items', 'theplus' ),
		'add_new_item'          => __( 'Add New Item', 'theplus' ),
		'add_new'               => __( 'Add New', 'theplus' ),
		'new_item'              => __( 'New Item', 'theplus' ),
		'edit_item'             => __( 'Edit Item', 'theplus' ),
		'update_item'           => __( 'Update Item', 'theplus' ),
		'view_item'             => __( 'View Item', 'theplus' ),
		'view_items'            => __( 'View Items', 'theplus' ),
		'search_items'          => __( 'Search Item', 'theplus' ),
		'not_found'             => __( 'Not found', 'theplus' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'theplus' ),
		'featured_image'        => __( 'Featured Image', 'theplus' ),
		'set_featured_image'    => __( 'Set featured image', 'theplus' ),
		'remove_featured_image' => __( 'Remove featured image', 'theplus' ),
		'use_featured_image'    => __( 'Use as featured image', 'theplus' ),
		'insert_into_item'      => __( 'Insert into item', 'theplus' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'theplus' ),
		'items_list'            => __( 'Items list', 'theplus' ),
		'items_list_navigation' => __( 'Items list navigation', 'theplus' ),
		'filter_items_list'     => __( 'Filter items list', 'theplus' ),
	);
	$args = array(
		'label'                 => __( 'Clients', 'theplus' ),
		'description'           => __( 'Post Type Description', 'theplus' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail','revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( $post_name, $args );

}
add_action( 'init', 'theplus_ele_clients_function', 0 );

if ( ! function_exists( 'theplus_ele_clients_category' ) ) {
function theplus_ele_clients_category() {
	$post_name=theplus_get_option('post_type','client_plugin_name');	
	if(isset($post_name) && !empty($post_name)){
		$post_name=theplus_get_option('post_type','client_plugin_name');
	}else{
		$post_name='theplus_clients';
	}
	$category_name=theplus_get_option('post_type','client_category_plugin_name');
	if(isset($category_name) && !empty($category_name)){
		$category_name=theplus_get_option('post_type','client_category_plugin_name');
	}else{
		$category_name='theplus_clients_cat';
	}
	$labels = array(
		'name'                       => 'Tp Clients Categories',
		'singular_name'              => 'Tp Clients Category',
		'menu_name'                  => 'Tp Clients Category',
		'all_items'                  => 'All Items',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Item Name',
		'add_new_item'               => 'Add New Item',
		'edit_item'                  => 'Edit Item',
		'update_item'                => 'Update Item',
		'view_item'                  => 'View Item',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( $category_name, array( $post_name ), $args );

}
add_action( 'init', 'theplus_ele_clients_category', 0 );
}
/*------------------------------------clients post type-------------------------*/
}
$testimonial_post=theplus_get_option('post_type','testimonial_post_type');
if(isset($testimonial_post) && !empty($testimonial_post) && $testimonial_post=='plugin'){
/*------------------------------------testimonials post type -----------------------*/
function theplus_ele_testimonials_func() {
$post_name=theplus_get_option('post_type','testimonial_plugin_name');	
	if(isset($post_name) && !empty($post_name)){
		$post_name=theplus_get_option('post_type','testimonial_plugin_name');
	}else{
		$post_name='theplus_testimonial';
	}
	$labels = array(
		'name'                  => _x( 'TP Testimonials', 'Post Type General Name', 'theplus' ),
		'singular_name'         => _x( 'TP Testimonials', 'Post Type Singular Name', 'theplus' ),
		'menu_name'             => __( 'TP Testimonials', 'theplus' ),
		'name_admin_bar'        => __( 'TP Testimonial', 'theplus' ),
		'archives'              => __( 'Item Archives', 'theplus' ),
		'parent_item_colon'     => __( 'Parent Item:', 'theplus' ),
		'all_items'             => __( 'All Items', 'theplus' ),
		'add_new_item'          => __( 'Add New Item', 'theplus' ),
		'add_new'               => __( 'Add New', 'theplus' ),
		'new_item'              => __( 'New Item', 'theplus' ),
		'edit_item'             => __( 'Edit Item', 'theplus' ),
		'update_item'           => __( 'Update Item', 'theplus' ),
		'view_item'             => __( 'View Item', 'theplus' ),
		'search_items'          => __( 'Search Item', 'theplus' ),
		'not_found'             => __( 'Not found', 'theplus' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'theplus' ),
		'featured_image'        => __( 'Profile Image', 'theplus' ),
		'set_featured_image'    => __( 'Set profile image', 'theplus' ),
		'remove_featured_image' => __( 'Remove profile image', 'theplus' ),
		'use_featured_image'    => __( 'Use as profile image', 'theplus' ),
		'insert_into_item'      => __( 'Insert into item', 'theplus' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'theplus' ),
		'items_list'            => __( 'Items list', 'theplus' ),
		'items_list_navigation' => __( 'Items list navigation', 'theplus' ),
		'filter_items_list'     => __( 'Filter items list', 'theplus' ),
	);
	$args = array(
		'label'                 => __( 'TP Testimonials', 'theplus' ),
		'description'           => __( 'Post Type Description', 'theplus' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail','revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_icon'				=> 'dashicons-testimonial',
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( $post_name, $args );

}
add_action( 'init', 'theplus_ele_testimonials_func', 0 );

if ( ! function_exists( 'theplus_ele_testimonial_category' ) ) {
function theplus_ele_testimonial_category() {
$post_name=theplus_get_option('post_type','testimonial_plugin_name');	
	if(isset($post_name) && !empty($post_name)){
		$post_name=theplus_get_option('post_type','testimonial_plugin_name');
	}else{
		$post_name='theplus_testimonial';
	}
$category_name=theplus_get_option('post_type','testimonial_category_plugin_name');
	if(isset($category_name) && !empty($category_name)){
		$category_name=theplus_get_option('post_type','testimonial_category_plugin_name');
	}else{
		$category_name='theplus_testimonial_cat';
	}
	$labels = array(
		'name'                       => 'TP Testimonials Categories',
		'singular_name'              => 'TP Testimonials Category',
		'menu_name'                  => 'TP Testimonials Category',
		'all_items'                  => 'All Items',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Item Name',
		'add_new_item'               => 'Add New Item',
		'edit_item'                  => 'Edit Item',
		'update_item'                => 'Update Item',
		'view_item'                  => 'View Item',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( $category_name, array( $post_name ), $args );

}
add_action( 'init', 'theplus_ele_testimonial_category', 0 );
}
/*------------------------------------testimonials post type -----------------------*/
}
/*------------------------------------Team member post type-------------------------*/
$team_member_post=theplus_get_option('post_type','team_member_post_type');
if(isset($team_member_post) && !empty($team_member_post) && $team_member_post=='plugin'){
function theplus_ele_team_member_function() {
$post_name=theplus_get_option('post_type','team_member_plugin_name');	
	if(isset($post_name) && !empty($post_name)){
		$post_name=theplus_get_option('post_type','team_member_plugin_name');
	}else{
		$post_name='theplus_team_member';
	}
	$labels = array(
		'name'                  => _x( 'TP Team Members', 'Post Type General Name', 'theplus' ),
		'singular_name'         => _x( 'TP Team Member', 'Post Type Singular Name', 'theplus' ),
		'menu_name'             => __( 'TP Team Member', 'theplus' ),
		'name_admin_bar'        => __( 'TP Team Member', 'theplus' ),
		'archives'              => __( 'Item Archives', 'theplus' ),
		'attributes'            => __( 'Item Attributes', 'theplus' ),
		'parent_item_colon'     => __( 'Parent Item:', 'theplus' ),
		'all_items'             => __( 'All Items', 'theplus' ),
		'add_new_item'          => __( 'Add New Item', 'theplus' ),
		'add_new'               => __( 'Add New', 'theplus' ),
		'new_item'              => __( 'New Item', 'theplus' ),
		'edit_item'             => __( 'Edit Item', 'theplus' ),
		'update_item'           => __( 'Update Item', 'theplus' ),
		'view_item'             => __( 'View Item', 'theplus' ),
		'view_items'            => __( 'View Items', 'theplus' ),
		'search_items'          => __( 'Search Item', 'theplus' ),
		'not_found'             => __( 'Not found', 'theplus' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'theplus' ),
		'featured_image'        => __( 'Featured Image', 'theplus' ),
		'set_featured_image'    => __( 'Set featured image', 'theplus' ),
		'remove_featured_image' => __( 'Remove featured image', 'theplus' ),
		'use_featured_image'    => __( 'Use as featured image', 'theplus' ),
		'insert_into_item'      => __( 'Insert into item', 'theplus' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'theplus' ),
		'items_list'            => __( 'Items list', 'theplus' ),
		'items_list_navigation' => __( 'Items list navigation', 'theplus' ),
		'filter_items_list'     => __( 'Filter items list', 'theplus' ),
	);
	$args = array(
		'label'                 => __( 'TP Team Member', 'theplus' ),
		'description'           => __( 'Post Type Description', 'theplus' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail','revisions', 'custom-fields', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,	
		'menu_icon'   => 'dashicons-id-alt',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( $post_name, $args );

}
add_action( 'init', 'theplus_ele_team_member_function', 0 );

if ( ! function_exists( 'theplus_ele_team_member_category' ) ) {
function theplus_ele_team_member_category() {
	$post_name=theplus_get_option('post_type','team_member_plugin_name');	
	if(isset($post_name) && !empty($post_name)){
		$post_name=theplus_get_option('post_type','team_member_plugin_name');
	}else{
		$post_name='theplus_team_member';
	}
	$category_name=theplus_get_option('post_type','team_member_category_plugin_name');
	if(isset($category_name) && !empty($category_name)){
		$category_name=theplus_get_option('post_type','team_member_category_plugin_name');
	}else{
		$category_name='theplus_team_member_cat';
	}
	$labels = array(
		'name'                       => 'Team Member Categories',
		'singular_name'              => 'Team Member Category',
		'menu_name'                  => 'TP Team Member Category',
		'all_items'                  => 'All Items',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Item Name',
		'add_new_item'               => 'Add New Item',
		'edit_item'                  => 'Edit Item',
		'update_item'                => 'Update Item',
		'view_item'                  => 'View Item',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( $category_name, array( $post_name ), $args );

}
add_action( 'init', 'theplus_ele_team_member_category', 0 );
}
}
/*------------------------------------team meamber post type End ------------------*/