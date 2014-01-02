<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access

defined('_JEXEC') or die('Restricted access');

require_once (dirname(__FILE__).DS.'helper.php');

$layout		= $params->get('style','default'); 

$path		= JModuleHelper::getLayoutPath('mod_jigs_message_manager', $layout);

if (file_exists($path))
	{
	require ($path);
	}
	?>
<script type='text/javascript'>
function request_messages(){
	var messages = '';
	var all = '';
	var details = this.details;
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_messages", 
    onSuccess: function(result)
    {
		
		
		
	   	Array.each(result, function(message,index)
	    {
	        messages = messages + '<p>' + message['message'] + '</p>';
	 	}
	 	);
		
		div ="<div id = 'message_table'>";
		div += messages;
		div +="</div>";
		
		document.id('messages').innerHTML = div;
    }	
 	
    }).get();		
		
	   	//Array.each(result, function(message,index)
	    //{
	    //    messages = messages + '<tr><td>' + message['message'] + '</td></tr>';
	 	//}
	 	//);
		
		//table ="<table id = 'message_table'>";
		//table += messages;
		//table +="</table>";
		
		//$('messages').innerHTML = table;
    //}	
 	
    //}).get();

}
request_messages();
request_messages.periodical(15000);

</script>

	

	
