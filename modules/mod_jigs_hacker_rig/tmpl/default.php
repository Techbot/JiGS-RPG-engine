<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();

echo '<div class="hacker_rig">';
echo '<span id="levelValue">00' .  $rig[0]->level . '</span>';
echo '<label class="label system">System</label><span id="systemValue">000' .  $rig[0]->system . '</span>';
echo '<label class="label memory">Memory</label><span id="memoryValue">000' .  $rig[0]->speed . '</span>';
//echo '<label class="label">Firewall:</span>' .  $rig[0]->firewall;
echo '<label class="label modem">Modem Speed</label><span id="modemValue">0000' .  $rig[0]->modem . '</span>';
//echo '<label class="label ip">IP:</label>' .  $rig[0]->ip;
echo '</div>';