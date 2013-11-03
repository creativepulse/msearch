<?php

/**
 * msearch
 *
 * @version 1.2
 * @author Creative Pulse
 * @copyright Creative Pulse 2010-2013
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @link http://www.creativepulse.gr
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


require_once(dirname(__FILE__) . '/helper.php');

$mod = new Mod_MSearch();
$mod->prepare($params);

$path = JModuleHelper::getLayoutPath('mod_msearch', $params->get('layout', 'default'));
if (file_exists($path)) {
    require($path);
}

?>