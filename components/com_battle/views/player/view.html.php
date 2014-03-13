<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewPlayer extends JView
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
