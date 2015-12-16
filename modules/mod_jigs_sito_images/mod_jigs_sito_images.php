<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/
// no direct access
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).'/helper.php');
$layout = $params->get('style','default');
$path = JModuleHelper::getLayoutPath('mod_jigs_sito', $layout);
if (file_exists($path))
    {
    require ($path);
    }
    ?>
<script type='text/javascript'>
function request_sito() {
    var a = new Request.JSON({
        url: "index.php?option=com_battle&format=raw&task=action&action=getDirectoryContent",
        onSuccess: function (result) {

           // text = '<img src = "http://www.eclecticmeme.com/images/sito/' + result + '">';
            text = '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="images/sito/' + result + '" alt="" border="0" /></p>';
            jQuery('#sito').html(text);

        }
    }).get();
}
request_sito();
</script>
