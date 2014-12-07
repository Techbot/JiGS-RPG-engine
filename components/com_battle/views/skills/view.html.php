<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewskills extends JView
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
