<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewPlayer extends JViewLegacy
{	
	function display($tpl = null)
	{
		$id = (int) JRequest::getVar('id', 0);
		
		$player =& JTable::getInstance('players', 'Table');
		$player->load($id);
		
		
		$model = &$this->getModel();
		$player->avatar = $model->get_avatar($id);
		
	//	echo '<pre>';
	//	print_r($model);
	//	echo '</pre>';
		
				
		
		
		$this->assignRef('player', $player);		
	
		
		
		
		
		parent::display($tpl);
	}
}
