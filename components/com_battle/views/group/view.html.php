<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewgroup extends JView
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


