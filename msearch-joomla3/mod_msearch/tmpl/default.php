<?php

/**
 * mod_msearch
 *
 * @version 1.2
 * @author Creative Pulse
 * @copyright Creative Pulse 2010-2013
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @link http://www.creativepulse.gr
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


if ($mod->instance_id() == 1) {
    $document = JFactory::getDocument();
    $document->addStyleDeclaration('
.mod_msearch {
    font-size: 0.9em;
}
');
}

echo '
<div id="mod_msearch_' . $mod->instance_id() . '" class="mod_msearch">
    <form id="form_msearch_' . $mod->instance_id() . '" name="form_msearch_' . $mod->instance_id() . '" method="post" action="" onsubmit="return mod_msearch_h_submit(this)">
        <input type="text" name="q" value="" />
        <div>
';

foreach ($mod->options as $k => $v) {
    echo
'           <input id="mod_msearch_' . $mod->instance_id() . '_' . $k . '" type="radio" name="typ" value="' . $k . '"' . ($k == $mod->sel_option ? ' checked="checked"' : '') . ' /><label for="mod_msearch_' . $mod->instance_id() . '_' . $k . '">' . JText::_($v) . '</label>
';
}

echo
'       </div>
    </form>

    <noscript>Error: JavaScript is not enabled in your browser</noscript>
</div>
';

?>