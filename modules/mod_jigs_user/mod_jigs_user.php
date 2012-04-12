<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access

defined('_JEXEC') or die('Restricted access');



$layout = $params->get('style','default'); 

$path = JModuleHelper::getLayoutPath('mod_jigs_user', $layout);


if (file_exists($path))
	{
	require ($path);

	}
	
	
	
	?>
	
	

	
