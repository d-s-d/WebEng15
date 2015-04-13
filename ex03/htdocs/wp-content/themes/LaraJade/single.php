<?php 
    global $stylesheet_dir, $stylesheet_url;
    get_header();
?>
				<div class="container" style="background-image: url('<?php echoPicture($stylesheet_dir,'./images/bg2.png');?> ');background-size: 100%;background-repeat: no-repeat;background-color: #040205; " role="main">
				<ul class="list">
<?php
		if(have_posts()):
				the_post();
?>
            <li class="blog_list__item">
							<figure class="blog_list__item__inner">
								<figcaption>
									<?php if(has_post_thumbnail() ) {the_post_thumbnail(); } ?>
									<strong><?php the_title(); ?></strong>.
									<?php the_content(); ?>
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
