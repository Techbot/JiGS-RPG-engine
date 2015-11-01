<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewCanvas extends JViewLegacy
{	
	function display($tpl="001b")
	{
	//	$id = (int) JRequest::getVar('id', 0);
	
		$model = $this->getModel();
		
		$tpl            = $model->enter_Canvas();
		
		//$this->model2         = JModel::getInstance('ascii_art','BattleModel');
		
		//Json_encode(print_r($this->model2->show(range("a", "z"), 0.25, true, true)));
		
		//print_r($this->model2->show());

		//print_r($this->model2);
	//	exit();

	//	$this->model2->setFontSize(6);

       // $this->x        = $model2->AsciiArt('205-f.jpg');
    //    $this->color    = $this->model2->getBackgroundColor()->getHexValue();

		
	//	echo '<pre>';
	//	print_r($model);
	//	echo '</pre>';

		parent::display($tpl);
	}
}
