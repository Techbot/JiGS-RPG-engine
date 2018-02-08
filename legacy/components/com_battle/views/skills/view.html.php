<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewskills extends JViewLegacy
{	
	function display($tpl = null)
	{

		//$user			= JFactory::getUser();
		$id				= $user->id;			
		//$players		= JTable::getInstance('players', 'Table');
		//$players->load($id);
		//$model = $this->getModel();
		//$this->skills	= $model->get_all_skills();
		//$this->players	= $players;
	
		parent::display($tpl);
	}
}
