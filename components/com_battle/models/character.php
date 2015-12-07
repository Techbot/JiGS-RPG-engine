<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelCharacter extends JModelLegacy
{
    var $_data = null;

    function getData()
    {
        if (empty($this->_data)) {
            $query = "SELECT * FROM #__jigs_characters";
            $this->_data = $this->_getList($query);
        }
        return $this->_data;
    }

    function get_character_inventory($id)
    {
        $dba = JFactory::getDBO();
        $dba->setQuery("SELECT #__jigs_inventory.item_id,  #__jigs_objects.name
        FROM #__jigs_inventory
        LEFT JOIN #__jigs_objects
        ON #__jigs_inventory.item_id = #__jigs_objects.id
        WHERE #__jigs_inventory.player_id =" . $id);
        $result = $dba->loadAssocList();
        return $result;
    }
}
