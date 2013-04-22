<?php

/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
 jimport('joomla.plugin.plugin');
/**
 * Vote plugin.
 *
 * @package		Joomla.Plugin
 * @subpackage	Content.vote
 */
class plgBattleHeartbeat extends JPlugin
{


	public function __construct(& $subject, $config)
	{
	//	parent::__construct($subject, $config);
	//	$this->loadLanguage();
		//$this->test();
	
	}

	/**
	* @since	1.6
	*/
	public function run()
	{
		
		$now			= time();
		$time_string	= gmdate("Y-m-d\TH:i:s\Z", $now);
		$message		= "Cron activated at " . $time_string;
		$this->sendMessage($now,$message);
		$this->heartbeat();
		return ;
		//	return "hello";
	}
	
	function heartbeat()
	{
		$result_1		= $this->check_factories();
		$result_2		= $this->check_reprocessors();
		$result_3		= $this->check_mines();
		$result_4		= $this->check_farms();
		$result_5		= $this->respawn();
		$result_6		= $this->check_apartments();
	//	$result			= $this->get_players();
		return ;
	}
	
	function increment_xp($xp_type ,$payment,$user_id){

		$db 	= JFactory::getDBO();
		$query	="UPDATE #__jigs_players SET $xp_type  = $xp_type  +1, xp = xp+1, money = money + " . $payment ." WHERE #__jigs_players.iduser = " .  $user_id;
		$db->setQuery($query);
		$db->query();

		$this->test_level($user_id);


		return $query;
	}
	
	
	
	
		function test_level($user_id){
		$user		= JFactory::getUser();
		$db			= JFactory::getDBO();
		$now		= time();
		$query		= "SELECT xp FROM #__jigs_players where iduser = $user_id";
		$db->setQuery($query);
		$xp			= $db->loadResult();
		$milestones = array(100,200,400,800,1600,2000,4000,8000);

		foreach ($milestones as $check)
		{

			if ($xp == $check)
			{
				$query		= "UPDATE #__jigs_players SET level=level+1, statpoints = statpoints + 5 WHERE iduser = $user_id";
				$db->setQuery($query);
				$db->query();
				$text		= 'Citizen ' . $user->username . ' leveled up';
				$this->sendWavyLines($text);
				$this->sendFeedback($user->id,$text);
				
			}
		}
	}
	

	
	
	function getName(){
	
	}
	
	
	function respawn()
	{
		$db					= JFactory::getDBO();
		$db->setQuery("SELECT id from #__jigs_characters WHERE empty = 1");
		$db->query();
		$result				= $db->loadResultArray();
		
		if ($result)
		{
			foreach ($result as $row)
			{
				$number_of_items = rand(1,3);
				for ($i=0 ;$i<$number_of_items;$i++){
					$item_id		= rand(1, 15);
					$db->setQuery("INSERT INTO #__jigs_inventory (item_id, player_id ) VALUES (" . $item_id . " ,  " .  $row  . ")");
					$db->query();
				}
				$db->setQuery("UPDATE #__jigs_characters SET empty = 0 WHERE id = " .  $row );
				$db->query();
			}
			$now		= time();
			$db->setQuery("UPDATE #__jigs_characters 
			SET active= 1, time_killed=0,  health= 100  
			WHERE  #__jigs_characters.time_killed < (" . $now . "- (1 * 60)) 
			AND #__jigs_characters.time_killed !=0");
			$db->query();
		}
	}



	function check_apartments()
	{
		
		//$user 		= JFactory::getUser();
		$now		= time();
		$db 		= JFactory::getDBO();
		// Find all factories where finished(unix time) has passed 
		$expire		= $now - (1*60*60*60);
		$query		= "SELECT * FROM #__jigs_flats WHERE timestamp < $expire AND timestamp !=0";
		$db->setQuery($query);
		$result		= $db->loadObjectlist();
		$rent		= 100;

		// loop 
		if ($result)
		{
		
			foreach ($result as $row)
			{
			
				$query = "Select bank FROM #__jigs_players WHERE iduser = $row->resident";
			
				$db->setQuery($query);
				$bank = $db->loadResult();
				$user				= JFactory::getUser($row->resident);
				$playa_name			= $user->username;
				
				if ($bank < $rent)// bank is less than rent so evict the player
				{
			
						$query		= "UPDATE #__jigs_flats SET timestamp = 0, resident = 0  WHERE building = $row->building AND flat = $row->flat";
						$db->setQuery($query);
						$db->query();
						
						
						// send wavy lines & feedback
						$txt = "You were evicted";
						
						$this->sendFeedback($user->id ,$txt);
						
						$text				= "Citizen  $playa_name  was evicted";
						$this->sendWavyLines($text);
						
						// end wavy lines
				}
				else{
		
						$query		= "UPDATE #__jigs_players SET bank = bank - $rent WHERE iduser = $row->resident";
						$db->setQuery($query);
						$db->query();
						$query		= "UPDATE #__jigs_flats SET timestamp = $now WHERE building = $row->building AND flat = $row->flat";
						$db->setQuery($query);
						$db->query();
		
						// send wavy lines & feedback
						$txt = "Your lease was renewed were evicted";
						
						$this->sendFeedback($user->id ,$txt);
						
						
						
						$text				= "Citizen  $playa_name  renewed a lease";
						$this->sendWavyLines($text);
						$this->sendFeedback($user->id, $text);
						// end wavy lines
				}
			}
		}
		return;
	}

		function check_reprocessors(){

		$user 		= JFactory::getUser();
		$now		= time();
		$db 		= JFactory::getDBO();
		// Find all factories where finished(unix time) has passed 
		$query		="SELECT 	#__jigs_reprocessors.finished,
					#__jigs_reprocessors.quantity_1,
					#__jigs_reprocessors.quantity_2,
					#__jigs_reprocessors.metal1,
					#__jigs_reprocessors.metal2,
					#__jigs_reprocessors.type_name,
					#__jigs_reprocessors.type_quantity,
					#__jigs_buildings.owner 
	               FROM #__jigs_reprocessors
	               LEFT JOIN #__jigs_buildings
	               ON #__jigs_reprocessors.building = #__jigs_buildings.id
	               
		WHERE #__jigs_reprocessors.finished !=0 AND  #__jigs_reprocessors.finished < ". $now;
		$db->setQuery($query);
		$result		= $db->loadObjectlist();

		// loop through reproccors array giving out rewards of metals1 +2

		if ($result){
		
		foreach ($result as $row){
			
				$query				= "SELECT #__jigs_metals.quantity FROM #__jigs_metals 
				WHERE player_id = $row->owner AND item_id = $row->metal1";
				$db->setQuery($query);
				$metal1_quantity = $db->loadResult();
				
				if(!$metal1_quantity){
					$playa				= JFactory::getUser($row->owner);
					$this->sendFeedback($playa->id ,$query);
				} 
					
				
				$query				= "SELECT #__jigs_metals.quantity FROM #__jigs_metals 
				WHERE player_id = $row->owner AND item_id = $row->metal2";
				$db->setQuery($query);
				$metal2_quantity	= $db->loadResult();
				
				if(!$metal2_quantity)
				{
					$playa				= JFactory::getUser($row->owner);
					$this->sendFeedback($playa->id ,$query);
				} 
				
				
				$total_metal_1		= $metal1_quantity + $row->quantity_1;
				$total_metal_2		= $metal2_quantity + $row->quantity_2;				
				
				$query				= "INSERT INTO #__jigs_metals (player_id , item_id, quantity) 
				VALUES ($row->owner, $row->metal1, $total_metal_1) 
				ON DUPLICATE KEY UPDATE quantity = $total_metal_1 ";
				$db->setQuery($query);
				
				if(!$db->query())
				{
					$playa				= JFactory::getUser($row->owner);
					$this->sendFeedback($playa->id ,$query);
				}
				
							
				
				$query				= "INSERT INTO #__jigs_metals (player_id , item_id,quantity) 
				VALUES ($row->owner, $row->metal2, $total_metal_2) 
				ON DUPLICATE KEY UPDATE  quantity= $total_metal_2 ";
				$db->setQuery($query);
				
				if(!$db->query())
				{
					$playa				= JFactory::getUser($row->owner);
					$this->sendFeedback($playa->id ,$query);
				}

				$xp_type			= 'nbr_objs';
				$increment			= $this->increment_xp($xp_type ,0,$row->owner);

				// send wavy lines
	
				$playa				= JFactory::getUser($row->owner);
				$playa_name			= $playa->username;
				$playa_id			= $playa->id;
				$text				= "Citizen  $playa_name  has reprocessed  $row->type_quantity " .  $row->type_name ."(s)";
				$this->sendWavyLines($text);
				$this->sendFeedback($playa_id ,$text);
				
				// end wavy lines
			
			
		}
		// Now Simply reset all factories where remainging time is less that zero
		$query						="UPDATE #__jigs_reprocessors SET timestamp = 0,finished = 0 WHERE finished !=0 AND finished < " . $now;
		$db->setQuery($query);
		$db->query();
		}// end if

		return $query;
	}
	
		function check_mines()
	{
		
		$user			= JFactory::getUser();
		$now			= time();
		$db				= JFactory::getDBO();
		$duration		= $now - 50;
		$query			= "SELECT #__jigs_mines.building, 
						#__jigs_mines.type,
						#__jigs_mines.timestamp, 
	                    #__jigs_buildings.owner 
					FROM #__jigs_mines 
					LEFT JOIN #__jigs_buildings 
					ON #__jigs_mines.building = #__jigs_buildings.id 
					WHERE timestamp!=0 && timestamp < " . $duration;

		$db->setQuery($query);
		$result			= $db->loadObjectlist();
		$payment		= 100;
		foreach ($result as $row)
		{

			$playa = & JFactory::getUser($row->owner);
			$playa_name = $playa->username;
			$playa_id = $playa->id;
			
			
			if ($row->type==1)
			{
				$type_crystal		= rand( 1 , 30 );
				$query				= "INSERT INTO #__jigs_crystals (player_id , item_id, quantity )
						VALUES($row->owner ,$type_crystal, 1) 
						ON DUPLICATE KEY UPDATE quantity = quantity + 1";
				$db->setQuery($query);
				$db->query();
				$text				= 'Citizen ' . $playa_name  . ' has mined 1 unit of crystal:' . $type_crystal ;
				$text2				= 'You mined 1 unit of crystal:<br/>' ;
			}
			if ($row->type==2)
			{
				$type_metal			= rand( 1 , 32 ) ;
				if ($type_metal>16)
				{
					$type_metal		= 1;
				}
							
				$query	= "INSERT INTO #__jigs_metals (player_id , item_id, quantity )
						VALUES( $row->owner ,$type_metal, 1) 
						ON DUPLICATE KEY 
						UPDATE quantity = quantity + 1";
				$db->setQuery($query);
				$db->query();
				$text		= 'Citizen ' . $playa_name  . ' has mined 1 unit of metal:' . $type_metal ;
				$text2		= 'You mined 1 unit of metal:<br/>' ;	
			}
			else
			{
					
				$query_1		="SELECT money FROM #__jigs_players WHERE iduser = '$row->owner'";
				$db->setQuery($query_1);
				$money_saved	= $db->loadResult();
				$money= $money_saved + $payment;
				$x				=	"Update #__jigs_players SET money = $money WHERE iduser = " . $row->owner;
				$db->setQuery($x);
				$db->query();
				$text			= 'Citizen ' . $playa_name  . ' has mined 1 unit of oil:' ;
				$text2			= 'You mined 1 unit of oil:<br/>' ;

				$xp_type		= 'nbr_drills';
				$test			= $this->increment_xp($xp_type ,0,$row->owner);
			}
		
		$this->sendFeedback($playa_id, $text2);
		$this->sendWavyLines($text);	
		$query		= "UPDATE #__jigs_mines SET timestamp = 0 WHERE timestamp < ". $duration;
		$db->setQuery($query);
		$db->query();
		}
		return ;
	}
		function check_farms(){

		$user		= JFactory::getUser();
		$now		= time();
		$db			= JFactory::getDBO();
		// Find all fields where finished(unix time) has passed 
		$query="SELECT 
					#__jigs_farms.finished,
					#__jigs_farms.status,
					#__jigs_farms.total,
					#__jigs_farms.building,
					#__jigs_buildings.owner 
					FROM #__jigs_farms
	               LEFT JOIN #__jigs_buildings
	               ON #__jigs_farms.building = #__jigs_buildings.id
	              	WHERE #__jigs_farms.finished !=0 AND  #__jigs_farms.finished < ". $now;
		$db->setQuery($query);
		$result		= $db->loadObjectlist();

		// loop through field array giving out rewards of type
		// 0 : Barren/Harvested
		// 1 : Tilling
		// 2 : Tilled
		// 3 : Sowing
		// 4 : Sowed
		// 5 : Harvestiing
		// 6 : Harvested/ Barren
		
		if ($result){
			foreach ($result as $row){
				$row->status++;
				$row->finished	= 0;
				
				// If Field is harvested 
				if ($row->status >= 6) {
					$row->total++;
					$row->status	= 0;
					// send wavy lines
					
					$playa			= JFactory::getUser($row->owner);
					$playa_name		= $playa->username;
					$playa_id		= $playa->id;
					$text			= 'Citizen ' . $playa_name  . ' has harvested 1 field ' ;
					$this->sendWavyLines($text);
					$this->sendFeedback ($playa_id,$text);
					// end wavy lines
				}
				//////////////////////////////////////////////////////////////////////////////////////////
				
				
				$query		= "UPDATE #__jigs_farms SET status	= $row->status,	timestamp = $now, total = $row->total,
				finished	= $row->finished WHERE building	= $row->building AND field = 1";
				$db->setQuery($query);
				$db->query();
				$xp_type	= 'nbr_crops';
				$increment	= $this->increment_xp($xp_type ,0,$row->owner);
			}
			
		}// end if

		return true;
	}
	


		function check_factories(){

		$user 		= JFactory::getUser();
		$now		= time();
		$db 		= JFactory::getDBO();
		// Find all factories where finished(unix time) has passed 
		$query="SELECT 
					#__jigs_factories.finished,
					#__jigs_factories.quantity,
					#__jigs_factories.type,
					#__jigs_buildings.owner, 
					#__jigs_objects.name
	               FROM #__jigs_factories
	               LEFT JOIN #__jigs_buildings
	               ON #__jigs_factories.building = #__jigs_buildings.id
	               LEFT JOIN #__jigs_objects
	               ON #__jigs_factories.type = #__jigs_objects.id
		WHERE #__jigs_factories.finished !=0 AND  #__jigs_factories.finished < ". $now;
		$db->setQuery($query);
		$result = $db->loadObjectlist();

		// loop through factory array giving out rewards of type

		if ($result){
		
		foreach ($result as $row){
			$quantity 			= $row->quantity;
			for ($i=1;$i <= $quantity ;$i++){
			
				$query1				= "INSERT INTO #__jigs_inventory (player_id , item_id) VALUES ($row->owner ,$row->type)";
				$db->setQuery($query1);
				$db->query();
				$xp_type			= 'nbr_objs';
				$increment			= $this->increment_xp($xp_type ,0,$row->owner);

				// send wavy lines
	
				$playa				= JFactory::getUser($row->owner);
				$playa_name			= $playa->username;
				$playa_id			= $playa->id;
				$text				= 'Citizen ' . $playa_name  . ' has created 1 ' . $row->name ;
				$this->sendWavyLines($text);
				$this->sendFeedback($playa_id ,$text);
				
				// end wavy lines
			
			}
		}
		// Now Simply reset all factories where remainging time is less that zero
		$query						="UPDATE #__jigs_factories SET timestamp = 0,finished = 0 WHERE finished !=0 AND finished < " . $now;
		$db->setQuery($query);
		$db->query();
		}// end if

		return $query;
	}
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	function sendWavyLines($text)
		{
			jimport( 'joomla.application.component.helper' );
			jimport( 'joomla.html.parameter' );

			$component		= JComponentHelper::getComponent( 'com_battle' );
			$params			= new JParameter( $component->params );
			$sbid			= $params->get( 'shoutbox_category' );

		//	$sbid			= 24;
			$db				= JFactory::getDBO();
			$now			= time();
			$sql			= "INSERT INTO #__shoutbox (name, time,sbid, text) VALUES ('Wavy Lines:', $now,$sbid, '$text' )";
			$db->setQuery($sql);
			$db->query();
			return $sql;
		}


	function sendFeedback($id,$text)
	{
			
			$db			= JFactory::getDBO();
			$query		= "INSERT INTO #__jigs_logs (user_id, message) VALUES ($id,'$text')";
			$db->setQuery($query) ;
			$db->query();
			return ;
	}

		function sendMessage($now,$message)
	{
			$sbid			= 23;
			$db				= JFactory::getDBO();
			$query			= "INSERT INTO #__shoutbox (sbid, name, time, text) values ( $sbid, 'wavy lines', $now, '$message')";
			$db->setQuery($query);
			$db->query();
			return ;
	}
	
	
}
