<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class BattleViewHobbits extends JViewLegacy
{	
	function display($tpl = null)
	{
		
		$model  = $this->getModel();
		
		$user   = JFactory::getUser();
		
		$rows   = $model->getData($user->id);
		
		$this->assignRef('rows', $rows);
		
		parent::display($tpl);
	}
	
	
	
	
	
	
	
}



