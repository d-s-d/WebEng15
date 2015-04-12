<?php get_header(); 
global $stylesheet_dir;
?>
			<div class="container" style="background-image: url('<?php echoPicture($stylesheet_dir,'images/bg1.png');?>');background-size: 100%;background-repeat: no-repeat;background-color: #7C7052; " role="main">

				<div class="transbox">
					<?php echo nl2br(get_option('introduction_text')); ?>
				</div>
			</div>

<?php get_footer(); ?>
