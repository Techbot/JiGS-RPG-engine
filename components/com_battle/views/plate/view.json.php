<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewPlate extends JViewLegacy
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
