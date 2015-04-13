<?php 
    global $stylesheet_dir, $stylesheet_url;
    get_header();
?>
				<div class="container" style="background-image: url('<?php echoPicture($stylesheet_dir,'./images/bg2.png');?> ');background-size: 100%;background-repeat: no-repeat;background-color: #040205; " role="main">
				<ul class="list">
<?php
		global $wp_query;
		$wp_query_temp = $wp_query;

		$wp_query = new WP_query('posts_per_page=4&paged='.get_query_var('paged'));
		if(have_posts()):
			while(have_posts()):
				the_post();
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
?>
					</ul>
				<div><p><?php posts_nav_link(); ?></p></div>
				</div>
<?php 
	$wp_query = $wp_query_tmp;
	wp_reset_postdata();
    get_footer();
?>
