<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class BattleViewcharacter extends JViewLegacy
{
    function display($tpl = 'json')
    {
        $id = (int) JRequest::getVar('id', 0);
        //$people = JTable::getTable('people');
        $people = JTable::getInstance('people', 'Table');
                $people->load($id);      
               // print_r($people);
        $model = &$this->getModel();
        $this->assignRef('inv',$model->get_character_inventory($id));
        //$id= JRequest::getvar('id');
        //$people = JTable::getInstance('people', 'Table');
        //$people->load($id);
        //$inv = $this->get_character_inventory($id);
    //	echo '<pre>';
    //	print_r($model);
    //	echo '</pre>';
        $backlink = JRoute::_('index.php?option=com_battle');
        $user =& JFactory::getUser();
        $this->assignRef('people', $people);
        $this->assignRef('backlink', $backlink);
        parent::display($tpl);
    }
}
