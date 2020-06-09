<?php
// https://www.gothamvolleyball.org/registration/authenticate.php?login=1
define('REGISTRATION_URL', 'https://www.gothamvolleyball.org/registration');
if (isset($_GET['login-to-registration'])) {
	$url = REGISTRATION_URL . '/authenticate.php?';
	foreach ($_POST as $key => $value) {
		if (is_string($value)) {
			$url .= '&' . urlencode($key) . '=' . urlencode($value);
		}
	}

	$cr = generate_challenge_response(urldecode($_REQUEST['password']));

	setcookie('gothamvc', $cr['challenge'], time() + 60*60*24*365, '/', '.gothamvolleyball.org', FALSE);
	$_COOKIE['gothamvc'] = $cr['challenge'];

	session_name($_COOKIE['gothamvc']);
	session_start();

	$_SESSION['challenge'] = $cr['challenge'];
	$url .= '&response=' . urlencode($cr['response']);
	$url .= '&persistent=false';
	header('Location: ' . $url);
	exit;
}

if (isset($_COOKIE['gothamvc'])) {
	// session_name($_COOKIE['gothamvc']);
}
session_start();
// use when you are working on an issue; others will see that the site is under maintenance
// $client_ip = $_SERVER['REMOTE_ADDR'];
// if ($_SERVER['REMOTE_ADDR'] == '24.103.114.158') {
// 		var_dump($_SESSION['authenticated']);
// 		echo '<br>';
// 		var_dump($_COOKIE['gothamvc']);
// 		die;
// }
define('REGISTRATION_LOGGED_IN', (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == 'yes'));
define('REGISTRATION_CHALLENGE', (isset($_COOKIE['gothamvc']) ? $_COOKIE['gothamvc'] : ''));

// wp_enqueue_script('jquery');// Include jquery

add_theme_support('automatic-feed-links');

add_theme_support( 'post-thumbnails' );

add_theme_support( 'post-thumbnails', array( 'post' ) );
add_theme_support( 'post-thumbnails', array( 'page' ) );

add_theme_support('menus');
register_nav_menus(array(
	'main-menu'=>__('Main Menu'),
	'header-menu'=>__('Header Menu'),
	'footer-menu'=>__('Footer Menu'),
));

register_sidebar(array(
	'name'          => __( 'Sidebar Widget', 'theme_gothamvolleyball' ),
	'id'            => 'sidebar-1',    // ID should be LOWERCASE  ! ! !
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => '</h2>',
));
include_once('lib/twitter/versions-proxy.php');
include_once('lib/hacks.php');
include_once('lib/video-functions.php');
include_once('lib/common.php');
include_once('lib/user-functions.php');
// include_once('lib/pps.php');

include_once('lib/enhanced-custom-fields/enhanced-custom-fields.php');
include_once('options/theme-custom-fields.php');
include_once('options/theme-post-types.php');

function attach_theme_options() {
	include_once('lib/theme-options/theme-options.php');
	include_once('options/theme-options.php');
	// include_once('options/other-options.php');

	include_once('lib/custom-widgets/widgets.php');
	include_once('options/theme-widgets.php');
}

attach_theme_options();

/**
 * Shortcut function for acheiving
 * $no_nav_pages = _get_page_by_name('no-nav-pages');
 * wp_list_pages('sort_column=menu_order&exclude_tree=' . $no_nav_pages->ID);
 * with:
 * wp_list_pages('sort_column=menu_order&' . exclude_no_nav());
 */
function exclude_no_nav($no_nav_pages_slug='no-nav-pages') {
    $no_nav_page = _get_page_id_by_name($no_nav_pages_slug);
    return "exclude_tree=$no_nav_page";
}

/**
 * Checks if particular page ID has parent with particular slug
 */
$__has_parent_depth = 0;
function has_parent($id, $parent_name) {
    global $__has_parent_depth;
    $__has_parent_depth++;
    if ($__has_parent_depth==100) {
    	exit('too much recursion');
    }
    $post = get_post($id);

    if ($post->post_name==$parent_name) {
    	return true;
    }
    if ($post->post_parent==0) {
    	return false;
    }
    $__has_parent_depth--;
    return has_parent($post->post_parent, $parent_name);
}

/**
 * Example function for printing comments
 */
function print_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<div <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
		    <div class="comment-author vcard">
		        <?php echo get_avatar($comment, 48); ?>
		        <?php comment_author_link() ?>
		        <span class="says">says:</span>
		    </div>
		    <?php if ($comment->comment_approved == '0') : ?>
		        <em><?php _e('Your comment is awaiting moderation.') ?></em><br />
		    <?php endif; ?>

		    <div class="comment-meta commentmetadata">
		    	<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		    		<?php comment_date() ?> at <?php comment_time() ?>
		    	</a>
		    	<?php edit_comment_link(__('(Edit)'),'  ','') ?>
	    	</div>

		    <?php comment_text() ?>

		    <div class="reply">
		        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		    </div>
		</div>
	<?php
}

define('STR_WORD_COUNT_FORMAT_ADD_POSITIONS', 2);
/**
 * >>> shortalize('lorem ipsum dolor sit amet');
 * ... lorem ipsum dolor sit amet
 * >>> shortalize('lorem ipsum dolor sit amet', 5);
 * ... lorem ipsum dolor sit amet
 * >>> shortalize('lorem ipsum dolor sit amet', 4);
 * ... lorem ipsum dolor sit...
 * >>> shortalize('lorem ipsum dolor sit amet', -1);
 */
function shortalize($input, $words_limit=15, $strip_tags = true, $end = '...') {
	if ($strip_tags) {
		$input = strip_tags($input);
	}
    $words_limit = abs(intval($words_limit));
    if ($words_limit==0) {
        return $input;
    }
    $words = str_word_count($input, STR_WORD_COUNT_FORMAT_ADD_POSITIONS);
    if (count($words)<=$words_limit + 1) {
        return $input;
    }
    $loop_counter = 0;
    foreach ($words as $word_position => $word) {
        $loop_counter++;
        if ($loop_counter==$words_limit + 1) {
            return substr($input, 0, $word_position) . $end;
        }
    }
}

# crawls the pages tree up to top level page ancestor
# and returns that page as object
function get_page_ancestor($page_id) {
    $page_obj = get_page($page_id);
    while($page_obj->post_parent!=0) {
        $page_obj = get_page($page_obj->post_parent);
    }
    return get_page($page_obj->ID);
}

# example function for filtering page template
function filter_template_name() {
    global $post;

	$page_tpl = get_post_meta($post->ID, '_wp_page_template', 1);

	if ($page_tpl!="default") {
		return TEMPLATEPATH . '/' . $page_tpl;
	}
    /*
	# example logic here ...
    $page_ancestor = get_page_ancestor($post->ID);

    if ($page_ancestor->post_name!='pages-branch-name') {
    	return TEMPLATEPATH . "/my-branch-template.php";
    }

    return TEMPLATEPATH . "/page.php";
    */
}
// add_filter('page_template', 'filter_template_name');

# shortcut for get_post_meta. Returns the string value
# of the custom field if it exist.
# second arg is required if you're not in the loop
function get_meta($key, $id=null) {
	if (!isset($id)) {
	    global $post;
	    if (empty($post->ID)) {
	    	return null;
	    }
	    $id = $post->ID;
    }
    return get_post_meta($id, $key, true);
}

/**
 * Returns posts page as object (setuped from Settings > Reading > Posts Page).
 *
 * If the page for posts is not chosen null is returned
 */
function get_posts_page() {
    $posts_page_id = get_option('page_for_posts');
    if ($posts_page_id) {
    	return get_page($posts_page_id);
    }
    return null;
}

/**
 * Parses custom field values to hash array. Expected
 * custom field value format:
 * {{{
 * title: my cool title
 * image: https://example.com/images/1.jpg
 * caption: my cool image
 * }}}
 * Returned array looks like:
 * array(
 *     'title'=>'my cool title',
 *     'image'=>'https://example.com/images/1.jpg',
 *     'caption'=>'my cool image',
 * )
 */
function parse_custom_field($details) {
    $lines = array_filter(preg_split('~\r|\n~', $details));
    $res = array();
    foreach ($lines as $line) {
        if(!preg_match('~(.*?):(.*)~', $line, $pieces)) {
            continue;
        }
        $label = trim($pieces[1]);
        $val = trim($pieces[2]);
        $res[$label] = $val;
    }
    return $res;
}

function get_page_id_by_path($page_path) {
    $p = get_page_by_path($page_path);
    if (empty($p)) {
    	return null;
    }
    return $p->ID;
}

function get_page_permalink_by_path($page_path) {
    $p = get_page_by_path($page_path);
    if (empty($p)) {
    	return '';
    }
    return get_permalink($p->ID);
}

function get_upload_dir() {
	$updir = wp_upload_dir();
	return $updir['basedir'];
}

function get_upload_url() {
	$updir = wp_upload_dir();
	return $updir['baseurl'];
}

/*
Return an array containing all images (obejcts) attached to a post.
	thumb_url = image thumbnail url
	full_url = full sized image url
*/
function get_post_images($post_id) {
    $images = get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post_id . '&orderby=menu_order&order=ASC');
    foreach ($images as $index => $i) {
	    $images[$index]->thumb_url = wp_get_attachment_thumb_url($i->ID);
	    $images[$index]->full_url = wp_get_attachment_url($i->ID);
	}
    return $images;
}

/*
* Shortcut function for outputting page permalinks. Example: <?php permapath('about/our-company'); ?>
*/
function permapath($path, $echo = true) {
	$permalink = get_permalink(get_page_id_by_path($path));
	if ($echo) {
		echo $permalink;
	}
	return $permalink;
}

function get_page_id($page_name){
	global $wpdb;
	$page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return $page_name;
}

function custom_gallery_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'format' => '1',
		), $atts, $content));
	global $post;
	?>

	<?php $images = get_post_images($post->ID); ?>
	<?php if ($images) : ?>
	<?php $output = '<div class="gallery">';
		$count = 0;
		foreach ($images as $i) { $count ++;
			$last ='';
			if ($count % 4 == 0 ) $last = ' last-img';
		$output .= '<div class="img' . $last . '"><a target="_blank" href="' . $i->full_url . '" rel="fancybox"><img src="' . $i->thumb_url . '" alt="" /></a></div>';
		}
	$output .= '</div><div class="cl">&nbsp;</div>'; ?>
	<?php return $output; ?>
	<?php endif; ?>
<?php
};
add_shortcode('customgallery', 'custom_gallery_shortcode');

function generate_challenge_response($password) {
	$challenge = "";
	for ($i = 0; $i < 80; $i++) {
	    $challenge .= dechex(rand(0, 15));
	}

	$response = md5($challenge . md5($password));
	return array('challenge'=>$challenge, 'response'=>$response);
}

add_filter( 'wpcf7_recaptcha_threshold',
 
  function( $threshold ) {
    $threshold = 0.4; // decrease threshold to 0.4
 
    return $threshold;
  },
 
  10, 1
);
