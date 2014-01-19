<?php

/*
Plugin Name: Multi Search
Plugin URI: http://www.creativepulse.gr/en/appstore/msearch
Version: 1.3
Description: Multi Search uses the inherent search facilities of various systems (WordPress, Google, Bing, Yahoo), all in one plugin.
License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
Author: Creative Pulse
Author URI: http://www.creativepulse.gr
*/


class CpMultiSearch extends WP_Widget {

	function __construct() {
		$options = array('classname' => 'CpMultiSearch', 'description' => 'Search through search facilities of multiple systems.');
		$this->WP_Widget('CpMultiSearch', 'Multi Search', $options);
	}

	function register_widget() {
		register_widget(get_class($this));
	}

	function widget($args, $instance) {
		$layout = (string) @$instance['layout'];
		if ($layout == '') {
			return;
		}

		require_once(dirname(__FILE__) . '/inc/widget.php');
		$widget = CpWidget_MSearch::get_model();
		$widget->prepare($instance['search_options']);

		echo $args['before_widget'];
		echo empty($instance['title']) ? '' : $args['before_title']. $instance['title'] . $args['after_title'] . "\n";

		$layout_filename = dirname(__FILE__) . '/widget_layouts/' . $layout . '.php';
		if (strpos($layout, "\0") !== false || strpos($layout, '..') !== false || strpos($layout, ':') !== false || strpos($layout, '/') !== false || strpos($layout, '\\') !== false) {
			echo __('Invalid layout value') . "\n";
		}
		else if (!file_exists($layout_filename)) {
			echo __('Layout script not found') . "\n";
		}
		else {
			require($layout_filename);
		}

		echo $args['after_widget'];
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['search_options'] = $new_instance['search_options'];
		$instance['layout'] = $new_instance['layout'];
		return $instance;
	}

	function form($instance) {

		$layouts = array();
		$path = dirname(__FILE__) . '/widget_layouts';
		if ($dp = @opendir($path)) {
			while (false !== ($file = readdir($dp))) {
				if (preg_match('/\.php$/', $file)) {
					$layouts[] = substr($file, 0, -4);
				}
			}
			closedir($dp);
		}
		$sel_layout = !empty($instance['layout']) ? $instance['layout'] : 'default';

		$instance = wp_parse_args((array) $instance, array('title' => '', 'search_options' => '', 'layout' => ''));
		echo
'<p><label for="' . $this->get_field_id('title') . '">' . __('Title') . ':</label>
	<input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($instance['title']) . '" />
</p>
<p><label for="' . $this->get_field_id('search_options') . '">' . __('Search options') . ':</label>
	<textarea class="widefat" id="' . $this->get_field_id('search_options') . '" name="' . $this->get_field_name('search_options') . '">' . esc_textarea($instance['search_options']) . '</textarea>
</p>
<p><label for="' . $this->get_field_id('layout') . '">' . __('Layout') . ':</label>
	<select class="widefat" id="' . $this->get_field_id('layout') . '" name="' . $this->get_field_name('layout') . '">
';

		foreach ($layouts as $layout) {
			echo
'		<option value="' . htmlspecialchars($layout) . '"' . ($sel_layout == $layout ? ' selected="selected"' : '') . '>' . htmlspecialchars($layout) . '</option>
';
		}

		echo
'	</select>
</p>
';
	}

}

add_action('widgets_init', array('CpMultiSearch', 'register_widget'));

?>