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
        $dba->setQuery("SELECT #__jigs_objects.item_id,  #__jigs_object_types.name
        FROM #__jigs_objects
        LEFT JOIN #__jigs_object_types
        ON #__jigs_objects.item_id = #__jigs_object_types.id
        WHERE #__jigs_objects.player_id =" . $id);
        $result = $dba->loadAssocList();
        return $result;
    }
}
