<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class battleViewtest extends JViewLegacy
{	
	function display($tpl = null)
	{
		
		
		parent::display($tpl);
	}
}
