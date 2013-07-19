<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelSingle extends JModel{
	function savecoord() 
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$update = JRequest::getVar('update');
		if ($update==1){
		$posx = JRequest::getVar('posx');
		$posy = JRequest::getVar('posy');
		$map_id = JRequest::getVar('id');
		$grid =	JRequest::getVar('grid');	
		$query = "UPDATE #__jigs_players SET map = '".$map_id."', grid = '".$grid."', posx = '".$posx."',posy = '".$posy."' WHERE iduser ='".$user->id."'" ;
		$db->setQuery($query);
		$result = $db->query();	
 		return;
	
}
	}
function getcoord() 
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT #__jigs_players.posx, " .
				"#__jigs_players.posy, " .
				"#__jigs_players.map, " .
				"#__jigs_players.grid, " .
				"#__comprofiler.avatar, " .
				"#__jigs_players.active " .				
				"FROM #__jigs_players " .
				"LEFT JOIN #__comprofiler ON #__comprofiler.user_id = #__jigs_players.iduser " .
								"WHERE iduser =".$user->id);
		$result = $db->loadRow();
		return $result;
	}

function getgrid() 
	{

		$db =& JFactory::getDBO();
        $user =& JFactory::getUser();
		$db->setQuery("SELECT grid FROM #__jigs_players WHERE iduser =".$user->id);
		$gridnumber = $db->loadResult();
		// echo $gridnumber;
		$db->setQuery("SELECT grid_index FROM #__jigs_maps WHERE grid =".$gridnumber);
		$result = $db->loadResult();
		//	echo $result;
		return $result;


	}

function getchars() 
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM #__jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$map = $result[0];
        $grid = $result[1];		
		$db->setQuery("SELECT * FROM #__jigs_characters WHERE grid ='".$grid."' AND map='".$map."' AND active = 1 ");
		$result = $db->loadObjectlist();
		return $result;
	}
	
	
	function getbuildings() 
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM #__jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$map = $result[0];
        $grid = $result[1];		
		$db->setQuery("SELECT * FROM #__jigs_buildings WHERE grid ='".$grid."' AND map='".$map."'");
		$result = $db->loadObjectlist();
		
		foreach ($result as $building){
		$db->setQuery("SELECT username FROM #__jigs_players WHERE iduser= $building->owner");
		$building->ownername = $db->loadResult();
		}
		return $result;
	}
	
	
	
	
	function getpages() 
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM #__jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$map = $result[0];
        $grid = $result[1];		
		$db->setQuery("SELECT * FROM #__jigs_pages WHERE grid ='".$grid."' AND map='".$map."'");
		$result = $db->loadObjectlist();
		return $result;
	}	
	
	
function getplayers()
	{
		$db		= JFactory::getDBO();
		$user	= JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM #__jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$map	= $result[0];
        $grid	= $result[1];		
		$db->setQuery("SELECT #__jigs_players.iduser,

		#__jigs_players.username,
				#__jigs_players.posx, 
				#__jigs_players.posy, 
				#__comprofiler.avatar
				FROM #__jigs_players 
				LEFT JOIN #__comprofiler ON #__jigs_players.iduser = #__comprofiler.user_id
				WHERE #__jigs_players.active = 1 AND #__jigs_players.grid ='".$grid."' AND #__jigs_players.map='".$map."' AND #__jigs_players.iduser !='".$user->id."'
						
						");
		$result = $db->loadObjectlist();
		return $result;
	}
	

	
}
