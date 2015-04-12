<?php 
    global $stylesheet_dir, $stylesheet_url;
    get_header();
?>
				<div class="container" style="background-image: url('<?php echoPicture($stylesheet_dir,'./images/bg2.png');?> ');background-size: 100%;background-repeat: no-repeat;background-color: #040205; " role="main">
				<ul class="list">
<?php
		$query = new WP_query('postcount=4');
		if($query->have_posts()):
			while($query->have_posts()):
				$query->the_post();
?>
            <li class="blog_list__item">
							<figure class="blog_list__item__inner">
								<figcaption>
									<?php if(has_post_thumbnail() ) {the_post_thumbnail(); } ?>
									<strong><?php the_title(); ?></strong>.
									<?php the_excerpt(); ?>
								</figcaption>
							</figure>
						</li>
<?php
			endwhile;
	endif;
	wp_reset_postdata();
?>
					</ul>
				</div>
<?php 
    get_footer();
?>
