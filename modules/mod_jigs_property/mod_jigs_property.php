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

    $.ajax({
      url:"index.php?option=com_battle&format=raw&task=action&action=get_property",
      success:function(result) {

        var obj = JSON.parse(result);

          for (i = 0; i < obj.length; ++ i){
            var row = obj[i].image;
            all= all + row;
          }
          jQuery('#property').html(all);
        }

      });
    };



request_property();


</script>