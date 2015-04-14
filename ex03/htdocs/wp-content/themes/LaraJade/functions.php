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

?>
