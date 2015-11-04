<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewPlayer extends JViewLegacy
{	
	function display($tpl = 'json')
	{
        $id		= JRequest::getvar('id');

        //echo $id;
       // exit();


	/*	$people		= JTable::getInstance('players', 'Table');
		$people->load($id);
		$inv		= $this->get_character_inventory($id);
		$db		= JFactory::getDBO();
		$query		= "SELECT #__comprofiler.avatar FROM #__comprofiler WHERE #__comprofiler.id =" . $id;
		$db->setQuery($query);
		$people->avatar	= $db->loadresult();
*/
		//$id = (int) JRequest::getVar('id', 0);

        $model = $this->getModel();
        $player = $model->getPlayer($id);
        $player->avatar = $model->get_avatar($id);
        //echo '<pre>';
		//print_r($player);
		//echo '</pre>';
		$this->player = $player;
		parent::display($tpl);
	}
}
