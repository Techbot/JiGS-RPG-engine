<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access

defined('_JEXEC') or die('Restricted access');

require_once (dirname(__FILE__).'/helper.php');

$layout = $params->get('style','default'); 

$path = JModuleHelper::getLayoutPath('mod_jigs_software', $layout);


if (file_exists($path))
    {
    require ($path);

}

