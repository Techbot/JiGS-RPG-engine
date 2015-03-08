<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access
defined('_JEXEC') or die('Restricted access');



$user =& JFactory::getUser();
	
	?>
	<p>Name: <?php echo $user->name; ?></p>
		<p>Username: <?php echo $user->username; ?></p>
		<p>Email: <?php echo $user->email; ?></p>
		<p>User Type: <?php echo $user->usertype; ?></p>
		<p>User Group ID: <?php echo $user->gid; ?></p>
		<p>Register Date: <?php echo JHTML::_('date', $user->registerDate); ?></p>
		<p>Last Visit Date: <?php echo JHTML::_('date', $user->lastvisitDate); ?></p>
		<p>Block: <?php echo $user->block; ?></p>
		<p>Send Email: <?php echo $user->sendEmail; ?></p>
		<p>Guest: <?php echo $user->guest; ?></p>
	
	