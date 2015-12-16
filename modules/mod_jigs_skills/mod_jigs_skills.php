<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/
// no direct access
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).'/helper.php');
$layout = $params->get('style','default');
$path = JModuleHelper::getLayoutPath('mod_jigs_skills', $layout);
if (file_exists($path))
    {
    require ($path);
    }
    ?>
<script type='text/javascript'>
function request_skills() {
    var all = '';
    var details = this.details;
    var a = new Request.JSON({
        url: "index.php?option=com_battle&format=raw&task=action&action=get_skills",
        onSuccess: function (result) {
            for (i = 0; i < 8; ++i) {
                var row = "<br>Skill " + (i + 1) + ":" + result[i + 1]['name'] + ' Lvl:' + result[i + 1]['level'];
                all = all + row;
            }
            jQuery('#skills').html(all);
        }
    }).get();
}
request_skills();
</script>
