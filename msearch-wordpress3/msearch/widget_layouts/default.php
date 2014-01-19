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


if ($widget->view_id(true) == 1) {
	echo
'<style type="text/css">
.wdg_msearch {
	font-size: 0.9em;
}
</style>
';
}

echo '
<div id="wdg_msearch_' . $widget->view_id() . '" class="wdg_msearch">
	<form id="form_msearch_' . $widget->view_id() . '" name="form_msearch_' . $widget->view_id() . '" method="post" action="" onsubmit="return wdg_msearch_h_submit(this)">
		<input type="text" name="q" value="" />
		<div>
';

foreach ($widget->options as $k => $v) {
	echo
'           <input id="wdg_msearch_' . $widget->view_id() . '_' . $k . '" type="radio" name="typ" value="' . $k . '"' . ($k == $widget->sel_option ? ' checked="checked"' : '') . ' /><label for="wdg_msearch_' . $widget->view_id() . '_' . $k . '">' . __($v) . '</label>
';
}

echo
'       </div>
	</form>

	<noscript>' . __('Error: JavaScript is not enabled in your browser') . '</noscript>
</div>
';

?>