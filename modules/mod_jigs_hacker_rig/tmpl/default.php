<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();




echo 'LEVEL:' .  $rig[0]->level . '<br>';
echo 'SYSTEM:' .  $rig[0]->system . '<br>';
echo 'SPEED:' .  $rig[0]->speed . '<br>';
echo 'FIREWALL:' .  $rig[0]->firewall . '<br>';
echo 'MODEM:' .  $rig[0]->modem . '<br>';
echo 'IP:' .  $rig[0]->ip . '<br>';
echo $user->id . "<br />";



