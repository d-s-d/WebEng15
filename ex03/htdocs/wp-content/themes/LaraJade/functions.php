<?php 

    add_theme_support('post-thumbnails');

 $stylesheet_url = get_bloginfo('stylesheet_url');
 $stylesheet_dir = get_bloginfo('stylesheet_directory');
 $images_url = get_bloginfo('stylesheet_url').'/images/';
 
 function echoPicture($ssurl, $locurl) {
     echo $ssurl.'/'.$locurl;
 }

?>