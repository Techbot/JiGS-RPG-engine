<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewweapons extends JView
{	
	function display($tpl = null)
	{
		$rows =& $this->get('data');
		//print_r($rows);
		$this->assignRef('rows', $rows);
		parent::display($tpl);
	}
}
