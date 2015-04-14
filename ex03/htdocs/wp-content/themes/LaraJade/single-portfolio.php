<?php 
    global $stylesheet_dir, $stylesheet_url;
    get_header();
?>
				<div class="container" style="background-image: url('<?php echoPicture($stylesheet_dir,'./images/bg3.png');?> ');background-size: 100%;background-repeat: no-repeat;background-color: #040205; " role="main">
				<ul class="list">
<?php
		if(have_posts()):
				the_post();
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
									<strong><?php the_title(); ?></strong>.
									<br>
									<?php echo $descr; ?><br>
									<?php echo $year; ?><br>
									<a href=<?php echo $year; ?>>Go to portfolio website</a><br>
								</figcaption>
							</figure>
						</li>
<?php
	endif;
?>
					</ul>
				</div>
<?php 
	wp_reset_postdata();
    get_footer();
?>
