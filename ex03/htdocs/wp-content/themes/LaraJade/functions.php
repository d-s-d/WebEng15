<?php 

    add_theme_support('post-thumbnails');

 $stylesheet_url = get_bloginfo('stylesheet_url');
 $stylesheet_dir = get_bloginfo('stylesheet_directory');
 $images_url = get_bloginfo('stylesheet_url').'/images/';
 
 function echoPicture($ssurl, $locurl) {
     echo $ssurl.'/'.$locurl;
 }

 add_option('introduction_text', '', '', 'no');
 /*
 // the following was used for testing purposes when the dashboard widget was not ready

 update_option('introduction_text',"Lara is a freelance web designer with satisfied clients worldwide. Lara has been designing websites professionally for over eight years, and is very keen on personal service. I would describe Lara as a spiritual fast learning generalist with a passion for remarkable design.
					
That´s enough of talking about myself in the third person.

At first I intended to be an animator and went to design school fully motivated to become just that. One thing led to another and 2 years went by and I was a (almost) fully fledged freelance web designer without ever planning to become one.

I have sucessfully been a freelance web designer now for a while and it has given me even more love for this work. I have worked with ad agencies, web developers, diaper makers, pension funds, furniture makers, businiess women & men, friends & family.
");
	*/
 // The About Me Dashbaord Widget
 function about_me_dashboard_widget_setup() {
	 wp_add_dashboard_widget(
		 'about_me_dashbaord_widget',
		 'About Me',
		 'about_me_dashboard_widget_display',
		 'about_me_dashboard_widget_display_conf'
	 );
 }

 add_action('wp_dashboard_setup', 'about_me_dashboard_widget_setup');

 function about_me_dashboard_widget_display() {
	echo nl2br(get_option('introduction_text'));
 }

 function about_me_dashboard_widget_display_conf($widget_id) {
	 $intro_text = esc_textarea(get_option('introduction_text'));

	 if ( 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['intro_text_post']) ) {
		 update_option( 'introduction_text', $_POST['intro_text'] );
	 }
?>
	<textarea style="width:100%;height:256px;" name="intro_text" value="textarea"><?php echo $intro_text ?></textarea>	
	<input name="intro_text_post" type="hidden" value="1" />
<?php
 }

global $EXCERPT_LENGTH;

$EXCERPT_LENGTH = 50;

function custom_excerpt_length( $len ) {
	global $EXCERPT_LENGTH;
	$EXCERPT_LENGTH = $len;
}

// The following is a perfect example of how UGLY wordpress is designed.
function filter_excerpt_length() {
	global $EXCERPT_LENGTH;
	$tmp = $EXCERPT_LENGTH;
	$EXCERPT_LENGTH = 50;
	return $tmp;
}

add_filter( 'excerpt_length', 'filter_excerpt_length', 999 );

// custom person type
if( ! function_exists( 'create_portfolio_post_type' ) ):
  function create_portfolio_post_type() {
$labels = array(
'name' => __( 'Portfolio' ),
'singular_name' => __( 'Portfolio' ),
'menu_name' => __( 'Portfolios' ),
'add_new' => __( 'Add portfolio' ),
'all_items' => __( 'All portfolio' ),
'add_new_item' => __( 'Add portfolio' ),
'edit_item' => __( 'Edit portfolio' ),
'new_item' => __( 'New portfolio' ),
'view_item' => __( 'View portfolio' ),
'search_items' => __( 'Search portfolios' ),
'not_found' => __( 'No portfolios found' ), 'not_found_in_trash' => __( 'No portfolios found in trash' ), 'parent_item_colon' => __( 'Parent portfolio' )
//'menu_name' => default to 'name' 
);

$args = array(
'labels' => $labels,
'public' => true, 'publicly_queryable' => true, 'show_in_nav_menus' => true, 'query_var' => true, 'rewrite' => true, 'capability_type' => 'post', 'hierarchical' => false, 'supports' => array(
'title',
'thumbnail', //'editor', //'author', //'excerpt', //'trackbacks', //'custom-fields', //'comments', //'revisions', //'page-attributes', //'post-formats',
), 'menu_position' => 5,
'register_meta_box_cb' => 'add_portfolio_post_type_metabox' );

  register_post_type( 'portfolio', $args );
  register_taxonomy( 'custom_category', 'portfolio',
       array(
          // 'hierarchical' => true,
          // 'label' => 'role'
       )
); }
  add_action( 'init', 'create_portfolio_post_type' );
endif;

function add_portfolio_post_type_metabox() {
  add_meta_box( 'portfolio_metabox', 'Portfolio Data', 'portfolio_metabox', 'portfolio', 'normal' );
}
function portfolio_metabox() {
  global $post;
  $custom = get_post_custom($post->ID);
  $pname = $custom['portfolio_pname'][0];
  $descr = $custom['portfolio_descr'][0]; 
  $year = $custom['portfolio_year'][0]; 
  $url = $custom['portfolio_url'][0];

    ?>
		<div class="portfolio">
			<p>
				<label>Description<br> 
					<input type="text" name="descr" size="50" value="<?php echo $descr; ?>"> 
		    	</label>
		    </p>
			<p>
				<label>Year<br> 
					<input type="text" name="year" size="50" value="<?php echo $year; ?>"> 
		    	</label>
		    </p>
			<p>
				<label>URL<br> 
					<input type="text" name="url" size="50" value="<?php echo $url; ?>"> 
		    	</label>
		    </p>
		</div>	
	<?php 
}

function portfolio_post_save_meta( $post_id, $post ) {
  // is the user allowed to edit the post or page?
  if( ! current_user_can( 'edit_post', $post->ID ))
  {
    return $post->ID;
  }

  $portfolio_post_meta['portfolio_descr'] = $_POST['descr']; 
  $portfolio_post_meta['portfolio_year'] = $_POST['year'];
  $portfolio_post_meta['portfolio_url'] = $_POST['url'];

  // add values as custom fields
  foreach( $portfolio_post_meta as $key => $value ) {
    if( get_post_meta( $post->ID, $key, FALSE ) ) {
      // if the custom field already has a value
		update_post_meta($post->ID, $key, $value); } 
	else {
	    // if the custom field doesn't have a value
        add_post_meta( $post->ID, $key, $value );
    }
    if( !$value ) {
      // delete if blank
      delete_post_meta( $post->ID, $key );
} }
}
add_action( 'save_post', 'portfolio_post_save_meta', 1, 2 );
// save the custom fields


// post 2 post
function my_connection_types() {
    p2p_register_connection_type( array(
        'name' => 'posts_to_portfolio',
        'from' => 'post',
        'to' => 'portfolio',
        'reciprocal' => true,
    ) );
}
add_action( 'p2p_init', 'my_connection_types' );

add_action( 'wp_ajax_set_post_content', 'set_post_content' );

function set_post_content() {
	$args = array( 'ID' => $_POST['post_id'], 'post_content' => $_POST['content'] );
	wp_update_post( $args );
	wp_die();
}

?>
