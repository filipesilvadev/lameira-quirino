<?php 
	$full_image='';
	$full_image=wp_get_attachment_url($image_id ,'full');

$bg_attr='';
if($layout=='metro'){	
	if ( !empty($full_image) ) {
		$bg_attr='style="background:url('.$full_image.')"';
	}else{
		$bg_attr = theplus_loading_image_grid($postid,'background');
	}
}
?>
<div class="gallery-list-content">
	<?php if($layout!='metro'){ ?>
	<div class="post-content-image">
		<?php include THEPLUS_INCLUDES_URL. 'gallery/format-image.php'; ?>
	</div>
	<?php } ?>
	<div class="post-content-center">
		<div class="post-zoom-icon">
			<?php if(!empty($image_icon) && !empty($list_img)){ ?>
				<div class="gallery-list-icon"><?php echo $list_img; ?></div>
			<?php } ?>
			<?php if(!empty($display_icon_zoom) && $display_icon_zoom=='yes'){
				include THEPLUS_INCLUDES_URL. 'gallery/meta-icon.php';
			} ?>
		</div>
		<div class="post-content-bottom">
			<?php if(!empty($display_title) && $display_title=='yes'){
					include THEPLUS_INCLUDES_URL. 'gallery/meta-title.php';
			} ?>
			<div class="post-hover-content">
				<?php if(!empty($display_excerpt) && $display_excerpt=='yes' && !empty($caption)){ 
					include THEPLUS_INCLUDES_URL. 'gallery/get-excerpt.php';
				} ?>
			</div>
		</div>
	</div>
	<?php if($layout=='metro'){ ?>
		<div class="gallery-bg-image-metro" <?php echo $bg_attr; ?>></div>
	<?php } ?>
</div>
