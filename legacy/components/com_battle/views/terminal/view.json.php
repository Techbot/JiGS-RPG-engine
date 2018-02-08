<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewTerminal extends JViewLegacy
{
    function display($tpl = "json")
    {
        $id         = (int) JRequest::getVar('id', 0);
        $model      = $this->getModel();
        $info       = $model->getStuff($id);

        $this->assignRef('info',$info);
        parent::display($tpl);
    }
}
