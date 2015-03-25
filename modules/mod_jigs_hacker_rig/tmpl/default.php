<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();

if ($rig[0]!=null) {
    foreach ($rig[0] as $module) {

  //      print_r( $module);

    }
}

echo $user->id . "<br />";



