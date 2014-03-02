<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewweapons extends JView
{	
	function display($tpl = null)
	{

		
		//$user			= JFactory::getUser();
		//$id				= $user->id;			
		
		$players		= JTable::getInstance('players', 'Table');
		//$players->load($id);
		$model			= $this->getModel();
		
		$this->assignRef('inv',$model->get_weapons());

				
		//$backlink		= JRoute::_('index.php?option=com_battle');
		
		//$user			= JFactory::getUser();
		
		//$this->assignRef('players', $players);		
		//$this->assignRef('backlink', $backlink);
		
		
		
		
		parent::display($tpl);
	}
}
