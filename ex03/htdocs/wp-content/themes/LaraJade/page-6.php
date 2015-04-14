<?php 
    global $stylesheet_dir, $stylesheet_url;
    get_header();
?>
<div class="container" style="background-image: url('<?php echoPicture($stylesheet_dir,'./images/bg3.png');?> ');background-size: 100%;background-repeat: no-repeat;background-color: #040205; " role="main">
<!-- <div class="container" style="background-image: url('./images/bg3.png');background-size: 100%;background-repeat: no-repeat;background-color: #040205; " role="main"> -->
<ul class="list">
<?php 
	$portfolioPosts = new WP_Query('post_type=portfolio');

	if ($portfolioPosts->have_posts()) : 
		while ($portfolioPosts->have_posts()) :
			$portfolioPosts->the_post(); 
			// custom fields
			$custom_fields = get_post_custom();
			$descr = $custom_fields['portfolio_descr'][0];
			$year = $custom_fields['portfolio_year'][0];
			$url = $custom_fields['portfolio_url'][0];
			?> 
			<li class="list__item">
				<figure class="list__item__inner">

					<figcaption>
									<?php if(has_post_thumbnail() ) {the_post_thumbnail(); } ?>
						<a style="text-decoration:none;" href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a>
						<br>
						 <?php echo $year; ?><br>
					</figcaption>
				</figure>	
		    </li>
		<?php endwhile;
	endif; 
?>
</ul>
</div>

<?php 
    get_footer();
?>