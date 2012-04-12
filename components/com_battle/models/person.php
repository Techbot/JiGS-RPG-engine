<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelPerson extends JModel
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
	
	
	function get_character_inventory($id) {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$character_id= JRequest::getvar(character_id);
		$db->setQuery("SELECT jos_jigs_inventory.item_id, " .
				"jos_jigs_objects.name " .
				"FROM jos_jigs_inventory " .
				"LEFT JOIN jos_jigs_objects " .
				"ON jos_jigs_inventory.item_id = jos_jigs_objects.id " .
				"WHERE jos_jigs_inventory.player_id =".$id);
		$result = $db->loadAssocList();
			return $result;
}
	
	
	
	
	
	
	
	
	
	
	
}
