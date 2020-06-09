<?php
/*
* Register the new widget classes here so that they show up in the widget list
*/
function load_widgets() {
    // register_widget('ThemeWidgetGallery');
}
// add_action('widgets_init', 'load_widgets');

class ThemeWidgetGallery extends ThemeWidgetBase {
    function __construct() {
        $widget_opts = array(
	        'classname' => 'theme-widget theme-widget-gallery',
            'description' => __( 'Displays your last added images from your gallery.' ),
        );
        $control_ops = array(
        );
        $this->WP_Widget('theme-widget-gallery', 'Theme Widget - Gallery', $widget_opts, $control_ops);
        $this->custom_fields = array(
        	array(
		        'name'=>'title',
        		'type'=>'text',
        		'title'=>'Title',
        		'default'=>'Photo Gallery',
        	),
        	array(
        		'name'=>'count',
        		'type'=>'text',
        		'title'=>'Number of thumbnails to show.(-1 to show all)',
        		'default'=>'3'
        	),
        	array(
        		'name'=>'gallery-name',
        		'type'=>'text',
        		'title'=>'The title of your gallery page(Gallery by default)',
        		'default'=>'Gallery'
        	),
        	array(
        		'name'=>'link-text',
        		'type'=>'text',
        		'title'=>'The text for the link leading to your gallery page',
        		'default'=>'View Our Photo Gallery'
        	),
        );
    }

    function front_end($args, $instance) {
    	extract($args);
    	if ($instance['gallery-name'] != '') :
	    	$images = get_post_images(get_page_id($instance['gallery-name']));
	    	if ($instance['title'] != '') {
	    		echo $before_title . $instance['title'] . $after_title;
	    	}
	        ?>
	        <?php if ($images != '') : ?>
	        	<div class="box-cnt min-gallery">
	        		<?php $counter = 0 ?>
	        		<?php foreach ($images as $i) : ?>
	        			<?php if ($counter == $instance['count']) : ?>
	        				<?php break; ?>
	        			<?php endif; ?>
	        			<div class="img">
	        				<a target="_blank" href="<?php echo get_permalink($i->ID); ?>">
	        					<img alt="" src="<?php echo $i->thumb_url; ?>" />
	        				</a>
	        			</div>
	        			<?php $counter ++; ?>
	        		<?php endforeach; ?>
	        		<div class="cl">&nbsp;</div>
	        		<p class="more"><a href="<?php echo get_permalink($i->post_parent); ?>"><?php echo $instance['link-text']; ?></a></p>
	        	</div>
			<?php else : ?>
				<p>Sorry, but there are no images in the Gallery yet. Please check again later.</p>
			<?php endif; ?>
        <?php endif;
    }
}
?>
