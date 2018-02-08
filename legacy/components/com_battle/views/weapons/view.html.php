<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewweapons extends JViewLegacy
{	
	function display($tpl = null)
	{

		$players		= JTable::getInstance('players', 'Table');
		$model			= $this->getModel();
		
		$this->assignRef('inv',$model->get_weapons());
	
		parent::display($tpl);
	}
}
