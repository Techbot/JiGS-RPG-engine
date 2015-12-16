<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewgroups extends JViewLegacy
{	
	function display($tpl = null)
	{
		$user	= JFactory::getUser();
		$id		= $user->id;
		$model  = $this->getModel();
		$groups = $model->get_group_stats();
		foreach ($groups as $group)
		{
		    $captain_object         =  JFactory::getUser($group->captain);
		    $group->captain_name    = $captain_object->username;
		    $group->avatar          = $model->get_avatar($group->captain) ;
		}

		$this->assignRef('factions',$groups);
    	parent::display($tpl);
	}
}

