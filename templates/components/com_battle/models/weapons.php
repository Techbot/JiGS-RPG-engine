<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelweapons extends JModel
{
	var $_data = null;
	
	function &getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT weapons_id FROM #__jigs_players";
			$this->_data = $this->_getList($query);
		}
		
		return $this->_data;
	}
		function get_weapons($id)
	{
        $user =& JFactory::getUser();
		
		
		if (empty($this->_data)) {
			$query = "SELECT * FROM #__jigs_weapons LEFT JOIN #__jigs_weapon_names ON #__jigs_weapons.item_id = #__jigs_weapon_names.id where player_id = ". $user->id;
			$this->_data = $this->_getList($query);
		}
		
		return $this->_data;
	}
	
	

}
