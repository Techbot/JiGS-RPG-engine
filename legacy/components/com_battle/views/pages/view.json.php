<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewPages extends JViewLegacy
{	
	function display()
	{
	//	$id = (int) JRequest::getVar('id', 0);
	
	////	$model = $this->getModel();
	//	$tpl = $model->enter_Canvas();
		
	//	echo '<pre>';
	//	print_r($model);
	//	echo '</pre>';

		parent::display($tpl);
	}
}
