<?php
/*
$panel = new ECF_Panel('custom-data', 'Custom Data', 'page', 'normal', 'high');
$panel->add_fields(array(
	// ECF_Field::factory('text', 'my_data')->multiply()->help_text('lorem'),
	// ECF_Field::factory('map', 'location')->set_api_key('ABQIAAAA2Ljdl8ezJ0zyqUMenkwbbBREq243BjtIUGoC5ruqX1iPqOHaUBRRTUCwP_wInQ0nkmnjB8-GEXOM7Q')->set_position(0, 80, 15),
	ECF_Field::factory('image', 'img'),
	ECF_Field::factory('file', 'pdf'),
));
*/

$slide_panel = new ECF_Panel('slide-data', 'Slide Data', 'slides', 'normal', 'high');
$slide_panel->add_fields(array(
	ECF_Field::factory('image', 'slide_image', 'Upload Slide Image'),
));

$show_subpages = ECF_Field::factory('select', 'show_subpages', 'Show Sub-Pages Title and Excerpt' );
$show_subpages->add_options(array('false' => 'False', 'true' => 'True',  ));

$page_panel = new ECF_Panel('page-data', 'Page Data', 'page', 'normal', 'high' );
$page_panel->add_fields(array(
	$show_subpages,
));

$post_panel = new ECF_Panel('post-data', 'Post Data', 'post', 'normal', 'high');
$post_panel->add_fields(array(
	ECF_Field::factory('image', 'post_image', 'Upload Post Featured Image'),
));

$division = ECF_Field::factory('text', 'division', 'Insert Division Information');
$division->multiply();

$tryouts_panel = new ECF_Panel('tryouts-data', 'Tryout Data', 'tryouts', 'normal', 'high');
$tryouts_panel->add_fields(array(
	$division,
	ECF_Field::factory('text', 'register_url', 'Register Online URL'),
));

?>
