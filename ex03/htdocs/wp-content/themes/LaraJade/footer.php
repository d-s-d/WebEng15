<?php global $stylesheet_dir;?>
<div id="footer" style="min-height:250px;">
                <?php wp_footer(); ?>
				<!-- <div class="flex-container"> -->
				<div class="flex-item" style="margin-right: 1.25rem;">
					<strong>ADDRESS</strong>
					<br>
					<br>
					New Chrichton Cottage
					<br>
					Arradoul, Buckie
					<br>
					AB43 5AP
					<br>
					Scotland UK
					<br>
					<br>
					+44 (0) 1234 567891
					<br>
					<br>
					<img width="35%" src="<?php echoPicture($stylesheet_dir,'images/qcode.png');?> " align="left">
				</div>
				<div class="flex-item" style="margin-right: 1.25rem;">
					<strong>About Me</strong>
					<br>
					<br>
<?php
	$intro_text = get_option('introduction_text');
	echo wp_trim_words($intro_text, 20, ' &hellip; <a style="text-decoration:none" href="'.get_home_url().'"><strong>More</strong></a>');
?>
					<!-- Lara is a freelance web designer with satisfied clients worldwide. Lara has been designing websites professionally for over eight years, and... <strong>More</strong> -->
					<br>
					<br>
					<strong>Follow me:</strong>
					<br>
					<br>
					<img src="<?php echoPicture($stylesheet_dir,'images/twitter.png');?>" width="15%">
					<img src="<?php echoPicture($stylesheet_dir,'images/linkedin.png');?>" width="15%">
					<img src="<?php echoPicture($stylesheet_dir,'images/pinterest.png');?>" width="15%">
					<img src="<?php echoPicture($stylesheet_dir,'images/facebook.png');?>" width="15%">
					<img src="<?php echoPicture($stylesheet_dir,'images/google_plus.png');?>" width="15%">
				</div>
				<div class="flex-item" style="margin-right: 1.25rem;">
					<strong>My last post</strong>
					<br>
					<br>
<?php
	global $wp_query;
	$wp_query_temp = $wp_query;

	custom_excerpt_length(20);
	$wp_query = new WP_query(array('post_count' => '1', 'orderby' => 'date', 'order' => 'desc' ));
	the_post();
	the_excerpt(); ?><a href="<?php the_permalink(); ?>"><strong>More</strong></a>
<?php	
		// $post = $tmp_post;
	$wp_query = $wp_query_temp;	
	wp_reset_postdata();
?><!--
					Over the previous year, the Polymer team has spent a lot of time teaching developers how to create their own elements. This has lead to a rapidly growing ecosystem, buoyed in large... <strong>More</strong> -->
				</div>
				<div class="flex-item">
					<strong>Last Project</strong>
					<br>
					</br>
					Freelance WebSite
					<br>
					<br>
					<img width="80%" src="<?php echoPicture($stylesheet_dir,'images/portfolio/p1.jpg');?>" >
				</div>

				<!-- </div> -->
			</div>
		</div>

	</body>
</html>
