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
		$query = "UPDATE jos_jigs_players SET map = '".$map_id."', grid = '".$grid."', posx = '".$posx."',posy = '".$posy."' WHERE iduser ='".$user->id."'" ;
		$db->setQuery($query);
		$result = $db->query();	
 		return;
	
}
	}
function getcoord() 
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT jos_jigs_players.posx, " .
				"jos_jigs_players.posy, " .
				"jos_jigs_players.map, " .
				"jos_jigs_players.grid, " .
				"jos_comprofiler.avatar, " .
				"jos_jigs_players.active " .				
				"FROM jos_jigs_players " .
				"LEFT JOIN jos_comprofiler ON jos_comprofiler.user_id = jos_jigs_players.iduser " .
								"WHERE iduser =".$user->id);
		$result = $db->loadRow();
		return $result;
	}

function getgrid() 
	{

		$db =& JFactory::getDBO();
        $user =& JFactory::getUser();
		$db->setQuery("SELECT grid FROM jos_jigs_players WHERE iduser =".$user->id);
		$gridnumber = $db->loadResult();
		// echo $gridnumber;
		$db->setQuery("SELECT grid_index FROM jos_jigs_maps WHERE grid =".$gridnumber);
		$result = $db->loadResult();
		//	echo $result;
		return $result;


	}

function getchars() 
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM jos_jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$map = $result[0];
        $grid = $result[1];		
		$db->setQuery("SELECT * FROM jos_jigs_characters WHERE grid ='".$grid."' AND map='".$map."' AND active = 1 ");
		$result = $db->loadObjectlist();
		return $result;
	}
	
	
	function getbuildings() 
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM jos_jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$map = $result[0];
        $grid = $result[1];		
		$db->setQuery("SELECT * FROM jos_jigs_buildings WHERE grid ='".$grid."' AND map='".$map."'");
		$result = $db->loadObjectlist();
		return $result;
	}
	
	function getpages() 
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM jos_jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$map = $result[0];
        $grid = $result[1];		
		$db->setQuery("SELECT * FROM jos_jigs_pages WHERE grid ='".$grid."' AND map='".$map."'");
		$result = $db->loadObjectlist();
		return $result;
	}	
	
	
function getplayers()
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM jos_jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$map = $result[0];
        $grid = $result[1];		
				$db->setQuery("SELECT jos_jigs_players.iduser, 
				jos_jigs_players.posx, 
				jos_jigs_players.posy, 
				jos_comprofiler.avatar
				FROM jos_jigs_players 
				LEFT JOIN jos_comprofiler ON jos_jigs_players.iduser = jos_comprofiler.user_id
				WHERE jos_jigs_players.active = 1 AND jos_jigs_players.grid ='".$grid."' AND jos_jigs_players.map='".$map."' AND jos_jigs_players.iduser !='".$user->id."'
						
						");
		$result = $db->loadObjectlist();
		return $result;
	}
	

	
}
