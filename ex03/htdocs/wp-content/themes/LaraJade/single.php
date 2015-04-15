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
									<br><br>
<?php
	// Find connected pages
	$connected = new WP_Query( array(
	  'connected_type' => 'posts_to_portfolio',
	  'connected_items' => get_queried_object(),
	  'nopaging' => true,
	) );

	// Display connected pages
	if ( $connected->have_posts() ) :
?>
<h3>Related portfolio posts:</h3>
<ul>
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
    <li><a style="color:#000000" href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a></li>
<?php endwhile; ?>

				</figcaption>
							</figure>
</ul>

<?php 
// Prevent weirdness
wp_reset_postdata();

endif;
?>
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
