<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelPlayer extends JModel
{
	var $_data = null;
	
	function &getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT * FROM #__jigs_players";
			$this->_data = $this->_getList($query);
		}
		
		return $this->_data;
	}
	
	
	function get_weapons($id) {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$character_id= JRequest::getvar(id);
		$db->setQuery("SELECT jos_jigs_weapons.item_id, jos_jigs_weapon_names.name, jos_jigs_weapon_names.sell_price, jos_jigs_weapon_names.image " .
				"FROM jos_jigs_weapons " .
				"LEFT JOIN jos_jigs_weapon_names " .
				"ON jos_jigs_weapons.item_id = jos_jigs_weapon_names.id " .
				"WHERE jos_jigs_weapons.player_id =".$id);
		$result = $db->loadAssocList();
			return $result;
}



function get_avatar($iduser){
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT jos_comprofiler.avatar FROM jos_comprofiler WHERE jos_comprofiler.id =".$iduser);
    	$result = $db->loadresult();
	
return $result;
	
}






}
