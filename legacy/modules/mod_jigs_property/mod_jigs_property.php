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
function request_property() {
    var all = '';
    jQuery.ajax({
        url: "index.php?option=com_battle&format=raw&task=action&action=get_property",
        success: function (result) {
            var obj = JSON.parse(result);
            for (var i = 0; i < obj.length; ++i) {
                var row = '<a href ="index.php?option=com_battle&task=specialaction&action=jump&buildingid='
                    + obj[i].id
                    + '" title= "jump to '
                    + obj[i].name
                    + '"><img src="/components/com_battle/images/buildings/'
                    + obj[i].image
                    + '" height="32"></a>';



                all = all + row;
            }
            jQuery('#property').html(all);
        }
    });
};
request_property();
</script>