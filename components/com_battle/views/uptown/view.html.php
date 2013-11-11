<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class DojogamesViewComputer extends JView
{	
	function display($tpl = null)
	{
		
		
		
		
		parent::display($tpl);
	}
}
