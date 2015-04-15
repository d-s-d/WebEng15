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
									<a href=<?php echo $year; ?>>Go to portfolio website</a><br><br>
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
						</li>

<?php 
	// Prevent weirdness
	wp_reset_postdata();

	endif;
?>
<?php
	endif;
?>
					</ul>
				</div>
<?php 
	wp_reset_postdata();
    get_footer();
?>
