<?php 
	if($attachment){
		$featured_image_id = $attachment->ID;
	}else{
		$featured_image_id = $image_id;
	}
	if(! empty( $featured_image_id )){
		if(!empty($layout) && $layout=='grid'){
			
			$featured_image=wp_get_attachment_image( $featured_image_id, 'tp-image-grid' );
		}else if(!empty($layout) && $layout=='masonry'){
		
			$featured_image=wp_get_attachment_image($featured_image_id ,'full');
		//	$featured_image='<img src="'.esc_url($featured_image).'" alt="'.esc_attr($image_alt).'">';
			
		}else if(!empty($layout) && $layout=='carousel'){
			
			if(empty($featured_image_type)){
				$featured_image_type='full';				
			}else{
				if($featured_image_type=='grid'){
				 $featured_image_type='tp-image-grid';
				}
			}
			
			$featured_image=wp_get_attachment_image($featured_image_id ,$featured_image_type);
		//	$featured_image='<img src="'.esc_url($featured_image).'" alt="'.esc_attr($image_alt).'">';
			
		}else{
			
			$featured_image=wp_get_attachment_image($featured_image_id ,'full');
		//	$featured_image='<img src="'.esc_url($featured_image).'" alt="'.esc_attr($image_alt).'">';		
		
		}
	}else{
		$featured_image=theplus_get_thumb_url();
		$featured_image=$featured_image='<img src="'.esc_url($featured_image).'" alt="'.esc_attr($image_alt).'">';
	}
	
?>
	<div class="gallery-image">
	<span class="thumb-wrap">
		<?php echo $featured_image; ?>
	</span>
	</div>