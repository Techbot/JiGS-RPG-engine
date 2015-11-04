<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewPage extends JViewLegacy
{	
	function display($tpl = null)
	{
		$id = (int) JRequest::getVar('id', 0);
	
		$model = $this->getModel();

		$this->page = $model->get_page($id);

		parent::display($tpl);
	}
}
