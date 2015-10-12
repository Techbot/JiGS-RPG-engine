<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewRoom extends JViewLegacy
{	
	function display($tpl = null)
	{
		$this->room		= JRequest::getVar('room');
		$this->building = JRequest::getVar('building');
		$model			= $this->getModel();
		$model->enter_room();
		
	//	echo '<pre>';
	//	print_r($model);
	//	echo '</pre>';

		parent::display($tpl);
	}
}
