<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelPlayer extends JModelLegacy
{
	var $_data = null;
	
	function getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT * FROM #__jigs_players";
			$this->_data = $this->_getList($query);
		}

		return $this->_data;
	}

    function getPlayer($id)
    {
        $db = JFactory::getDBO();
        //$user = JFactory::getUser();
        $query = "SELECT * FROM #__jigs_players WHERE id = $id";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        return $result[0];
    }
	
	function get_weapons($id) {

		$db = JFactory::getDBO();
		$user = JFactory::getUser();
		$character_id= JRequest::getvar(id);
		$db->setQuery("SELECT #__jigs_weapons.item_id, #__jigs_weapon_names.name, #__jigs_weapon_names.sell_price, #__jigs_weapon_names.image " .
				"FROM #__jigs_weapons " .
				"LEFT JOIN #__jigs_weapon_names " .
				"ON #__jigs_weapons.item_id = #__jigs_weapon_names.id " .
				"WHERE #__jigs_weapons.player_id =".$id);
		$result = $db->loadAssocList();
			return $result;
}

	function get_avatar($id){
		$db =JFactory::getDBO();
		$db->setQuery("SELECT #__comprofiler.avatar FROM #__comprofiler WHERE #__comprofiler.id =".$id);
    	$result = $db->loadresult();

	return $result;
}

}
