<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewmetals extends JViewLegacy
{	
	function display($tpl = null)
	{
	//	$id = (int) JRequest::getVar('id', 0);
		$user =& JFactory::getUser();
		$id= $user->id;			
		//$players =& JTable::getInstance('metals', 'Table');
		//$players->load($id);

		
		
		$model = &$this->getModel();
		$this->assignRef('metals',$model->get_metals());
	//	$backlink = JRoute::_('index.php?option=com_battle');
	//	$this->assignRef('players', $players);		
	//	$this->assignRef('backlink', $backlink);
				parent::display($tpl);
	}
}
