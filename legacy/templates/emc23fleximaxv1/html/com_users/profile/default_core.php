<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

defined('_JEXEC') or die;

?>

<fieldset id="users-profile-core">
	<legend> <?php echo JText::_('COM_USERS_PROFILE_CORE_LEGEND'); ?> </legend>
	<div class="control-group">
		<label> <?php echo JText::_('COM_USERS_PROFILE_NAME_LABEL'); ?> </label>
		<div class="controls">
			<p class="help-block"><?php echo $this->data->name; ?></p>
		</div>
	</div>
	<div class="control-group">
		<label> <?php echo JText::_('COM_USERS_PROFILE_USERNAME_LABEL'); ?> </label>
		<div class="controls">
			<p class="help-block"><?php echo $this->data->username; ?></p>
		</div>
	</div>
	<div class="control-group">
		<label> <?php echo JText::_('COM_USERS_PROFILE_REGISTERED_DATE_LABEL'); ?> </label>
		<div class="controls">
			<p class="help-block"><?php echo JHtml::_('date', $this->data->registerDate); ?></p>
		</div>
	</div>
	<div class="control-group">
		<label> <?php echo JText::_('COM_USERS_PROFILE_LAST_VISITED_DATE_LABEL'); ?> </label>
		<?php if ($this->data->lastvisitDate != '0000-00-00 00:00:00'){?>
		<div class="controls">
			<p class="help-block"><?php echo JHtml::_('date', $this->data->lastvisitDate); ?></p>
		</div>
		<?php }
		else {?>
		<div class="controls">
			<p class="help-block"> <?php echo JText::_('COM_USERS_PROFILE_NEVER_VISITED'); ?></p>
		</div>
		<?php } ?>
	</div>
</fieldset>
