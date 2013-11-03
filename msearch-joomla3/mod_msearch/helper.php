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


if (!class_exists('Mod_MSearch')) {

    class Mod_MSearch {

        function instance_id($new = false) {
            static $num = 0;

            if ($new) {
                $num++;
            }

            return $num;
        }

        function prepare(&$params) {
            $this->instance_id(true);

            $this->options = array();
            $this->sel_option = '';

            $types = array(
                'joomla' => 'Website',
                'virtuemart' => 'VirtueMart',
                'google' => 'Google',
                'googlesite' => 'Website from Google',
                'yahoo' => 'Yahoo',
                'yahoosite' => 'Website from Yahoo',
                'bing' => 'Bing',
                'bingsite' => 'Website from Bing'
            );

            $first_option = false;
            $virtuemart = false;
            foreach (explode("\n", $params->get('search_options', '')) as $line) {
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

                    if ($type == 'virtuemart') {
                        $virtuemart = true;
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

            $document = JFactory::getDocument();
            if ($this->instance_id() == 1) {
                $document->addScript('modules/mod_msearch/js/msearch.js');
                $document->addScriptDeclaration('document.mod_msearch_site_url = "' . JUri::base() . '";');
            }

            if ($virtuemart) {
                $document->addScriptDeclaration('document.mod_msearch_vm_link = "' . JRoute::_('index.php?option=com_virtuemart&view=category&search=true&limitstart=0&virtuemart_category_id=0') . '";');
            }
        }
    }

}

?>