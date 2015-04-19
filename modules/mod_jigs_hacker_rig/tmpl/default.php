<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();

echo '<div class="hacker_rig">';
echo '<div class="level"><span class="label">Level:</span>' .  $rig[0]->level . '</div>';
echo '<div class="system"><span class="label">System:</span>' .  $rig[0]->system . '</div>';
echo '<div class="speed"><span class="label">Speed:</span>' .  $rig[0]->speed . '</div>';
echo '<div class="firewall"><span class="label">Firewall:</span>' .  $rig[0]->firewall . '</div>';
echo '<div class="modem"><span class="label">Modem:</span>' .  $rig[0]->modem . '</div>';
echo '<div class="ip"><span class="label">IP:</span>' .  $rig[0]->ip . '</div>';
echo '</div>';