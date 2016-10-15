<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelPeople extends JModel
{
    var $_data = null;

    function &getData()
    {
        if (empty($this->_data)) {
            $query = "SELECT * FROM #__jigs_characters";
            $this->_data = $this->_getList($query);
        }

        return $this->_data;
    }

    function get_charactor_inventory() {

        $db =& JFactory::getDBO();
        $user =& JFactory::getUser();
        $character_id= JRequest::getvar(character_id);
        $db->setQuery("SELECT #__jigs_objects.item_id, " .
                "#__jigs_object_types.name " .
                "FROM #__jigs_objects " .
                "LEFT JOIN #__jigs_object_types " .
                "ON #__jigs_objects.item_id = #__jigs_object_types.id " .
                "WHERE #__jigs_objects.player_id =".$character_id);
        $result = $db->loadAssocList();
        return $result;
    }











}
