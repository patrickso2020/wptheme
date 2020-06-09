<?php

class ECF_Field {
	var $type;
	var $default_value;
	var $value, $values = array();

	var $post_id;

	var $id;

	var $is_subfield = false;

	// whether this custom field can have more than one value
	var $is_multiply = false;

	// ECF_Panel sets this once the field is attached to panel object
	var $current_post_type = null;

	// whether this custom field can not be empty
	var $_is_required = false;

	var $labels = array(
		'add_field'=>'Add field ...',
		'delete_field'=>'Delete field ...',
	);

	function __construct($name, $label) {
	    $this->name = $name;
	    $this->label = $label;

	    $random_string = md5(mt_rand() . $this->name . $this->label);
	    $random_string = substr($random_string, 0, 5); // 5 chars should be enough
	    $this->id = 'ecf-'. $random_string;

	    $this->init();
	    if (is_admin()) {
			$this->admin_init();
		}
		add_action('admin_init', array(&$this, 'wp_init'));
	}

	static function factory($type, $name, $label=null) {
		$type = str_replace(" ", '', ucwords(str_replace("_", ' ', $type)));

		$class = "ECF_Field$type";

		if (!class_exists($class)) {
			ecf_conf_error("Cannot add meta field $type -- unknow type. ");
		}

		// Try to guess field label from it's name
		if (is_null($label)) {
			// remove the leading underscore(if it's there)
			$label = preg_replace('~^_~', '', $name);
			// split the name into words and make them capitalized
			$label = ucwords(str_replace('_', ' ', $label));
		}

		if (substr($name, 0, 1)!='_') {
			// add underscore to custom field name -- this will remove it from
			// custom fields list in administration
			$name = "_$name";
		}
		$field = new $class($name, $label);
		$field->type = $type;
	    return $field;
	}

	function load() {
		if (empty($this->post_id)) {
			ecf_conf_error("Cannot load -- unknow POST ID");
		}
		$single = true;
		if ($this->is_multiply) {
			$single = false;
		}
		$value = get_post_meta($this->post_id, $this->name, $single);
	    $this->set_value($value);
	}
	// abstract init methods
	function init() {}
	function admin_init() {}
	function wp_init() {}
	/* / */

	function multiply() {
		$this->is_multiply = true;
	    return $this;
	}

	function setup_labels($labels) {
	    $this->labels = array_merge($this->labels, $labels);
	    return $this;
	}

	function set_value($value) {
		if ($this->is_multiply) {
			$this->values = $value;
			$this->value = '';
		} else {
			$this->value = $value;
		}

	}

	function set_default_value($default_value) {
	    $this->default_value = $default_value;
	    return $this;
	}

	function help_text($help_text) {
		$this->help_text = $help_text;
		return $this;
	}

	function render_row($field_html) {
		$help_text = isset($this->help_text) ? '<p class="ecf-description" rel="' . $this->id . '">' . $this->help_text . '</p>' : '' ;

		$field_has_options = $this->is_multiply || $this->is_subfield;

		$html = '
		<tr class="ecf-field-container">
			<td class="ecf-label"><label for="' . $this->id . '">' . $this->label . '</label></td>
			<td ' . ($field_has_options ? '' : 'colspan="2"') . '>' . $field_html . $help_text . '</td>
		';

		if ($this->is_multiply) {
			$html .= '<td class="ecf-action-cell"><a href="#" class="clone-ecf ecf-action">' . $this->labels['add_field'] . '</a></td>';
		} else if ($this->is_subfield) {
			$html .= '<td class="ecf-action-cell"><a href="#" class="delete-ecf ecf-action">' . $this->labels['delete_field'] . '</a>';
			$html .= '<input type="hidden" name="' . $this->name . '_original_vals[' . $this->id . ']" value="' . esc_attr($this->value) . '" />';
			$html .= '</td>';
		}
		$html .= '</tr>';
		return $html;
	}

	function set_value_from_input() {
		if (!isset($_POST[$this->name])) { return; }
		$value = $_POST[$this->name];
	    $this->set_value($value);
	}

	// abstract method
	// Called before delete_post_meta
	function delete($value) {

	}

	function save() {
		if ($this->is_multiply) {
			foreach ($this->values as $val) {
				if ($val) {
					add_post_meta($this->post_id, $this->name, $val);
				}
			}
			if (isset($_POST[$this->name . "_original_vals"])) {
				foreach ($_POST[$this->name . "_original_vals"] as $key => $original_value) {
					// deleting value actually removes the field from the form
					if (!isset($_POST[$this->name . "_updated_vals"][$key])) {
						$this->delete($original_value);
						delete_post_meta($this->post_id, $this->name, $original_value);
						continue;
					}
					$updated_value = $_POST[$this->name . "_updated_vals"][$key];

					// empty value removes the field
					if (empty($updated_value)) {
						$this->delete($original_value);
						delete_post_meta($this->post_id, $this->name, $original_value);
					}
					if ($original_value!=$updated_value) {
						update_post_meta($this->post_id, $this->name, $updated_value, $original_value);
					}
				}
			}
		} else {
			update_post_meta($this->post_id, $this->name, $this->value);
		}

	}

	// abstract method
	function render() {}

	function build_html_atts($tag_atts) {
	    $default = array(
	    	'class'=>'ecf-field ecf-' . strtolower(get_class($this)),
	    	'id'=>$this->id,
	    	'rel'=>$this->id,
	    );
	    if ($this->_is_required) {
	    	$default['class'] .= ' required';
	    }

	    if (isset($tag_atts['class'])) {
	    	$tag_atts['class'] .= ' ' . $default['class'];
	    }

	    if ($this->is_multiply) {
	    	$tag_atts['name'] .= '[]';
	    } else if ($this->is_subfield) {
	    	$tag_atts['name'] .= '_updated_vals[' . $this->id . ']';
	    }

	    return array_merge($default, $tag_atts);
	}

	// Builds HTML for tag.
	// example usage:
	// echo $this->build_tag('strong', array('class'=>'red'), 'I'm bold and red');
	// ==> <strong class="red">I'm bold and red</strong>
	function build_tag($tag, $atts, $content=null) {
	    $atts_text = '';
	    foreach ($atts as $key=>$value) {
	    	$atts_text .= ' ' . $key . '="' . esc_attr($value) . '"';
	    }

	    $return = '<' . $tag . $atts_text;
	    if (!is_null($content)) {
	    	$return .= '>' . $content . '</' . $tag . '>';
	    } else {
	    	$return .= ' />';
	    }
	    return $return;
	}

	function render_field() {
		$return = '';
		if ($this->is_multiply) {
			foreach ($this->values as $val) {
				// create new field object.
				$field = ECF_Field::factory($this->type, $this->name, $this->label);
				$field->post_id = $this->post_id;
				$field->value = $val;
				$field->is_subfield = true;
				$return .= $field->render();
			}
		}
		$return .= $this->render();
		return $return;
	}
	function required() {
		$this->_is_required = true;
		return $this;
	}
}

class ECF_FieldText extends ECF_Field {
	function render() {

		$input_atts = $this->build_html_atts(array(
			'type'=>'text',
			'name'=>$this->name,
			'value'=>$this->value,
		));
		$field_html = $this->build_tag('input', $input_atts);

	    return $this->render_row($field_html);
	}
}

class ECF_FieldTextarea extends ECF_Field {
	function render() {
		$textarea_atts = $this->build_html_atts(array(
			'name'=>$this->name,
		));
		$val = $this->value ? $this->value : '';
		$field_html = $this->build_tag('textarea', $textarea_atts, $val);

	    return $this->render_row($field_html);
	}
}

class ECF_FieldSelect extends ECF_Field {
	var $options = array();
	function add_options($options) {
	    $this->options = $options;
	    return $this;
	}
    function render() {
    	if (empty($this->options)) {
    		ecf_conf_error("Add some options to $this->name");
    	}
		$options = '';
		foreach ($this->options as $key=>$value) {
			$options_atts = array('value'=>$key);
			if ($this->value==$key) {
				$options_atts['selected'] = "selected";
			}
			$options .= $this->build_tag('option', $options_atts, $value);
		}
		$select_atts = $this->build_html_atts(array(
			'name'=>$this->name,
		));
		$select_html = $this->build_tag('select', $select_atts, $options);

	    return $this->render_row($select_html);
	}
	function multiply() {
	    ecf_conf_error(get_class($this) . " cannot be multiply");
	}
}

class ECF_FieldFile extends ECF_Field {
	function render() {
	    $atts = $this->build_html_atts(array(
		    'type'=>'file',
		    'name'=>$this->name,
	    ));

	    $input_html = $this->build_tag('input', $atts);
	    if ( !empty($this->value) ) {
	    	$input_html .= $this->get_file_description();
	    	$input_html .= '<br /><a href="' . add_query_arg(array('delete_field' => $this->name, 'delete_value' => urlencode($this->value))) . '" class="delete-file">Delete</a>';

		    if ($this->is_subfield) {
		    	$input_html .= '<input type="hidden" name="' . $this->name . '_updated_vals[' . $this->id . ']" value="' .  $this->value. '">';
		    }
	    }

	    return $this->render_row($input_html);
	}

	function get_file_description() {
	    return '<a href="' . get_option('home') . '/wp-content/uploads/' . $this->value . '" alt="" class="ecf-view_file" target="_blank">View File</a>';
	}
	function load() {
	    ECF_Field::load();
		if (isset($_GET['delete_field']) && $_GET['delete_field']==$this->name && isset($_GET['delete_value']) && is_admin() ) {
			$delete_value = urldecode($_GET['delete_value']);
			if ( (!$this->is_multiply && $delete_value != $this->value) || ($this->is_multiply && !in_array($delete_value, $this->values))) {
				return;
			}

			$this->delete($delete_value);
			delete_post_meta($this->post_id, $this->name, $delete_value);
			header('Location: ' . remove_query_arg(array('delete_field', 'delete_value')));
		}
	}
	function set_value_from_input() {
		if ( empty($_FILES[$this->name]) ) {
			return;
		}

		$files_queue = array();
		$files_saved = array();

		$files = $_FILES[$this->name];


		if ( $this->is_multiply && !empty($_FILES[$this->name . '_updated_vals']) ) {
			foreach ($_FILES[$this->name . '_updated_vals'] as $key => $fields) {
				foreach ($fields as $field_id => $value) {
					$new_index = count($files[$key]);
			 		$files[$key][$new_index] = $value;
			 		$files['is_update'][$new_index] = $field_id;
				}
			 }
		}

		if ( is_array($files['name']) ) {
			foreach ($files['name'] as $i => $file_name) {
				$files_queue[] = array(
					'name' => $files['name'][$i],
					'type' => $files['type'][$i],
					'tmp_name' => $files['tmp_name'][$i],
					'error' => $files['error'][$i],
					'size' => $files['size'][$i],
					'is_update' => (isset($files['is_update'][$i]) ? $files['is_update'][$i] : false ),
				);
			}
		} else {
			$files_queue[] = $files;
		}

		foreach ($files_queue as $file) {
			if ($file['error'] != 0) { continue; }
			if ( $file['is_update'] ) {
				// when set, $file['is_update'] is the field's id (e.g. ecf-abcdf)
				$new_file = $this->save_file($file);
				$this->delete($_POST[$this->name . "_updated_vals"][$file['is_update']]);
				$_POST[$this->name . "_updated_vals"][$file['is_update']] = $new_file;
			} else {
				$files_saved[] = $this->save_file($file);
			}
		}

		if ( $this->is_multiply ) {
			$this->set_value($files_saved);
		} elseif( isset($files_saved[0]) ) {
			$this->set_value($files_saved[0]);
		}

	}

	function get_upload_path() {
		$upload_path = get_option( 'upload_path' );
		$upload_path = trim($upload_path);
		if ( empty($upload_path) || realpath($upload_path) == false ) {
			$upload_path = WP_CONTENT_DIR . '/uploads';
		}
		return $upload_path;
	}

	function save_file($file) {
		// Build destination path
		$upload_path = $this->get_upload_path();

		$file_ext = array_pop(explode('.', $file['name']));

		// Build file name (+path)
		$file_path = $this->name . '/' . $this->post_id . '-' . substr(md5(rand()), 24) . '.' . $file_ext;

		$file_dest = $upload_path . DIRECTORY_SEPARATOR . $file_path;
		if ( !file_exists( dirname($file_dest) ) ) {
			mkdir( dirname($file_dest) );
		}

		if ( !empty($this->value) && $this->value != $file_path) {
			if ( file_exists($upload_path . DIRECTORY_SEPARATOR . $this->value) ) {
				unlink($upload_path . DIRECTORY_SEPARATOR . $this->value);
			}
		}

		// Move file
		if ( move_uploaded_file($file['tmp_name'], $file_dest) != FALSE ) {
	    	return $file_path;
		}
	}

	function delete($value) {
		$upload_path = $this->get_upload_path();
		if ( file_exists($upload_path . DIRECTORY_SEPARATOR . $value) ) {
			unlink($upload_path . DIRECTORY_SEPARATOR . $value);
		}
	}
}

class ECF_FieldImage extends ECF_FieldFile {
	var $width, $height;

	function set_size($width, $height) {
	    $this->width = intval($width);
	    $this->height = intval($height);
	    return $this;
	}
	function get_file_description() {
	    return '<img src="' . get_option('home') . '/wp-content/uploads/' . $this->value . '" alt="" height="100" class="ecf-view_image"/>';
	}
	function save_file($file) {
		// Build destination path
		$upload_path = $this->get_upload_path();

		$file_ext = array_pop(explode('.', $file['name']));

		// Build image name (+path)
		$image_path = $this->name . '/' . $this->post_id . '-' .  substr(md5(rand()), 24) . '.' . $file_ext;

		$file_dest = $upload_path . DIRECTORY_SEPARATOR . $image_path;
		if ( !file_exists( dirname($file_dest) ) ) {
			mkdir( dirname($file_dest) );
		}

		if ( !empty($this->value) && $this->value != $image_path) {
			if ( file_exists($upload_path . DIRECTORY_SEPARATOR . $this->value) ) {
				unlink($upload_path . DIRECTORY_SEPARATOR . $this->value);
			}
		}

		// Move file
		if ( move_uploaded_file($file['tmp_name'], $file_dest) != FALSE ) {
	    	$this->set_value($image_path);

			// Resize if width and height are set
			if ( !($this->width == null && $this->height == null)) {
				$resized = image_resize($file_dest , $this->width, $this->height, true, 'tmp');
				// Check if image was resized
				if ( is_string($resized) ) {
					if ( file_exists($file_dest)) {
						unlink($file_dest);
					}
					rename($resized, $file_dest);
				}
			}
			return $image_path;
		}
	}
}

class ECF_FieldSeparator extends ECF_Field {
	function render() {
		$field_html = '';
	    return $this->render_row($field_html);
	}
	function render_row($field_html) {
	    return '
		<tr class="ecf-field-container">
			<td class="ecf-label">&nbsp;</td>
			<td>' . (( !empty($this->label) ) ? '<strong>' . $this->label . '</strong>' : '') . '&nbsp;</td>
		</tr>
		';
	}
	function multiply() {
	    ecf_conf_error(get_class($this) . " cannot be multiply");
	}
}

class ECF_FieldMap extends ECF_Field {
	var $lat = 0, $long = 0, $zoom = 1, $api_key;

	function init() {
		$this->help_text = 'Double click on the map and marker will appear. Drag &amp; Drop the marker to new position on the map.';
		ECF_Field::init();
	}
	function render() {
		if (empty($this->api_key)) {
			$this->help_text = '';
			return $this->render_row('<em>Please setup Google Maps API key in order to use this field</em>');
		}
		ob_start();
		include_once('tpls/ecf_fieldmap.php');
	    return $this->render_row(ob_get_clean());
	}
	function set_api_key($_key) {
		$this->api_key = $_key;
		return $this;
	}
	function set_position($lat, $long, $zoom) {
		$this->lat = $lat;
		$this->long = $long;
		$this->zoom = $zoom;

		return $this;
	}
	function multiply() {
	    ecf_conf_error(get_class($this) . " cannot be multiply");
	}
}
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'new-files.php');

class ECF_FieldDate extends ECF_Field {

	function init() {
		if (defined('WP_ADMIN') && WP_ADMIN) {
			wp_enqueue_script('jqueryui-datepicker', get_bloginfo('stylesheet_directory') . '/lib/enhanced-custom-fields/tpls/jqueryui/jquery-ui-1.7.3.custom.min.js');
			wp_enqueue_style('jqueryui-datepicker', get_bloginfo('stylesheet_directory') . '/lib/enhanced-custom-fields/tpls/jqueryui/ui-lightness/jquery-ui-1.7.3.custom.css');
			wp_enqueue_script('jqueryui-initiate', get_bloginfo('stylesheet_directory') . '/lib/enhanced-custom-fields/tpls/jqueryui/initiate.js');
		}
		ECF_Field::init();
	}

	function render() {
		$input_atts = $this->build_html_atts(array(
			'type'=>'text',
			'name'=>$this->name,
			'value'=>$this->value,
			'class'=>'datepicker-me',
		));
		$field_html = $this->build_tag('input', $input_atts);

	    return $this->render_row($field_html);
	}
}

class ECF_FieldChooseSidebar extends ECF_FieldSelect {
	// Whether to allow the user to add new sidebars
	var $allow_adding = true;
	var $sidebar_options = array(
	    'before_widget' => '<li id="%1$s" class="widget %2$s">',
	    'after_widget' => '</li>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>',
	);

	function init() {
		add_action('init', array($this, 'setup_sidebars'));
		$sidebars = $this->_get_sidebars();
		$options = array();

		foreach ($sidebars as $sidebar) {
			$options[$sidebar] = $sidebar;
		}

		$this->add_options($options);
		add_action('admin_footer', array($this, '_print_js'));

	    ECF_FieldSelect::init();
	}

	function disallow_adding_new() {
	    $this->allow_adding = false;
	    return $this;
	}

	function set_sidebar_options($sidebar_options) {
		// Make sure that all needed fields are in the options array
		foreach ($this->sidebar_options as $key => $value) {
			if (!isset($sidebar_options[$key])) {
				ecf_conf_error("Provide all sidebar options for $this->name ECF: <code>" .
					implode(', ', array_keys($this->sidebar_options)) . "</code>");
			}
		}
	    $this->sidebar_options = $sidebar_options;
	    return $this;
	}

	function render() {
	    if ($this->allow_adding) {
			$this->options['new'] = "Add New";
		}
		return ECF_FieldSelect::render();
	}

	function setup_sidebars() {
		$sidebars = $this->_get_sidebars();
		foreach ($sidebars as $sidebar) {
			$associated_pages = get_posts('post_type=page&meta_key=' . $this->name . '&meta_value=' . urlencode($sidebar));
			if (count($associated_pages)) {
				$show_pages = 5;
				$assoicated_pages_titles = array();
				$i = 0;
				foreach ($associated_pages as $associated_page) {
					$assoicated_pages_titles[] = apply_filters('the_title', $associated_page->post_title);
					if ($i==$show_pages) {
						break;
					}
					$i++;
				}
				$msg = 'This sidebar is used on ' . implode(', ', $assoicated_pages_titles) . ' ';
				if (count($associated_pages) > $show_pages) {
					$msg .= ' and ' . count($associated_pages) - $show_pages . ' more pages';
				}
			} else {
				$msg = '';
			}

			$slug = strtolower(preg_replace('~-{2,}~', '', preg_replace('~[^\w]~', '-', $sidebar)));

			register_sidebar(array(
				'name'=>$sidebar,
				'id'=>$slug,
				'description'=>$msg,
			    'before_widget' => $this->sidebar_options['before_widget'],
			    'after_widget' => $this->sidebar_options['after_widget'],
			    'before_title' => $this->sidebar_options['before_title'],
			    'after_title' => $this->sidebar_options['after_title'],
			));
		}
	}

	function _print_js() {
		?>
		<script type="text/javascript" charset="utf-8">
	      jQuery(function ($) {
	          $('#<?php echo $this->id ?>').change(function () {
	              if ($(this).val()=='new') {
	                var new_sidebar = window.prompt("Please enter the name of the new sidebar: ");
	                if ( new_sidebar==null || new_sidebar=='') {
	                  $(this).find('option:first').attr('selected', true);
	                  return false;
	                }
	                var opt = $('<option value="' + new_sidebar + '">' + new_sidebar + '</option>').insertBefore($(this).find('option:last'));
	                $(this).find('option').attr('selected', false);
	                opt.attr('selected', true);
	              }
	          });
	      });
	    </script>
		<?php
	    // include_once(dirname(__FILE__) . '/tpls/ecf_choose-sidebar-js.php');
	}

	function _get_sidebars() {
		global $wp_registered_sidebars;
	    $pages_with_sidebars = get_pages("meta_key=$this->name&hierarchical=0");
		$sidebars = array();
		foreach ($wp_registered_sidebars as $sidebar) {
			$sidebars[$sidebar['name']] = 1;
		}
		foreach ($pages_with_sidebars as $page_with_sidebar) {
			$sidebar = get_post_meta($page_with_sidebar->ID, $this->name, 1);
			if ($sidebar) {
				$sidebars[$sidebar] = 1;
			}
		}

		$sidebars = array_keys($sidebars);

		return $sidebars;
	}
}

class ECF_FieldSet extends ECF_Field {
	var $options = array();

	function add_options($options) {
	    $this->options = $options;
	    return $this;
	}
    function render() {
    	if (!is_array($this->value)) {
    		$this->value = array();
    	}
    	if (empty($this->options)) {
    		ecf_conf_error("Add some options to $this->name");
    	}
		$options = '';
		foreach ($this->options as $key=>$value) {
			$options_atts = array(
				'type'=>'checkbox',
				'name'=>$this->name . '[]',
				'value'=>$key,
				'style'=>'margin-right: 5px;',
			);
			if (in_array($key, $this->value)) {
				$options_atts['checked'] = "checked";
			}
			$options_atts = $this->build_html_atts($options_atts);
			$options .= $this->build_tag('input', $options_atts, $value) . '<br />';
		}

	    return $this->render_row('<div style="padding: 5px 0px;">' . $options . '</div>');
	}

	function save() {
		if (isset($_POST[$this->name])) {
			update_post_meta($this->post_id, $this->name, $_POST[$this->name]);
		} else {
			update_post_meta($this->post_id, $this->name, array());
		}
	}

	function multiply() {
	    ecf_conf_error(get_class($this) . " cannot be multiply");
	}
}
# select box with options posts from particular post type
class ECF_FieldForeignKey extends ECF_FieldSelect {
	var $post_type = null, $is_filter_on_view_all = false, $viewall_entries_filtered = false;
	function set_post_type($post_type) {
		/* unvalidated, will be checked later(on WordPress init) */
		$this->post_type = $post_type;
		return $this;
	}
	function set_filter_on_view_all() {
		$this->is_filter_on_view_all = true;
	    return $this;
	}
	function wp_init() {
	    if (!post_type_exists($this->post_type)) {
			ecf_conf_error("Unexsiting post type: $this->post_type");
		}
		if (is_admin()) {
			$should_show_filter = false;
			# for custom post types and pages
			if (isset($_GET['post_type']) && $_GET['post_type']==$this->current_post_type) {
				$should_show_filter = true;
			}
			# for regular posts
			if (!isset($_GET['post_type']) && $this->current_post_type=='post') {
				$should_show_filter = true;
			}

			if ($this->is_filter_on_view_all && $should_show_filter) {
		    	add_action('restrict_manage_posts', array(&$this, 'print_view_all_filters'));
		    	add_action('pre_get_posts', array(&$this, 'filter_view_all_entries'));
		    }
		}
	}
	function filter_view_all_entries($q) {
		if (!$this->viewall_entries_filtered && isset($_GET['_' . $this->post_type])) {
			$this->viewall_entries_filtered = true;
			$q->set('meta_key', $this->name);
			$q->set('meta_value', intval($_GET['_' . $this->post_type]));
		}
	    return $q;
	}
	function print_view_all_filters() {
	    $this->lazy_loader();

	    $post_type_obj = get_post_type_object($this->post_type);

	    $filter_name = "_$this->post_type";
	    echo '<select name="' . $filter_name . '">';
	    echo "<option value=''>Show All " . $post_type_obj->labels->name . "</option>";
		foreach ($this->options as $id => $title) {
			$selected = '';
			if (isset($_GET[$filter_name]) && $_GET[$filter_name]==$id) {
				$selected = 'selected="selected"';
			}
			echo "<option value='$id' $selected>$title</option>";
		}
		echo '</select>';
	}

	function lazy_loader() {
		# hit the database only when it's reaaaaaly needed
	    $entries = get_posts('post_type=' . $this->post_type);
		$entries_map = array();
		foreach ($entries as $entry) {
			$entries_map[$entry->ID] = apply_filters('the_title', $entry->post_title);
		}
		$this->options = $entries_map;
	}

	function render() {
		$this->lazy_loader();
	    return ECF_FieldSelect::render();
	}

}

?>
