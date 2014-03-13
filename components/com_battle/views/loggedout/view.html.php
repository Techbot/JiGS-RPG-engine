<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewloggedout extends JView
{	
	function display($tpl = null)
	{
	//	$id = (int) JRequest::getVar('id', 0);
	
		
		//$model = &$this->getModel();
		//$model->enter_ward();
		
	//	echo '<pre>';
	//	print_r($model);
	//	echo '</pre>';

		parent::display($tpl);
	}
}
