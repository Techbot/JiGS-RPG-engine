<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelfactions extends JModel
{
	function get_groups()
	{
        $factions = array( 'cyberians' =>'35', 'gaians' => 36 , 'fantasians' => 42);
		$db = JFactory::getDBO();
		foreach ($factions as $faction_name=>$faction_id) 
		{
		
		    $faction_list->$faction_name->name      = $faction_name;
			$faction_list->$faction_name->groups    = $this->get_group_ids($faction_id);
		    $faction_list->$faction_name->groupnames= $this->get_group_names($faction_list->$faction_name->groups);
		    $faction_list->$faction_name->groupstats= $this->get_group_stats($faction_list->$faction_name->groups);		
		}
		
		//$faction_list	= $this->get_group_members($faction_list);
		return $faction_list;
	}
	
	function get_group_ids($faction_id)
	{
            $db         = JFactory::getDBO();
            $query		= "SELECT id FROM #__usergroups WHERE parent_id = " . $faction_id;
			$db->setQuery($query);
			return $db->loadcolumn();
    }
	
	
	
	function get_group_names($groups)
	{
	    $db         = JFactory::getDBO();
		$groupnames = array();
	    foreach ($groups as $group_id) 
	    {
            $query				        = "SELECT title FROM #__usergroups WHERE id = " . $group_id;
	        $db->setQuery($query);
		    $groupnames[]		        =  $db->loadResult(); 
		}
	
	return $groupnames;
	}
	
	function get_group_stats($groups)
	{
	    $db         = JFactory::getDBO();
		$groupstats = array();
	    foreach ($groups as $group_id) 
	    {
            $query				        = "SELECT * FROM #__jigs_groups WHERE id = " . $group_id;
	        $db->setQuery($query);
		    $groupstats[]		        =  $db->loadObject(); 
		}
	
	return $groupstats;
	}	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	function get_group_members()
	{
	            $db                         = JFactory::getDBO();
	            $gid                        = JRequest::getVar('gid');
                $query				        = "SELECT user_id FROM #__user_usergroup_map WHERE group_id = $gid" ;
		        $db->setQuery($query);
                $ids = $db->loadcolumn();
                return $this->get_player_names($ids);
	}
	
	function get_player_names($group_ids)
	{
        $db = JFactory::getDBO();
	   $names = array();
	   
	    foreach ($group_ids as $id)
            {
                $query = "SELECT iduser,username,xp,health,bank,money,level FROM #__jigs_players WHERE iduser = " . $id . " ORDER BY xp DESC";
                $db->setQuery($query);
                $x = $db->loadAssoc();
                $query		= "SELECT #__comprofiler.avatar FROM #__comprofiler WHERE #__comprofiler.id =" . $id;
		        $db->setQuery($query);
		        $x['avatar']	= $db->loadresult();
                $players[] =  $x;
            }
	    return $players;
	}
}
