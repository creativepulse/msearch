<?php

/**
 * Multi Search
 *
 * @version 1.3
 * @author Creative Pulse
 * @copyright Creative Pulse 2010-2014
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @link http://www.creativepulse.gr
 */


if (!class_exists('CpWidget_MSearch')) {

	class CpWidget_MSearch {

		function get_model() {
			static $instance = null;
			if ($instance === null) {
				$instance = new CpWidget_MSearch();
			}
			return $instance;
		}

		function view_id($new = false) {
			static $num = 0;

			if ($new) {
				$num++;
			}

			return $num;
		}

		function prepare($params_search_options) {
			static $prepared = false;
			if ($prepared) {
				return;
			}
			else {
				$prepared = true;
			}

			$types = array(
				'wordpress' => 'Website',
				'google' => 'Google',
				'googlesite' => 'Website from Google',
				'yahoo' => 'Yahoo',
				'yahoosite' => 'Website from Yahoo',
				'bing' => 'Bing',
				'bingsite' => 'Website from Bing'
			);

			$this->options = array();
			$this->sel_option = '';
			$first_option = false;
			foreach (explode("\n", $params_search_options) as $line) {
				$line = trim($line);
				if ($line == '') {
					continue;
				}

				$e = explode('-', $line, 2);
				if (count($e) == 2) {
					$type = trim($e[0]);
					$title = trim($e[1]);
				}
				else {
					$type = $line;
					$title = (string) @$types[$type];
				}

				$sel = false;
				if (substr($type, -1) == '*') {
					$sel = true;
					$type = trim(substr($type, 0, -1));
				}

				if (isset($types[$type])) {
					if ($first_option === false) {
						$first_option = $type;
					}

					$this->options[$type] = $title;

					if ($sel) {
						$this->sel_option = $type;
					}
				}
			}

			if ($this->sel_option == '' && $first_option !== false) {
				$this->sel_option = $first_option;
			}

			echo
'<script type="text/javascript">
document.wdg_msearch_site_url = "' . get_settings('home') . '";
</script>
<script type="text/javascript" src="' . plugins_url('/js/msearch.js', dirname(__FILE__)) . '"></script>
';
		}
	}

}

?>