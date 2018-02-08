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
        url: "index.php?option=com_battle&format=raw&task=skills_action&action=get_skills",
        onSuccess: function (result) {
            for (var i = 0; i < 8; ++i) {

                var row = "<div class=\"skill\"><h3>Skill" + (i + 1) + "</h3><span>" + result[i]['name'] + " | </span><span>Lvl:" + result[i]['level'] + "</span></div>";
                all = all + row;
            }
            jQuery('#skills').html(all);
        }
    }).get();
}
request_skills();
</script>
