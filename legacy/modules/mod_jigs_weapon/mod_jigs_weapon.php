<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access

defined('_JEXEC') or die('Restricted access');

require_once (dirname(__FILE__).DS.'helper.php');

$layout = $params->get('style','default'); 

$path = JModuleHelper::getLayoutPath('mod_jigs_weapon', $layout);

if (file_exists($path))
	{
	require ($path);
	}
	?>
<script type='text/javascript'>

function request_weapon(){
	
	 var all = '';
//		var details = this.details;
	
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_weapon", 
    onSuccess: function(result){
   
  	
    	$('#weapon').innerHTML = result;	
    	
    	
    }	
    }).get();
}
    request_weapon();
	request_weapon.periodical(10000);
</script>

	

	
