<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewweapons extends JViewLegacy
{	
	function display($tpl = null)
	{
		$rows =& $this->get('data');
		//print_r($rows);
		$this->assignRef('rows', $rows);
		parent::display($tpl);
	}
}
