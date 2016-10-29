<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelsoftware extends JModelLegacy
{
    function get_software()
    {
        $db		= JFactory::getDBO();
        $user = JFactory::getUser();
        $parent = JRequest::getvar('parent');
        $query	= "SELECT * FROM #__jigs_software
          WHERE #__jigs_software.iduser = $user->id";
        $db->setQuery($query);
        $data	=  $db->loadAssocList();
        return $data;
    }
}


