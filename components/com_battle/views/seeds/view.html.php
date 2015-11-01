<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewseeds extends JViewLegacy
{
    function display($tpl = null)
    {
       // $this->room		= JRequest::getVar('room');
       // $this->building = JRequest::getVar('building');
      //  $model			= $this->getModel();
     //   $model->enter_room();


        parent::display($tpl);
    }
}
