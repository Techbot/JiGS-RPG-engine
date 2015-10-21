<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access

defined('_JEXEC') or die('Restricted access');


jimport('joomla.html.pane');

require_once (dirname(__FILE__).'/helper.php');

$layout = $params->get('style','default'); 

$path = JModuleHelper::getLayoutPath('mod_jigs_weapons', $layout);

if (file_exists($path))
	{
	require ($path);
	}
	?>
<script type='text/javascript'>

function request_weapon(){
	
	var all = '';
	var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=get_weapon", 
   			onSuccess: function(result)
			{
				document.id('weapon_module').innerHTML = result;
			}	
    	}).get();
}
request_weapon();

</script>

	

	
