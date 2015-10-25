<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access

defined('_JEXEC') or die('Restricted access');

 require_once (dirname(__FILE__).'/helper.php');

$layout = $params->get('style','default'); 

$path = JModuleHelper::getLayoutPath('mod_jigs_property', $layout);


if (file_exists($path))
    {
    require ($path);

    }
 ?>

<script type='text/javascript'>

function request_property(){

     var all = '';
    //	var details = this.details;

    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=get_property", 
    onSuccess: function(result){

   for (i = 0; i < result.length; ++ i){
  var row = "<br>Item " + (i+1) + ":" + result[i].name ;
  all= all + row;  
        }
        $('property').innerHTML = all;
    }

    }).get();

}



request_property.periodical(200000);	


</script>




