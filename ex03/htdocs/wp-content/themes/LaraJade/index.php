<?php get_header(); 
global $stylesheet_dir;
?>
<?php
	$img_atts = wp_get_attachment_image_src(get_option('gallery_options'));
	$img_src = $img_atts[0];
?>
			<div class="container" style="background-image: 
			url('<?php echo $img_src; ?>');background-size: 100%;background-repeat: no-repeat;background-color: #7C7052; " role="main">

				<div class="transbox">
					<?php echo nl2br(get_option('introduction_text')); ?>
				</div>
			</div>

<?php get_footer(); ?>
