<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewMain extends JViewLegacy
{
	function display($tpl = null)
	{
		$row =& JTable::getInstance('Main', 'Table');
		
		$this->form->params = $this->getModel()->get_params();
	

	
		
		parent::display($tpl);
	}
}
