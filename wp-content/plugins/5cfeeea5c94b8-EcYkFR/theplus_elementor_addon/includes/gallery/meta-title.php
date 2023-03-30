<?php if(!isset($post_title_tag) && empty($post_title_tag)){
	$post_title_tag='h3';
} ?>
<<?php echo $post_title_tag; ?> class="post-title">
	<?php if(empty($display_icon_zoom) || $display_icon_zoom!='yes'){ ?><a href="<?php echo esc_url($full_image); ?>"  <?php echo $popup_attr; ?>><?php } ?><?php echo esc_html($title); ?><?php if(empty($display_icon_zoom) || $display_icon_zoom!='yes'){ ?></a><?php } ?>	
</<?php echo $post_title_tag; ?>>