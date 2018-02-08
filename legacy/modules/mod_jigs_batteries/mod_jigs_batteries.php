<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access

defined('_JEXEC') or die('Restricted access');

 // require_once (dirname(__FILE__).DS.'helper.php');

$layout = $params->get('style','default'); 

$path	= JModuleHelper::getLayoutPath('mod_jigs_batteries', $layout);


if (file_exists($path))
	{
		require ($path);

	}
	
	?>
<script type='text/javascript'>

function request_batteries()
{
	
	 var all = '';
	//	var details = this.details;
	
	var a = new Request.JSON({
	url: "index.php?option=com_battle&format=raw&task=action&action=get_batteries",
	onSuccess: function(result)
	{
	       	for (i = 0; i < result.length; ++ i)
	       	{
			var row = "<span class=\"label\">Battery " + (i+1) + ":</span>" + result[i][1]  + " : " + result[i][2];
			all= all + row + "<br />";   
	    	}

	    	all= all+ "<input type='button' value='Update' onclick= 'request_batteries();'></button>";
	    	document.id('batteries').innerHTML = all;	
	}	
    	
    }).get();

}

request_batteries();
//request_batteries.periodical(50085);

</script>	
