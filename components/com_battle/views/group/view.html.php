<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewgroup extends JViewLegacy
{	
	function display($tpl = null)
	{
		$model      = JModel::getInstance('factions','BattleModel');

		$this->assignRef('groups',$model->get_group_members());
	
	//	$backlink = JRoute::_('index.php?option=com_battle');
	//	$this->assignRef('players', $players);		
	//	$this->assignRef('backlink', $backlink);
		parent::display($tpl);
	}
}


