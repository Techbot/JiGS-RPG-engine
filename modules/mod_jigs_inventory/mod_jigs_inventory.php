<?php
/**
* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).DS.'helper.php');
$layout     = $params->get('style','default'); 
$path       = JModuleHelper::getLayoutPath('mod_jigs_inventory', $layout);
if (file_exists($path))
	{
		require ($path);
	}
?>
<script type='text/javascript'>
function request_inventory()
{
	var all         = '';
	var details     = this.details;
	var a           = new Request.JSON(
	{
        url: "index.php?option=com_battle&format=raw&task=action&action=get_inventory2", 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row = "<span class=\"label\">Item" + (i+1) + ":</span>" + result[i].name ;
                all = all + row + "<br />"; 
            }
        	all = all + "<input type='button' value='Update' onclick= 'request_inventory();'></button>";
        	document.id('inventory_module').innerHTML = all;	
        }	
    }).get();
}
request_inventory();
</script>
