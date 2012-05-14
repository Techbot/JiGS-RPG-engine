<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class battleViewperson extends JView
{
	function display($tpl = null)
	{
		$row =& JTable::getInstance('people', 'Table');
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		$id = $cid[0];
		$row->load($id);
		$this->assignRef('row', $row);
		$editor =& JFactory::getEditor();
		$this->assignRef('editor', $editor);
		parent::display($tpl);
	}
}
