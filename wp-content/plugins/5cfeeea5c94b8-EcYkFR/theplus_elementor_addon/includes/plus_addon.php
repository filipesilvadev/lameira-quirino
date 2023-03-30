<?php 
	if ( ! defined( 'ABSPATH' ) ) { exit; }
		
	global $theplus_options,$post_type_options;
		
add_image_size( 'tp-image-grid', 700, 700, true);


function theplus_get_thumb_url(){
	return THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
}

class Theplus_MetaBox {
	
	public static function get($name) {
		global $post;
		
		if (isset($post) && !empty($post->ID)) {
			return get_post_meta($post->ID, $name, true);
		}
		
		return false;
	}
}
function theplus_get_option($options_type,$field){
	$theplus_options=get_option( 'theplus_options' );
	$post_type_options=get_option( 'post_type_options' );
	$values='';
	if($options_type=='general'){
		if(isset($theplus_options[$field]) && !empty($theplus_options[$field])){
			$values=$theplus_options[$field];
		}
	}
	if($options_type=='post_type'){
		if(isset($post_type_options[$field]) && !empty($post_type_options[$field])){
			$values=$post_type_options[$field];
		}
	}
	return $values;
}
function theplus_testimonial_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$testi_post_type=$post_type_options['testimonial_post_type'];
	$post_name='theplus_testimonial';
	if(isset($testi_post_type) && !empty($testi_post_type)){
		if($testi_post_type=='themes'){
			$post_name=theplus_get_option('post_type','testimonial_theme_name');
		}elseif($testi_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','testimonial_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','testimonial_plugin_name');
			}
		}elseif($testi_post_type=='themes_pro'){
			$post_name='testimonial';
		}
	}else{
		$post_name='theplus_testimonial';
	}
	return $post_name;
}
function theplus_testimonial_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$testi_post_type=$post_type_options['testimonial_post_type'];
	$taxonomy_name='theplus_testimonial_cat';
	if(isset($testi_post_type) && !empty($testi_post_type)){
		if($testi_post_type=='themes'){
			$taxonomy_name=theplus_get_option('post_type','testimonial_category_name');
		}else if($testi_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','testimonial_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$taxonomy_name=theplus_get_option('post_type','testimonial_category_plugin_name');
			}
		}elseif($testi_post_type=='themes_pro'){
			$taxonomy_name='testimonial_category';
		}
	}else{
		$taxonomy_name='theplus_testimonial_cat';
	}
	return $taxonomy_name;
}
function theplus_client_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$client_post_type=$post_type_options['client_post_type'];
	$post_name='theplus_clients';
	if(isset($client_post_type) && !empty($client_post_type)){
		if($client_post_type=='themes'){
			$post_name=theplus_get_option('post_type','client_theme_name');
		}elseif($client_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','client_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','client_plugin_name');
			}
		}elseif($client_post_type=='themes_pro'){
			$post_name='clients';
		}
	}else{
		$post_name='theplus_clients';
	}
	return $post_name;
}
function theplus_client_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$client_post_type=$post_type_options['client_post_type'];
	$post_name='theplus_clients_cat';
	if(isset($client_post_type) && !empty($client_post_type)){
		if($client_post_type=='themes'){
			$post_name=theplus_get_option('post_type','client_category_name');
		}else if($client_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','client_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','client_category_plugin_name');
			}
		}elseif($client_post_type=='themes_pro'){
			$post_name='clients_category';
		}
	}else{
		$post_name='theplus_clients_cat';
	}
	return $post_name;
}
function theplus_team_member_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$team_post_type=$post_type_options['team_member_post_type'];
	$post_name='theplus_team_member';
	if(isset($team_post_type) && !empty($team_post_type)){
		if($team_post_type=='themes'){
			$post_name=theplus_get_option('post_type','team_member_theme_name');
		}elseif($team_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','team_member_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','team_member_plugin_name');
			}
		}elseif($team_post_type=='themes_pro'){
			$post_name='team_member';
		}
	}else{
		$post_name='theplus_team_member';
	}
	return $post_name;
}
function theplus_team_member_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$team_post_type=$post_type_options['team_member_post_type'];
	$taxonomy_name='theplus_team_member_cat';
	if(isset($team_post_type) && !empty($team_post_type)){
		if($team_post_type=='themes'){
			$taxonomy_name=theplus_get_option('post_type','team_member_category_name');
		}else if($team_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','team_member_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$taxonomy_name=theplus_get_option('post_type','team_member_category_plugin_name');
			}
		}elseif($team_post_type=='themes_pro'){
			$taxonomy_name='team_member_category';
		}
	}else{
		$taxonomy_name='theplus_team_member_cat';
	}
	return $taxonomy_name;
}
function theplus_styling_option(){	
	$theplus_styling_data=get_option( 'theplus_styling_data' );
	
	$css_rules='';
	
	$css_rules .='<style>';	
	
	if(!empty($theplus_styling_data['theplus_custom_css_editor'])){
		$theplus_custom_css_editor=$theplus_styling_data['theplus_custom_css_editor'];
		$css_rules .=$theplus_custom_css_editor;
	}
	$css_rules .='</style>';
	
	if(!empty($theplus_styling_data['theplus_custom_js_editor'])){
		$css_rules .= '<script>';
			$theplus_custom_js_editor=$theplus_styling_data['theplus_custom_js_editor'];
			$css_rules .=$theplus_custom_js_editor;
		$css_rules .= '</script>';
	}
	echo $css_rules;
}
add_action('wp_head', 'theplus_styling_option');

function theplus_scroll_animation(){
	
	$theplus_data=get_option( 'theplus_api_connection_data' );
		
	if(isset($theplus_data['scroll_animation_offset']) && !empty($theplus_data['scroll_animation_offset']) && $theplus_data['scroll_animation_offset']!=0){
		$value= $theplus_data['scroll_animation_offset'].'%';
	}else if(isset($theplus_data['scroll_animation_offset']) && !empty($theplus_data['scroll_animation_offset']) && $theplus_data['scroll_animation_offset']==0){
		$value= '85%';
	}else{
		$value= '85%';
	}
	
	return $value;
}
function theplus_excerpt($limit) {
	 if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
            WPBMap::addAllMappedShortcodes();
        }
	global $post;
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
function theplus_loading_image_grid($postid='',$type=''){
	global $post;
	$content_image='';
	if($type!='background'){
		
		$image_url=THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
			$content_image='<img src="'.esc_url($image_url).'" alt="'.esc_attr(get_the_title()).'"/>';
			return $content_image;
	}elseif($type=='background'){
		$image_url=THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
		$data_src='style="background:url('.esc_url($image_url).') #f7f7f7;" ';
		return $data_src;
	}
}
function theplus_loading_bg_image($postid=''){
	global $post;
	$content_image='';
	if(!empty($postid)){
		$featured_image=get_the_post_thumbnail_url($postid,'full');
		if(empty($featured_image)){
			$featured_image=theplus_get_thumb_url();
		}
		$content_image='style="background:url('.esc_url($featured_image).') #f7f7f7;"';
		return $content_image;
	}else{
	return $content_image;
	}
}
function theplus_array_flatten($array) {
	  if (!is_array($array)) { 
		return FALSE; 
	  } 
	  $result = array(); 
	  foreach ($array as $key => $value) { 
		if (is_array($value)) { 
		  $result = array_merge($result, theplus_array_flatten($value)); 
		} 
		else { 
		  $result[$key] = $value; 
		} 
	  } 
	  return $result; 
}
function theplus_createSlug($str, $delimiter = '-'){
	
	$slug=preg_replace('/[^A-Za-z0-9-]+/', $delimiter, $str);
	return $slug;
	
} 
	/*----------------------------load more posts ---------------------------*/
function theplus_more_post_ajax(){
		global $post;
		ob_start();
		$post_type=$_POST["post_type"];
		$post_load=$_POST["post_load"];
		$texonomy_category=$_POST["texonomy_category"];
		$layout=$_POST["layout"];
		$offset = $_POST["offset"];
		$display_post = $_POST["display_post"];
		$category=$_POST["category"];
		$post_tags=$_POST["post_tags"];
		$desktop_column=$_POST["desktop_column"];
		$tablet_column=$_POST["tablet_column"];
		$mobile_column=$_POST["mobile_column"];
		$style= $_POST["style"];
		$style_layout= $_POST["style_layout"];
		$filter_category=$_POST["filter_category"];
		$order_by=$_POST["order_by"];
		$post_order=$_POST["post_order"];
		$animated_columns=$_POST["animated_columns"];
		$post_load_more=$_POST["post_load_more"];
		$display_cart_button=$_POST["cart_button"];
		$paged=$_POST["paged"];
		$metro_column=$_POST["metro_column"];
		$metro_style=$_POST["metro_style"];
		$responsive_tablet_metro=$_POST["responsive_tablet_metro"];
		$tablet_metro_column=$_POST["tablet_metro_column"];
		$tablet_metro_style=$_POST["tablet_metro_style"];
		
		$display_post_title=$_POST["display_post_title"];
		
		$display_post_meta=$_POST["display_post_meta"];
		$post_meta_tag_style=$_POST["post_meta_tag_style"];
		$display_excerpt=$_POST["display_excerpt"];
		$post_excerpt_count=$_POST["post_excerpt_count"];
		$display_post_category=$_POST["display_post_category"];
		$post_category_style=$_POST["post_category_style"];
		$featured_image_type=$_POST["featured_image_type"];
		
		$display_button = $_POST['display_button'];
		$button_style = $_POST['button_style'];
		$before_after = $_POST['before_after'];
		$button_text = $_POST['button_text'];
		$button_icon_style = $_POST['button_icon_style'];
		$button_icon = $_POST['button_icon'];
		$button_icons_mind = $_POST['button_icons_mind'];
		
		$desktop_class=$tablet_class=$mobile_class='';
		if($layout!='carousel' && $layout!='metro'){
			$desktop_class='tp-col tp-col-md-'.esc_attr($desktop_column);
			$tablet_class='tp-col-sm-'.esc_attr($tablet_column);
			$mobile_class='tp-col-xs-'.esc_attr($mobile_column);
		}
		
		$j=1;
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => $post_load_more,
			$texonomy_category => $category,
			'offset' => $offset,
			'orderby'	=>$order_by,
			'post_status' =>'publish',
			'order'	=>$post_order
		);
		
		if ( '' !== $post_tags && $post_type=='post') {
			$post_tags =explode(",",$post_tags);
			$args['tax_query'] = array(
				'relation' => 'AND',
				array(
					'taxonomy'         => 'post_tag',
					'terms'            => $post_tags,
					'field'            => 'term_id',
					'operator'         => 'IN',
					'include_children' => true,
				),
			);
		}
		
		$ji=($post_load_more*$paged)-$post_load_more+$display_post+1;
		$ij='';
		$tablet_metro_class=$tablet_ij='';
		$loop = new WP_Query($args);		
			if ( $loop->have_posts() ) :
				while ($loop->have_posts()) {
					$loop->the_post();
					
					//read more button
					$the_button='';
					if($display_button == 'yes'){
						
						$btn_uid=uniqid('btn');
						$data_class= $btn_uid;
						$data_class .=' button-'.$button_style.' ';
						
						$the_button ='<div class="pt-plus-button-wrapper">';
							$the_button .='<div class="button_parallax">';
								$the_button .='<div class="ts-button">';
									$the_button .='<div class="pt_plus_button '.$data_class.'">';
										$the_button .= '<div class="animted-content-inner">';
											$the_button .='<a href="'.esc_url(get_the_permalink()).'" class="button-link-wrap" role="button" rel="nofollow">';
											$the_button .= include THEPLUS_PATH. 'includes/blog/post-button.php'; 
											$the_button .='</a>';
										$the_button .='</div>';
									$the_button .='</div>';
								$the_button .='</div>';
							$the_button .='</div>';
						$the_button .='</div>';	
					}
					
					
					if($post_load=='blogs'){
						include THEPLUS_PATH ."includes/ajax-load-post/blog-style.php";
					}
					if($post_load=='clients'){
						include THEPLUS_PATH ."includes/ajax-load-post/client-style.php";
					}
					if($post_load=='portfolios'){
						include THEPLUS_PATH ."includes/ajax-load-post/portfolio-style.php";
					}
					if($post_load=='products'){
						include THEPLUS_PATH ."includes/ajax-load-post/product-style.php";
					}
					$ji++;
				}
				$content = ob_get_contents();
				ob_end_clean();
			endif;
		wp_reset_postdata();
		echo $content;
		exit;
		ob_end_clean();
	}
add_action('wp_ajax_theplus_more_post','theplus_more_post_ajax');
add_action('wp_ajax_nopriv_theplus_more_post', 'theplus_more_post_ajax');

function theplus_key_notice_ajax(){
	if ( get_option( 'theplus-notice-dismissed' ) !== false ) {
		update_option( 'theplus-notice-dismissed', '1' );
	} else {
		$deprecated = null;
		$autoload = 'no';
		add_option( 'theplus-notice-dismissed','1', $deprecated, $autoload );
	}
}
add_action('wp_ajax_theplus_key_notice','theplus_key_notice_ajax');
add_action('wp_ajax_nopriv_theplus_key_notice', 'theplus_key_notice_ajax');
	
//post pagination
function theplus_pagination($pages = '', $range = 2)
	{  
		$showitems = ($range * 2)+1;  
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == '')
		{
			global $wp_query;
			if( $wp_query->max_num_pages <= 1 )
			return;
		
			$pages = $wp_query->max_num_pages;
			/*if(!$pages)
			{
				$pages = 1;
			}*/
			$pages = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		}   
		
		if(1 != $pages)
		{
			$paginate ="<div class=\"theplus-pagination\">";
			if ( get_previous_posts_link() ){
				$paginate .= '<div class="paginate-prev">'.get_previous_posts_link('<i class="fa fa-long-arrow-left" aria-hidden="true"></i> PREV').'</div>';
			}
			
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages && ( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					$paginate .= ($paged == $i)? "<span class=\"current\">".esc_html($i)."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".esc_html($i)."</a>";
				}
			}
			if ( get_next_posts_link() ){
				$paginate .='<div class="paginate-next">'.get_next_posts_link('NEXT <i class="fa fa-long-arrow-right" aria-hidden="true"></i>',1).'</div>';
			}
			
			$paginate .="</div>\n";
			return $paginate;
		}
}


function theplus_mailchimp_subscriber_message( $email, $status, $list_id, $api_key, $merge_fields = array('FNAME' => '','LNAME' => '') ){
    $data = array(
        'apikey'        => $api_key,
        'email_address' => $email,
        'status'        => $status,
        'merge_fields'  => $merge_fields
    );
    $mch_api = curl_init();
 
    curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
    curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
    curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
    curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
    curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
    curl_setopt($mch_api, CURLOPT_POST, true);
    curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
 
    $result = curl_exec($mch_api);
    return $result;
}
function plus_mailchimp_subscribe(){
	$options = get_option( 'theplus_api_connection_data' );
	$list_id = (!empty($options['theplus_mailchimp_id'])) ? $options['theplus_mailchimp_id'] : '';
	$api_key = (!empty($options['theplus_mailchimp_api'])) ? $options['theplus_mailchimp_api'] : ''; // YOUR MAILCHIMP API KEY HERE
	$result  = json_decode( theplus_mailchimp_subscriber_message($_POST['email'], 'subscribed', $list_id, $api_key ) );
	
	if( $result->status == 400 ){
		echo 'incorrect';
	} elseif( $result->status == 'subscribed' ){
		echo 'correct';
	} else {
		echo 'not-verify';
	}
	die;
}
add_action('wp_ajax_plus_mailchimp_subscribe','plus_mailchimp_subscribe');
add_action('wp_ajax_nopriv_plus_mailchimp_subscribe', 'plus_mailchimp_subscribe');

if(!function_exists('theplus_api_check_license')){
	function theplus_api_check_license($tp_api_key='',$home_url='') {
		$store_url = 'https://store.theplusaddons.com';
		$item_name = 'The Plus Addons for Elementor';
		$option_name = 'theplus_verified';
		$api_params = array(
			'edd_action' => 'check_license',
			'license' => $tp_api_key,
			'item_name' => urlencode( $item_name ),
			'url' => $home_url
		);
		$response = wp_remote_post( $store_url, array( 'body' => $api_params, 'timeout' => 150, 'sslverify' => false ) );
		if ( is_wp_error( $response ) ) {
			return false;
		}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		if( $license_data->success == true ) {
			$expire_date=$license_data->expires;
			if($expire_date!='lifetime'){
				$expire = strtotime($expire_date);
			}else{
				$expire = $expire_date;
			}
			$today_date = strtotime("today midnight");
			if($expire !='lifetime' && $today_date >= $expire && $license_data->license == 'valid'){
				$verify= '0' ;
				theplus_check_api_options('theplus_verified',$verify,$expire);
				
				return 'expired';
			}
			if( $license_data->license == 'valid' ) {
				$verify = '1' ;
				theplus_check_api_options('theplus_verified',$verify,$expire);
				
				return 'valid';
			}elseif($license_data->license == 'expired' ){
				$verify = '0' ;
				theplus_check_api_options('theplus_verified',$verify,$expire);
				
				return 'expired';
			} else {
				$verify = '0' ;
				theplus_check_api_options('theplus_verified',$verify,$expire);
				
				return 'invalid';
			}
		}else{
			$verify = '0' ;
			theplus_check_api_options('theplus_verified',$verify);
			
			return 'success_false';
		}
	}
}

if(!function_exists('theplus_api_check_license_code')){
	function theplus_api_check_license_code($tp_api_key='',$generate_key='') {
		if(isset($tp_api_key) && !empty($tp_api_key) && !empty($generate_key)){
			$get_url='https://store.theplusaddons.com/theplus-verify/';
			$method='verify';
			
			$get_url=$get_url.'?url=verify_api/'.$method.'/'.$tp_api_key.'/'.$generate_key;
			
			$response = wp_remote_get( $get_url );
			
			if ( is_wp_error( $response ) ) {
				return false;
			}

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			
			$option_name = 'theplus_verified';
			if( !empty($license_data) && $license_data->success == true ) {
				$expire=$license_data->expires;
				
				if($expire !='lifetime' && $license_data->license == 'valid'){
					$verify= '0' ;
					theplus_check_api_options('theplus_verified',$verify,$expire);
					
					return 'expired';
				}
				if( $license_data->license == 'valid' ) {
					$verify = '1' ;
					theplus_check_api_options('theplus_verified',$verify,$expire);
					
					return 'valid';
				}elseif($license_data->license == 'expired' ){
					$verify = '0' ;
					theplus_check_api_options('theplus_verified',$verify,$expire);
					
					return 'expired';
				} else {
					$verify = '0' ;
					theplus_check_api_options('theplus_verified',$verify,$expire);
					
					return 'invalid';
				}
			}else{
				$verify = '0' ;
				theplus_check_api_options('theplus_verified',$verify);
				return 'success_false';
			}
		}else{
			return false;
		}
	}
}

if(!function_exists('plus_simple_crypt')){
	function plus_simple_crypt( $string, $action = 'dy' ) {
	    $secret_key = 'PO$_key';
	    $secret_iv = 'PO$_iv';
	    $output = false;
	    $encrypt_method = "AES-128-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
	    if( $action == 'ey' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'dy' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }
	 
	    return $output;
	}
}

function theplus_check_api_options($option_name,$verify,$expire=''){
	
	if($option_name!='' && $verify!=''){	
		$value=array(
			 'verify'=>$verify,
			 'expire'=>$expire,
		 );
		
		if ( get_option( $option_name ) ) {
			update_option( $option_name, $value );
		} else {
			$deprecated = null;
			$autoload = 'no';
			add_option( $option_name,$value, $deprecated, $autoload );
		}
	}
}

if(!function_exists('theplus_check_api_status')){
	function theplus_check_api_status() {
		$option_name = 'theplus_verified';
		$values=get_option( $option_name );
		$expired=$values["expire"];
		$verify=$values["verify"];
		$today_date = strtotime("today midnight");
			
		if($expired!='lifetime' && $today_date >= $expired ){
			return false;
		}else if($verify==1){
			return true;
		}else{
			return false;
		}
	}
}

function check_expired_date_key() {
	$option_name = 'theplus_verified';
	
	$values=get_option( $option_name );
	$expired=$values["expire"];
	$verify=$values["verify"];
	$today_date = strtotime("today midnight");
	
		if($expired!='lifetime' && $today_date >= $expired ){
			$verify=0;$expire='';
			theplus_check_api_options($option_name,$verify,$expire);
		}
}
add_action( 'admin_init', 'check_expired_date_key', 1 );



//Woocommerce Products
if(class_exists('woocommerce')) {
function theplus_out_of_stock() {
  global $post;
  $id = $post->ID;
  $status = get_post_meta($id, '_stock_status',true);
  
  if ($status == 'outofstock') {
  	return true;
  } else {
  	return false;
  }
}
function theplus_product_badge() {
 global $post, $product;
 	if (theplus_out_of_stock()) {
		echo '<span class="badge out-of-stock">' . __( 'Out of Stock', 'theplus' ) . '</span>';
	} else if ( $product->is_on_sale() ) {
		if ('discount' == 'discount') {
			if ($product->get_type() == 'variable') {
				$available_variations = $product->get_available_variations();								
				$maximumper = 0;
				for ($i = 0; $i < count($available_variations); ++$i) {
					$variation_id=$available_variations[$i]['variation_id'];
					$variable_product1= new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1->get_regular_price();
					$sales_price = $variable_product1->get_sale_price();
					$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
					if ($percentage > $maximumper) {
						$maximumper = $percentage;
					}
				}
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>', $post, $product);
			} else if ($product->get_type() == 'simple'){
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			} else if ($product->get_type() == 'external'){
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			}
		} else {
			echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale">'.__( 'Sale','theplus' ).'</span>', $post, $product);
		}
	}
}
add_action( 'theplus_product_badge', 'theplus_product_badge',3 );
}