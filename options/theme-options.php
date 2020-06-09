<?php
function attach_main_options_page() {
	$title = "Theme Options";
	add_menu_page(
		$title,
		$title,
		'edit_themes',
	    basename(__FILE__),
		create_function('', '')
	);
}
add_action('admin_menu', 'attach_main_options_page');

$advert = wp_option::factory('textarea', 'advert', 'Footer Area - The content you enter here will be displayed just before the copyright line.');
$advert->set_default_value('<a href="#" target="_blank" ><img src="#" alt="" /></a>');

$inner_options = new OptionsPage(array(
	$advert,
    wp_option::factory('header_scripts', 'header_script'),
    wp_option::factory('footer_scripts', 'footer_script'),
));
$inner_options->title = 'General';
$inner_options->file = basename(__FILE__);
$inner_options->parent = "theme-options.php";
$inner_options->attach_to_wp();

?>
