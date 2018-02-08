<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access

defined('_JEXEC') or die('Restricted access');

 // require_once (dirname(__FILE__).DS.'helper.php');

$layout = $params->get('style','default'); 

$path = JModuleHelper::getLayoutPath('mod_jigs_metals', $layout);


if (file_exists($path))
	{
	require ($path);
	}
	?>
<script type='text/javascript'>

function request_metals(){
	var total_metals = parseInt(0);
	var all = '';
	//	var details = this.details;
	var a = new Request.JSON({
        url: "index.php?option=com_battle&format=raw&task=action&action=get_metals2", 
        onSuccess: function(result)
        {
            for (i = 0; i < result.length; ++ i)
            {
                var row         = "<span class='label'>Metal" + (i+1) + ":</span>" + result[i].name  + " : " + result[i].quantity;
                all             = all + row;  
                total_metals    = parseInt(total_metals) + parseInt(result[i].quantity);
                all             = all + '<br/>';
            }
            all = all + '<hr />Total Metals: ' + total_metals;
            all = all + '<br /><input type="button" value="Update" onclick= "request_metals();"></button>'; 
           
            document.id('metal').innerHTML = all;	
        }
    }).get();
    
}    

request_metals();
	
</script>	
