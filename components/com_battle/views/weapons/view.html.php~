<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewweapons extends JView
{	
	function display($tpl = null)
	{
	//	$id = (int) JRequest::getVar('id', 0);
		
		$user =& JFactory::getUser();
		$id= $user->id;			
		
		$players =& JTable::getInstance('players', 'Table');
		$players->load($id);
			
	
	//		echo '<pre>';
	//		echo	$gun_number;
	//	print_r($mygun);
	//	echo '</pre>';
		
		$model = &$this->getModel();
		$this->assignRef('inv',$model->get_weapons($id));

				
		$backlink = JRoute::_('index.php?option=com_battle');
		
		$user =& JFactory::getUser();
		
		$this->assignRef('players', $players);		
		$this->assignRef('backlink', $backlink);
		
		
		
		
		parent::display($tpl);
	}
}
