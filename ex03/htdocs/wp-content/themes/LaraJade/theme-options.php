<?php

￼// This tells WordPress to call the function named // "setup_theme_admin_menu"
// when it's time to create the menu pages
function setup_theme_admin_menu() {
	add_menu_page(
		'Course Theme Settings',
		'Course Settings',
		'manage_options',
		'course_settings',
		'course_settings_page'
	);
}

add_action('admin_menu', 'setup_theme_admin_menu');



// add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function)

?>