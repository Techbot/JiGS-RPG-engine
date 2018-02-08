<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewfactions extends JViewLegacy
{	
	function display($tpl = null)
	{
	//	$id = (int) JRequest::getVar('id', 0);
		$user	= JFactory::getUser();
		$id		= $user->id;			
		//$players =& JTable::getInstance('metals', 'Table');
		//$players->load($id);
		$model = &$this->getModel();
		
		
		$groups=$model->get_group_stats();


		
		foreach ($groups as $group){
		
		$captain_object =  JFactory::getUser($group->captain);

					$group->captain_name = $captain_object->username;
		
		$group->avatar = $model->get_avatar($group->captain) ;
		
		
		
		}
		
		
		$this->assignRef('factions',$groups);
		
		
		
		
		
		
		
		
		//print_r ($model->get_group_stats());
		
		
		//exit();
		
		
		
		
	//	$backlink = JRoute::_('index.php?option=com_battle');
	//	$this->assignRef('players', $players);		
	//	$this->assignRef('backlink', $backlink);
		parent::display($tpl);
	}
}
