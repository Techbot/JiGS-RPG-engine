<?php
/**

 * @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

 */
// no direct access
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).'/helper.php');
$layout = $params->get('style','default');
$path = JModuleHelper::getLayoutPath('mod_jigs_software', $layout);
if (file_exists($path))
{
  require ($path);
}
    ?>
<script type='text/javascript'>
  function request_software() {
    var all = '';
    var details = this.details;

    var name = [];

    name[1]='Sub Routine';
    name[2]='Method';
    name[3]='Function';
    name[4]='Algorythm';
    name[5]='Stack';
    name[6]='Procedure';
    name[7]='API';
    name[8]='Plugin';

    var a = new Request.JSON({
      url: "index.php?option=com_battle&format=raw&task=software_action&action=get_software",
      onSuccess: function (result) {
        for (var i = 1; i < 8; ++i) {

          var row = "<span class=\"label\">" + name[i] + "</span></br>";
          //row = "Qty:" + result.qty[i] + " | $:" + result.price[i];
          all = all + row;

        }
        jQuery('#software').html(all);
      }
    }).get();
  }
  request_software();
</script>
