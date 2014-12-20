<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewseeds extends JView
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
