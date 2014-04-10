<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewweapons extends JView
{	
	function display($tpl = null)
	{

		$players		= JTable::getInstance('players', 'Table');
		$model			= $this->getModel();
		
		$this->assignRef('inv',$model->get_weapons());
	
		parent::display($tpl);
	}
}
