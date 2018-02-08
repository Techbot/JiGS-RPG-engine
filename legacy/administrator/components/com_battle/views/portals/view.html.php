<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewPortals extends JViewLegacy
{	
	function display($tpl = null)
	{
		$rows =& $this->get('data');
		$pagination =& $this->get('pagination');
		$search =& $this->get('search');
		$this->assignRef('rows', $rows);
		$this->assignRef('pagination', $pagination);
		$this->assign('search', $search);
		parent::display($tpl);
	}
}
