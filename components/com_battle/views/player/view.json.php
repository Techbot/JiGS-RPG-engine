<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewPlayer extends JView
{	
	function display($tpl = 'json')
	{



        $id		= substr(JRequest::getvar('id'), 5);
	/*	$people		= JTable::getInstance('players', 'Table');
		$people->load($id);
		$inv		= $this->get_character_inventory($id);
		$db		= JFactory::getDBO();
		$query		= "SELECT #__comprofiler.avatar FROM #__comprofiler WHERE #__comprofiler.id =" . $id;
		$db->setQuery($query);
		$people->avatar	= $db->loadresult();

*/

		//$id = (int) JRequest::getVar('iduser', 0);
	
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
