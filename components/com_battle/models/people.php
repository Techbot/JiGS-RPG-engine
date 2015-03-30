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
        $db->setQuery("SELECT #__jigs_inventory.item_id, " .
                "#__jigs_objects.name " .
                "FROM #__jigs_inventory " .
                "LEFT JOIN #__jigs_objects " .
                "ON #__jigs_inventory.item_id = #__jigs_objects.id " .
                "WHERE #__jigs_inventory.player_id =".$character_id);
        $result = $db->loadAssocList();
        return $result;
    }











}
