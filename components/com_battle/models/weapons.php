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
	
	function get_weapons()
	{
        $user       = JFactory::getUser();
        $db		    = JFactory::getDBO();
		$query      = "SELECT id FROM #__jigs_weapons WHERE player_id = ". $user->id;
		$db->setQuery($query);
	    $result		= $db->loadResultArray();			
		
		foreach ($result as $weapon)
		{
			$query = "SELECT 
			    #__jigs_weapons.magazine, 
			 	#__jigs_weapons.id,
			 	#__jigs_weapon_names.image,
			 	#__jigs_weapon_names.name, 
			 	#__jigs_weapon_names.max_ammunition, 
		     	#__jigs_weapon_names.attack				
			    FROM #__jigs_weapons
			    LEFT JOIN #__jigs_weapon_names
			    ON #__jigs_weapons.item_id = #__jigs_weapon_names.id
		        WHERE #__jigs_weapons.id  = $weapon";
        
		        
			$db->setQuery($query);
	        $weapon_list[]		= $db->loadObject();
		}
	
	//return $query;
		return $weapon_list;
	}
}
