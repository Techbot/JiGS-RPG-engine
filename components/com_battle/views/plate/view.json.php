<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewPlate extends JView
{
    function display($tpl = "json")
    {
        $id         = (int) JRequest::getVar('id', 0);
        $plates     = JTable::getInstance('plates', 'Table');
        $plates->load($id);
        $this->assignRef('plate', $plates);
        parent::display($tpl);
    }
}
