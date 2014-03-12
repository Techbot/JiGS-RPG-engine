<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modellist');

class BattleModelJigs extends JModellist{

	function heartbeat(){
		//	$result_1		= $this->check_factories();
		//	$result_2		= $this->check_reprocessors();
		//	$result_3		= $this->check_mines();
		//	$result_4		= $this->check_farms();
		//	$result_5		= $this->respawn();

		$result			= $this->get_players();
		return $result;
	}


	// This is a test method to be called by a chrontab via the kodaly app

	function populate_players2(){
		//		$user_id= $user['id'];
		//		$user_username= $user['username'];

		$db		= JFactory::getDBO();
		$query		= "INSERT INTO jos_jigs_players2 ( iduser) VALUES (1)";
		$db->setQuery($query);
		$result		= $db->query();
		return;
	}


	function eat()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$query		= $db->getQuery(true);

		$query->select('health, money');
		$query->from('#__jigs_players');
		$query->where('iduser = ' . $user->id);
		$db->setQuery($query);

		$result		= $db->loadAssoc();
		$health		= $result['health'];
		$money		= $result['money'];

		//	return json_encode($query);

		if ($money > 10)
		{
			$money	= $money - 10;
			$health	= $health + 10;
			$sql	= "Update #__jigs_players SET money = $money, health = $health WHERE iduser= " . $user->id;
			$db->setQuery($sql);
			$db->query();
			$return	= "success";
		}
		else
		{
			$return	= "broke";
		}

		return $return;
	}



	function update_flags($flags){

		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$flags		= implode( ',', $flags);
		$sql		="UPDATE #__jigs_players SET flags =('$flags') WHERE iduser =". $user->id;
		$db->setQuery($sql);
		$db->query();
		return $result;

	}
	
	function get_cells(){

		$map		= JRequest::getvar('map');
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT row0,row1,row2,row3,row4,row5,row6,row7 FROM #__jigs_maps WHERE id = ".$map);
		$result		= $db->loadAssocList();
		return $result;

	}

	function get_portals(){

		$map		= JRequest::getvar('map');
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT * FROM #__jigs_portals WHERE from_map =" . $map);
		$result		= $db->loadAssocList();
		return $result;
	}

	function add_message($message_id){

		$db		= JFactory::getDBO();
		$message_id	= int($message_id);
		$user		= JFactory::getUser();
		$db->setQuery("SELECT  messages FROM #__jigs_players WHERE iduser =".$user->id);
		$result		= $db->loadAssocList();

		array_unshift ( $result , $message_id);
		$db->setQuery( "UPDATE  #__jigs_players SET messages = $message WHERE iduser =".$user->id);
		$result		= $db->query();
		return $result;

	}

	function get_messages_old(){
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT messages FROM #__jigs_players WHERE iduser =".$user->id);
		$result		= $db->loadResult();
		$result		= explode(',',$result);

		foreach ($result as $message_id){
			$db->setQuery("SELECT string FROM #__jigs_messages WHERE id =" . $message_id);
			$message_list[]	= $db->loadResult();
		}

		return $message_list;
	}




	function get_messages(){
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT message FROM #__jigs_logs WHERE user_id =".$user->id ." ORDER BY timestamp DESC LIMIT 6");
		$message_list	= $db->loadObjectList();

		return $message_list;
	}


	function get_stats() {
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		//	$test = self::set_final_stats();
		$sql		= "SELECT level, health, strength, intelligence,speed, posx, posy, xp,energy, money, bank, defence, final_defence,
			attack, final_attack, nbr_attacks, nbr_kills, flags FROM #__jigs_players WHERE iduser = " . $user->id;
		$db->setQuery($sql);
		$result		= $db->loadAssocList();

		return $result;
	}


	function get_player() {
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$test		= self::set_final_stats();
		$db->setQuery("
			SELECT posx, posy, xp, grid, map
			FROM #__jigs_players WHERE iduser =".$user->id);
		$result		= $db->loadAssocList();
		return $result;
	}

	function set_final_stats() {

		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("Select attack, defence FROM  #__jigs_players WHERE iduser =".$user->id);
		$db->query();
		$result		= $db->loadRow();
		$attack		= $result[0];
		$defence	= $result[1];
		$db->setQuery("
			Select #__jigs_weapon_names.attack, #__jigs_weapon_names.defence FROM #__jigs_players
			LEFT JOIN #__jigs_weapon_names
			ON #__jigs_players.id_weapon = #__jigs_weapon_names.id
			WHERE iduser =".$user->id);
		$db->query();
		$result			= $db->loadRow();
		$weapon_attack	= $result[0];
		$weapon_defence	= $result[1];
		$final_attack	= $attack + $weapon_attack;
		$final_defence	= $defence + $weapon_defence;
		$db->setQuery("UPDATE #__jigs_players SET final_attack = '" . $final_attack. "', final_defence = '" . $final_defence . "'WHERE iduser =".$user->id);
		$db->query();
		return ($result);
	}

	function leave_room(){
		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$query		= "Update #__jigs_players SET active=1 WHERE iduser = $user->id";
		$db->setQuery($query);
		$db->query();
		return true;
	}





	function get_shop_blueprints() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_blueprints.object, " .
			"#__jigs_blueprints.sell_price, " . 
			"#__jigs_objects.name " .
			"FROM #__jigs_blueprints LEFT JOIN  #__jigs_objects ON #__jigs_blueprints.object = #__jigs_objects.id " .
			"WHERE #__jigs_blueprints.user_id =" . $building_id);
		$result			= $db->loadAssocList();
		return $result;

	}


	function get_shop_clothing() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_clothing.item_id, " .
			"#__jigs_clothing.sell_price, " . 
			"#__jigs_clothing_names.name " .
			"FROM #__jigs_clothing LEFT JOIN  #__jigs_clothing_names ON #__jigs_clothing.item_id = #__jigs_clothing_names.id " .
			"WHERE #__jigs_clothing.player_id =" . $building_id);
		$result			= $db->loadAssocList();
		return $result;

	}

	function get_shop_spells() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_spells.item_id, " .
			"#__jigs_spells.sell_price, " . 
			"#__jigs_spell_names.name " .
			"FROM #__jigs_spells LEFT JOIN  #__jigs_spell_names ON #__jigs_spells.item_id = #__jigs_spell_names.id " .
			"WHERE #__jigs_spells.player_id =" . $building_id);
		$result			= $db->loadAssocList();
		return $result;
	}

	function get_shop_weapons() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_weapons.item_id, " .
			"#__jigs_weapon_names.sell_price, " . 
			"#__jigs_weapon_names.name " .
			"FROM #__jigs_weapons LEFT JOIN  #__jigs_weapon_names ON #__jigs_weapons.item_id = #__jigs_weapon_names.id " .
			"WHERE #__jigs_weapons.player_id =" . $building_id);
		$result			= $db->loadAssocList();
		return $result;
	}


	function get_inventory_to_sell() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_inventory.item_id, " .
			"#__jigs_objects.name, " .
			"#__jigs_shop_prices.buy_price " .
			"FROM #__jigs_inventory " .

			"LEFT JOIN #__jigs_objects " .
			"ON #__jigs_inventory.item_id = #__jigs_objects.id " .

			"LEFT JOIN #__jigs_shop_prices " .
			"ON #__jigs_inventory.item_id = #__jigs_shop_prices.item_id " .

			"WHERE #__jigs_inventory.player_id = ". $user->id .
			" AND #__jigs_shop_prices.shop_id = " . $building_id ."
			");
		$result = $db->loadAssocList();
		return $result;
	}
	
	
	
	
	
	
	function get_metals_to_sell() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');

		$query			= "SELECT #__jigs_metals.item_id, 
			#__jigs_metal_names.name, 
			#__jigs_shop_metal_prices.buy_price 
			FROM #__jigs_metal_names 
			LEFT JOIN #__jigs_metals 
			ON #__jigs_metals.item_id = #__jigs_metal_names.id 
			LEFT JOIN #__jigs_shop_metal_prices 
			ON #__jigs_metals.item_id = #__jigs_shop_metal_prices.item_id 
			WHERE #__jigs_metals.player_id =  $user->id 
			AND #__jigs_shop_metal_prices.shop_id = " . $building_id ;

		$db->setQuery($query);
		$result 		= $db->loadAssocList();
		return $result;
	}

	function get_metals_for_sale() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	=  JRequest::getvar('building_id');

		$db->setQuery("SELECT #__jigs_inventory.item_id, " .
			"#__jigs_objects.name, " .
			"#__jigs_shop_prices.buy_price " .
			"FROM #__jigs_inventory " .

			"LEFT JOIN #__jigs_objects " .
			"ON #__jigs_inventory.item_id = #__jigs_objects.id " .

			"LEFT JOIN #__jigs_shop_prices " .
			"ON #__jigs_inventory.item_id = #__jigs_shop_prices.item_id " .

			"WHERE #__jigs_inventory.player_id = ". $user->id .
			" AND #__jigs_shop_prices.shop_id = " . $building_id ."
			");
		$result = $db->loadAssocList();
		return $result;
	}



	function get_crystals() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');

		$db->setQuery(
			"SELECT #__jigs_crystals.item_id, " .
			"#__jigs_crystal_names.name, " .
			"#__jigs_crystal_prices.buy_price " .
			"FROM #__jigs_crystals " .

			"LEFT JOIN #__jigs_crystal_names " .
			"ON #__jigs_crystals.item_id = #__jigs_crystal_names.id " .

			"LEFT JOIN #__jigs_crystal_prices " .
			"ON #__jigs_crystals.item_id = #__jigs_crystal_prices.item_id " .

			"WHERE #__jigs_crystals.player_id = " . $user->id .
			" AND #__jigs_crystal_prices.shop_id = " . $building_id);

		$result = $db->loadAssocList();
		return $result;
	}

	function get_backpack() {

		$db		        = JFactory::getDBO();
		$user		    = JFactory::getUser();


		$db->setQuery("SELECT  
			#__jigs_inventory.id, " .
			"#__jigs_inventory.item_id, " .
			"#__jigs_objects.name " .
			"FROM #__jigs_inventory " .
			"LEFT JOIN #__jigs_objects " .
			"ON #__jigs_inventory.item_id = #__jigs_objects.id " .
			"WHERE #__jigs_inventory.player_id = ". $user->id  
		);
		$result		= $db->loadObjectList();
		
		
		return $result;
	}

	function get_inventory2() {

		$db		        = JFactory::getDBO();
		$user		    = JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');

		$db->setQuery("SELECT DISTINCT 
			#__jigs_inventory.item_id, " .
			"#__jigs_objects.name " .
			"FROM #__jigs_inventory " .
			"LEFT JOIN #__jigs_objects " .
			"ON #__jigs_inventory.item_id = #__jigs_objects.id " .
			"WHERE #__jigs_inventory.player_id = ". $user->id  
		);
		$result		= $db->loadObjectList();
		foreach ($result as $row){
			$sql	="SELECT id FROM #__jigs_inventory WHERE #__jigs_inventory.player_id = $user->id  and #__jigs_inventory.item_id = $row->item_id";
			$db->setQuery($sql);
			$quantity	= $db->loadAssocList();
			$row->quantity	= count($quantity);
		}
		return $result;
	}

	function get_metals2() {

		$db		= JFactory::getDBO();
		$user	= JFactory::getUser();

		$db->setQuery("SELECT #__jigs_metals.item_id, " .
			"#__jigs_metals.quantity, " .
			"#__jigs_metal_names.name " .

			"FROM #__jigs_metals " .
			"LEFT JOIN  #__jigs_metal_names " .
			"ON #__jigs_metals.item_id = #__jigs_metal_names.id " .
			"WHERE #__jigs_metals.player_id =" . $user->id);

		$result		= $db->loadAssocList();
		return $result;
	}

	function get_crystals2() {

		$db		= JFactory::getDBO();
		$user	= JFactory::getUser();

		$db->setQuery("SELECT #__jigs_crystals.item_id, " .
			"#__jigs_crystal_names.name, #__jigs_crystals.quantity " .

			"FROM #__jigs_crystals " .
			"LEFT JOIN  #__jigs_crystal_names " .
			"ON #__jigs_crystals.item_id = #__jigs_crystal_names.id " .
			"WHERE #__jigs_crystals.player_id =" . $user->id);

		$result		= $db->loadAssocList();
		return $result;
	}


	function get_skills() {

		$db		= JFactory::getDBO();
		$user	= JFactory::getUser();

		$db->setQuery("SELECT * FROM #__jigs_skills WHERE #__jigs_skills.iduser =".$user->id);
		$result1 = $db->loadObject();

		for ($i= 1;$i< 9;$i++){
			$db->setQuery("SELECT name FROM #__jigs_skill_names WHERE #__jigs_skill_names.id = '". $result1->skill_ . $i ."'" );
			$result	= $db->loadresult();
			$all[$i]= $result;
		}
		return $all ;
	}


	function get_clothing() {

		$db		= JFactory::getDBO();
		$user	= JFactory::getUser();

		$db->setQuery("SELECT #__jigs_clothing.item_id, #__jigs_clothing_names.name " .
			"FROM #__jigs_clothing " .
			"LEFT JOIN #__jigs_clothing_names ON #__jigs_clothing.item_id =  #__jigs_clothing_names.id " .
			"WHERE #__jigs_clothing.player_id =".$user->id);

		$result		= $db->loadAssocList();
		return $result;
	}
	
	
	function reload()
	{
		$db		            = JFactory::getDBO();
		$user	            = JFactory::getUser();
		// Get all the info from the database
		// There are three tables. 
		// 1) The player table which includes the player stats ,what actual gun and how many spare bullets
		// 2) The weapons table which is a list of every instance of weapon in the game 
		//    and how many bullets are in that particular gun
		// 3) The weapon_name  table which lists various stats for a gun type including the max number of bullets in a clip
		//
		$query              = "SELECT id_weapon,ammunition FROM #__jigs_players WHERE iduser = " . $user->id;
	    $db->setQuery($query);
	    $_result		    = $db->loadAssoc();
	    $id_weapon          = $_result['id_weapon'];// current weapon
		$ammunition         = $_result['ammunition'];// total ammunition
		 /* 
        If ammuntion is empty let player know and exit ,else continue
        */
	    if ($ammunition ==0)
	    {
	        $message = "You have no ammunition";
	        $current_magazine = 0; // current magazine = no change
	    }
	    else
		{
		    $query              = "Select magazine, item_id from #__jigs_weapons WHERE id = $id_weapon";
		    $db->setQuery($query); 
		    $_result		    = $db->loadAssoc(); //load assoc is a joomla method that loads an associated array
	        $current_magazine   = $_result['magazine']; //current ammunition
	        $weapon_type        = $_result['item_id']; //current weapon_type
		    $query              = "Select max_ammunition from #__jigs_weapon_names WHERE id = $weapon_type";
		    $db->setQuery($query);
		    $max_ammunition     = $db->loadResult();// loadresult is a joomla method that loads a single value
	        $empty_slots        = $max_ammunition - $current_magazine ;
            /* 
            If current magazine is less than maximun that can be held in clip and the amount of ammunition the player has 
            is greater than the amount of empty slots in the clip then the clip is filled and the amount of ammunition 
            is reduced by the number of empty slots.
            */
	        if ($current_magazine < $max_ammunition && $ammunition > $empty_slots )
	        {
	            $current_magazine   = $max_ammunition;
	            $ammunition         = $ammunition - $empty_slots; //$empty_slots equals number of bullets added to clip
                $message= "Your clip is now full ";
	        }   
	        // the current magazine has more empty slots than player has bullets, 
	        // so whatever bullets player has is added to the clip 
	        // and the player now has no remaining bullets            
		    else 
	        {
	            $current_magazine = $current_magazine + $ammunition;
	            $ammunition        = 0;
	            $message= "You reload your weapon to $current_magazine bullets ";
	        }   
	        // now we need to save the info back to two tables
	        // 1) the players table with number of bullets remaining in backpack
	        // 2) number of bullets in this instance of weapon
	        // The third table with weapon_type stats does not get updated with anything
    
	        
	        $query              = "UPDATE #__jigs_players SET ammunition= $ammunition  
	                                WHERE iduser = $user->id";
	        $db->setQuery($query);
	        $db->query();
            $query              = "UPDATE #__jigs_weapons SET magazine = $current_magazine  
                                    WHERE id = $id_weapon AND player_id = $user->id";
	        $db->setQuery($query);
	        $db->query();
	     }
	$this->sendFeedback($user->id,$message);
	return $current_magazine;

    }

	function get_weapon() {

		$db		    =& JFactory::getDBO();
		$user		=& JFactory::getUser();
		//$char		= 62;

		$db->setQuery(
			"SELECT 
			#__jigs_weapon_names.* ,
			#__jigs_weapons.magazine, 
			#__jigs_players.ammunition
			FROM #__jigs_players
			
			LEFT JOIN #__jigs_weapons 
			ON #__jigs_players.id_weapon = #__jigs_weapons.id
			
			LEFT JOIN #__jigs_weapon_names 
			ON #__jigs_weapons.item_id = #__jigs_weapon_names.id 
			
			
			WHERE #__jigs_players.iduser = " . $user->id);




		$result = $db->loadRow();

		$image = '<a rel="{handler: \'iframe\', size: {x: 640, y: 480}}" href="index.php?option=com_battle&view=weapons&id=' .  $user->id . ' "> ' .
			'<img src="components/com_battle/images/weapons/' . $result[1] . '"></a>' .
			'<span class="label">Id: </span>' . $result[0] .'<br><span class="label">Bullets per clip:</span> ' . $result[2] .
			'<br><span class="label">Attack: </span>' . $result[3] .' <span class="label">Defence:</span> ' . $result[4] .
			'<br><span class="label">Precision: </span>' . $result[5] .' <span class="label">Trigger:</span> ' . $result[6] .
			'<br><span class="label">Price: </span>' . $result[7] .' <span class="label">Ammunition Price:</span> ' . $result[8];
			
			
			if ($user->id>0)
			{
			$image .= '<br><span class="label">Magazine: </span><div id = "magazine">' . $result[16]. '</div>';
			$image .= '<br><span class="label">Ammunition: </span><div id = "ammunition">' . $result[17]. '</div>
			
			
			<input type="button" value="Reload" onclick= "reload();"></button>';
            }
		    return $image;
	}

	function get_weapons() {

		$db		    = JFactory::getDBO();
		$user		= JFactory::getUser();

		$db->setQuery("SELECT #__jigs_weapons.item_id, #__jigs_weapon_names.name, #__jigs_weapon_names.sell_price " .
			" FROM #__jigs_weapons " .
			" LEFT JOIN #__jigs_weapon_names ON #__jigs_weapons.item_id =  #__jigs_weapon_names.id " .
			"WHERE #__jigs_weapons.player_id =".$user->id);

		$result     = $db->loadAssocList();
		return $result;
	}

	function get_weapons2() {

		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();

		$db->setQuery("SELECT #__jigs_weapons.item_id, #__jigs_weapon_names.name " .
			"FROM #__jigs_weapons " .
			"LEFT JOIN #__jigs_weapon_names ON #__jigs_weapons.item_id =  #__jigs_weapon_names.id " .
			"WHERE #__jigs_weapons.player_id =".$user->id);
		$result		= $db->loadAssocList();
		return $result;
	}



	function get_spells() {

		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();

		$db->setQuery("SELECT #__jigs_spells.item_id, #__jigs_spell_names.name " .
			"FROM #__jigs_spells LEFT JOIN #__jigs_spell_names ON #__jigs_spells.item_id =#__jigs_spell_names.id  " .
			"WHERE #__jigs_spells.player_id =".$user->id);

		$result		= $db->loadAssocList();
		return $result;
	}

	function get_software() {

		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();

		$db->setQuery("SELECT * " .
			"FROM #__jigs_software " .
			"WHERE #__jigs_software.iduser =".$user->id);

		$result		= $db->loadRow();
		return $result;
	}

	function get_shop_software() {

		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);

		$db->setQuery("SELECT  " .
			"quantity_1 ,	price_1 ,	quantity_2 ,price_2 ,	quantity_3 	,price_3, " .
			"quantity_4 ,	price_4 ,	quantity_5 ,price_5 ,	quantity_6 ,	price_6 , " .
			"quantity_7 ,	price_7 ,	quantity_8 ,	price_8		".	
			"FROM #__jigs_software " .
			"WHERE #__jigs_software.iduser =".$building_id);

		$result		= $db->loadRow();
		return $result;
	}
	function get_property() {

		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();

		$db->setQuery("SELECT image " .
			"FROM #__jigs_buildings " .
			"WHERE #__jigs_buildings.proprio  =".$user->id);

		$result		= $db->loadAssocList();
		return $result;
	}


	function buy() {
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$item		= JRequest::getvar(item);

		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =" . $user->id);

		$player_money	= $db->loadResult();

		$db->setQuery("SELECT sell_price FROM #__jigs_shop_prices WHERE #__jigs_shop_prices.item_id = " . $item .
			" AND #__jigs_shop_prices.shop_id = " . $building_id);

		$sell_price	= $db->loadResult();
		if ($player_money > $sell_price) {
			$player_money	= $player_money - $sell_price;

			$db->setQuery( "INSERT INTO #__jigs_inventory (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")");
			$result		= $db->query();

			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2	= $db->query();
			$result3	='true';

			return $player_money;
		}
	}
	
	function retrieve() {
		$db             = JFactory::getDBO();
		$user           = JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$item		    = JRequest::getvar('item');
		$sql            = "UPDATE #__jigs_inventory SET player_id = $user->id, location = 1 WHERE id = $item";
		$db->setQuery($sql);
		$result2	    = $db->query();
		$result3	    ='true';
		return $sql;
		
	}
	
	function store()
	{
		$db		        = JFactory::getDBO();
		$user		    = JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$item		    = JRequest::getvar('item');
		$room		    = JRequest::getvar('room');
		$sql            = "UPDATE #__jigs_inventory SET player_id = $building_id, location = $room WHERE id= $item";
		$db->setQuery($sql);
		$db->query();
		return 'true';
	}


	function buy_metal() {

		$db			        = JFactory::getDBO();
		$user			    = JFactory::getUser();
		$building_id		= JRequest::getvar('building_id');
		$item			    = JRequest::getvar('metal');
		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =" . $user->id);
		$player_money		= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_shop_metal_prices WHERE #__jigs_shop_metal_prices.item_id = " . $item .
			" AND #__jigs_shop_metal_prices.shop_id = " . $building_id);
		$sell_price = $db->loadResult();

		if ($player_money > $sell_price) 
		{
			$player_money	= $player_money - $sell_price;

			$sql		= "INSERT INTO #__jigs_metals (player_id , item_id,quantity) 
				VALUES (" . $user->id . " , " . $item . ",1) 
				ON DUPLICATE KEY UPDATE quantity = quantity + 1";

			$db->setQuery($sql);
			$result		= $db->query();
			$sql		= "UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id;
			$db->setQuery($sql);

			$result2	= $db->query();
			$result3	= 'true';
			$message    = "You bought the metal";
		}
		else
		{
		
		    $message= "You do not have enough cash";
		
		
		}
		$this->sendFeedback($user->id,$message);

		return $player_money;
	}

	///// ADD UP ALL ENERGY FROM ALL BATTERIES FOR ONE USER /////
	function get_total_energy($id)
	{
		$batteries	= $this->get_all_energy($id);
		$total		= 0;
		foreach ($batteries as $battery)
		{
			$total	= $total + $battery->units;
		}
		return $total;
	}

	///// GET ALL BATTERIES FOR ONE USER /////
	function get_all_energy($id)
	{
		$db		= JFactory::getDBO();
		$sql		= "SELECT * FROM #__jigs_batteries WHERE iduser = " . $id;
		$db->setQuery($sql);
		$_all_energy	= $db->loadObjectList();
		return $_all_energy;
	}

	///// TAKE ENERGY FROM USER'S BATTERIES UNTIL $energy_units_required IS REACHED /////
	function use_battery($id, $energy_units_required)
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$message	= "Energy Required : " . $energy_units_required;
		$this->sendFeedback($user->id,$message);

		$batteries	= $this->get_all_energy($id);
		$total		= $this->get_total_energy($id);
		$message	= "Total Energy available : " . $total;
		$this->sendFeedback($user->id,$message);

		if ($total < $energy_units_required)
		{
			$message="not enough energy";
			$this->sendFeedback($user->id,$message);
			return false;
		}

		$i=1;		
		foreach ($batteries as $battery)
		{
			if($energy_units_required > 0)
			{
				if ($energy_units_required < $battery->units)
				{
					$db			= JFactory::getDBO();
					$battery->units 	= $battery->units - $energy_units_required;
					$message		= $energy_units_required . " unit(s) deducted from  battery " . $i ;
					$energy_units_required	= 0;
					$this->sendFeedback($user->id,$message);
				}
				else
				{
					$energy_units_required	= $energy_units_required - $battery->units;
					$message 		.= $battery->units . " unit(s) deducted from  battery " . $i . "<br/>";
					$battery->units		= 0;
					$message 		.= "zero units remaining in battery " . $i ."</br>";
					$this->sendFeedback($user->id,$message);
				}

				$sql	= "UPDATE #__jigs_batteries SET units = " . $battery->units . " WHERE id = " . $battery->id;
				$db->setQuery($sql);
				$result	= $db->query();
			}
			else
			{
				$message= "energy transer complete";
				$this->sendFeedback($user->id,$message);
				break;
			}
			$i++;
		}

		$total		= $this->get_total_energy($id);
		$message	= $total . " remaining energy units";
		$this->sendFeedback($user->id,$message);
		return true;
	}

	/// GIVE BATTERY FROM USER TO BUILDING ///
	function swap_battery()
	{
		$db		= JFactory::getDBO();
		$building_id	= JRequest::getvar('building_id');
		$id		= JRequest::getvar('id');
		$sql		= "UPDATE #__jigs_batteries SET iduser = $building_id where id = $id";
		$db->setQuery($sql);
		$result		= $db->query();	
		return $sql;
	}

	function charge_battery()
	{
	}

	///// PLAYER BUYS BATTERY FROM THIN AIR. GETS 100 UNITS MONEY DEDUCTED /////
	function buy_battery()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');

		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =" . $user->id);
		$player_money	= $db->loadResult();
		$sell_price	= 100;

		if ($player_money > $sell_price)
		{
			$player_money	= $player_money - $sell_price;
			$sql		= "INSERT INTO #__jigs_batteries (charge_percentage,capacity,iduser) VALUES (100,10,$user->id)";
			$db->setQuery($sql);
			$result		= $db->query();

			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2	= $db->query();
			$result3	= 'true';
			return $player_money;
		}
		return $player_money;
	}

	///// PLAYER SELLS BATTERY TO BUILDING /////
	function sell_battery()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');

		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =" . $user->id);
		$player_money	= $db->loadResult();
		$sell_price	= 90;
		$player_money	= $player_money + $sell_price;

		$sql2		= "UPDATE #__jigs_batteries SET iduser = $building_id WHERE iduser = " . $user->id . " LIMIT 1";
		$db->setQuery($sql2);
		$result		= $db->query();

		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
		$result2	= $db->query();
		$result3	= 'true';

		return $sql2;
	}

	///// SELECT ALL BATTERIES FOR A USER /////
	function get_batteries()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$sql		= "SELECT * FROM #__jigs_batteries WHERE iduser =" . $user->id;
		$db->setQuery($sql);
		$result		= $db->loadRowlist();
		//return $sql;
		return $result;
	}



	function moved_get_character_inventory($id)
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();

		$db->setQuery("SELECT #__jigs_inventory.item_id, " .
			"#__jigs_objects.name " .
			"FROM #__jigs_inventory " .
			"LEFT JOIN #__jigs_objects " .
			"ON #__jigs_inventory.item_id = #__jigs_objects.id " .
			"WHERE #__jigs_inventory.player_id =".$id);
		$result		= $db->loadAssocList();
		return $result;
	}



	function buy_weapon()
	{
		$db			= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id		= JRequest::getvar(building_id);
		$item			= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =" . $user->id);
		$player_money		= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_weapon_names WHERE #__jigs_weapon_names.id = " . $item );
		$sell_price		= $db->loadResult();
		if ($player_money > $sell_price) {
			$player_money	= $player_money - $sell_price;
			$db->setQuery( "INSERT INTO #__jigs_weapons (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")"
			);

			$result		= $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2	= $db->query();
			$result3	='true';
			return $player_money;
		}
	}

	function buy_crystals()
	{
		$db			= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id		= JRequest::getvar(building_id);
		$item			= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =".$user->id);
		$player_money		= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_crystals WHERE #__jigs_crystals.id =".$item);
		$sell_price		= $db->loadResult();

		if ($player_money > $sell_price)
		{
			$player_money	= $player_money - $sell_price;
			$db->setQuery( "INSERT INTO #__jigs_crystals (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")");
			$result		= $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2	= $db->query();
			$result3	= 'true';	
			$result		= $db->loadRow();
			return $player_money;
		}
	}

	function buy_papers()
	{
		$db			= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id		= JRequest::getvar('building_id');
		$item			= JRequest::getvar('item');

		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =".$user->id);
		$player_money		= $db->loadResult();

		$db->setQuery("SELECT sell_price FROM #__jigs_papers WHERE #__jigs_papers.id =".$item);
		$sell_price		= $db->loadResult();

		if ($player_money > $sell_price)
		{
			$player_money = $player_money - $sell_price;

			$db->setQuery( "INSERT INTO #__jigs_papers (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")");
			$result = $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2 = $db->query();
			$result3='true';	$result = $db->loadRow();

			return $player_money;
		}
	}

	function buy_blueprints()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$item		= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_blueprints WHERE #__jigs_blueprints.id =".$item);
		$sell_price	= $db->loadResult();

		if ($player_money > $sell_price)
		{
			$player_money	= $player_money - $sell_price;
			$db->setQuery( "INSERT INTO #__jigs_blueprints (user_id, object) VALUES ( $user->id  ,  $item )" );
			$result		= $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2	= $db->query();
			return $player_money;
		}
	}

	function buy_building()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =".$user->id);
		$player_money	= $db->loadResult();

		//$db->setQuery("SELECT price FROM #__jigs_buildings WHERE #__jigs_buildings.id =".$building_id);
		//$sell_price	= $db->loadResult();
		
		$db->setQuery("SELECT * FROM #__jigs_buildings WHERE #__jigs_buildings.id =".$building_id);
		$result 	= $db->loadObject();

		$sell_price = $result->price;
		$type  = $result->type;

		// If the Player has enough money
		if ($player_money >= $sell_price)
		{
		//	$this->buy_building_award($type);

			// player loses cost of building
			$player_money = $player_money - $sell_price;

			// player gets building
			$db->setQuery("UPDATE #__jigs_buildings SET owner = $user->id WHERE #__jigs_buildings.id = " . $building_id);
			$result = $db->query();

			// update new players cash in hand to database
			$db->setQuery("UPDATE #__jigs_players SET money = " . $player_money . " WHERE iduser = " . $user->id );
			$result = $db->query();
			$message ="You have bought this building";
		}

		// player does not have enough money
		else
		{
			$message ="You do not have enough cash to buy this building";
		}
		$this->sendFeedback($user->id,$message);

		return $result;
	}

	function buy_building_award($type)
	{
		//$fh = fopen("/home/jk/sites/jigs.nilnullvoid.com/public/tmp/buybuilding","a");
		$db     = JFactory::getDBO();
		$user   = JFactory::getUser();
		
		$msg1 = "You bought your first building";

		$query1 = "SELECT * FROM #__jigs_buildings WHERE owner = ".$user->id;
		$query2 = $query1;

		switch($type)
		{
		case 'factory':
			$msg2 = "You bought your first factory";
			$query2 .= " AND type = 'factory'";
			break;
		
		case 'farm':
			$msg2 = "You bought your first farm";
			$query2 .= " AND type = 'farm'";
			break;
		
		case 'mine':
			$msg2 = "You bought your first mine";
			$query2 .= " AND type = 'mine'";
			break;
		
		default:
			break;
		}

		
		$db->setQuery($query1);
		$res1 = $db->query();
		$result1  = $db->loadObjectList();
		$numRows1 = count($result1);  //$db->getNumRows();

		//fwrite($fh, "query1=$query1\nnumRows1=$numRows1\n".print_r($result1,true));

		if($numRows1 == 0)
		{
			$model =& JModel::getInstance('award','BattleModel');

			$awardNameId = $model->get_award_id($msg1);
			if(null == $awardNameId)
			{
				$awardNameId = $model->insert_award_name($msg1);
			}
			$id = $model->insert_award($awardNameId);
			//fwrite($fh, "insert_award 1 $awardNameId id=$id\n");
		}

		$db->setQuery($query2);
		$res2 = $db->query();
		$result2  = $db->loadObjectList();
		$numRows2 = count($result2); //$db->getNumRows();

		//fwrite($fh, "query2=$query2\nnumRows2=$numRows2\n".print_r($result2,true));

		if($numRows2 == 0)
		{
			$awardNameId = $model->get_award_id($msg2);
			if(null == $awardNameId)
			{
				$awardNameId = $model->insert_award_name($msg2);
			}
			$id = $model->insert_award($awardNameId);
			//fwrite($fh, "insert_award 2 $awardNameId id=$id\n");
		}

		//fclose($fh);

		return 1;
	}

	function sell()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$item		= JRequest::getvar('item');
		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM #__jigs_shop_prices WHERE item_id = ". $item . " AND shop_id = " . $building_id );
		$buy_price	= $db->loadResult();
		$player_money	= $player_money + $buy_price;
		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
		$result2	= $db->query();
		$db->setQuery("DELETE FROM #__jigs_inventory WHERE #__jigs_inventory.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result		= $db->query();
		return $result;
	}

	function sell_metal()
	{
		$db 		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$item		= JRequest::getvar('metal');
		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser = ".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM #__jigs_shop_metal_prices WHERE item_id = ". $item . " AND shop_id = " . $building_id );
		$buy_price	= $db->loadResult();
		$player_money	= $player_money + $buy_price;
		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
		$result2	= $db->query();
		$sql		= "UPDATE #__jigs_metals SET quantity = quantity - 1 WHERE #__jigs_metals.player_id = " . $user->id .
			" AND item_id= $item ";
		$db->setQuery($sql);
		$result		= $db->query();
		return $result;
	}	


	function sell_weapon()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$item		= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_weapon_names WHERE id = ". $item );
		$buy_price	= $db->loadResult();
		$player_money	= $player_money + ($buy_price/2);
		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
		$result2	= $db->query();
		$db->setQuery("DELETE FROM  #__jigs_weapons WHERE #__jigs_weapons.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result		= $db->query();
		return $result;
	}


	function sell_crystals()
	{
		$db		= JFactory::getDBO();
		$user 		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$item		= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM #__jigs_crystal_prices WHERE #__jigs_crystal_prices.item_id =".$item);
		$buy_price	= $db->loadResult();
		$player_money 	= $player_money + $buy_price;
		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
		$result2	= $db->query();
		$db->setQuery("DELETE FROM  #__jigs_crystals WHERE #__jigs_crystals.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result		= $db->query();
		return $result;

	}
	function sell_papers()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$item		= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE iduser =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM #__jigs_papers WHERE #__jigs_papers.id =".$item);
		$buy_price	= $db->loadResult();
		$player_money	= $player_money + $buy_price;
		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
		$result2	= $db->query();
		$db->setQuery("DELETE FROM #__jigs_papers WHERE #__jigs_papers.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result		= $db->query();
		return $result;
	}

	function get_shop_inventory()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_shop_prices.item_id, " .
			"#__jigs_objects.name, " .
			"#__jigs_shop_prices.sell_price " .
			"FROM #__jigs_shop_prices " .
			"LEFT JOIN #__jigs_objects " .
			"ON #__jigs_shop_prices.item_id = #__jigs_objects.id " .
			"WHERE #__jigs_shop_prices.shop_id =" . $building_id);
		$result		= $db->loadAssocList();
		return $result;
	}
	
	function get_flat_inventory()
	{
		$db		        = JFactory::getDBO();
		$user		    = JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		
		$query          = "SELECT 
		
		#__jigs_objects.name,
		#__jigs_inventory.item_id  
		FROM #__jigs_objects 
		LEFT JOIN #__jigs_inventory	
		ON #__jigs_objects.id = #__jigs_inventory.item_id 
		WHERE #__jigs_inventory.player_id =" . $building_id;
		
		$db->setQuery($query);
		$result		= $db->loadAssocList();
		return $result;
	}
	
	
	
	
	
	
	
	
	
	
	
	

	function get_shop_metals()
	{
		$db		= JFactory::getDBO();
		$building_id	= JRequest::getvar('building_id');
		$query 		= "
			SELECT #__jigs_shop_metal_prices.item_id, #__jigs_metal_names.name, #__jigs_shop_metal_prices.sell_price
			FROM #__jigs_shop_metal_prices
			LEFT JOIN #__jigs_metals ON #__jigs_shop_metal_prices.item_id = #__jigs_metals.id
			LEFT JOIN #__jigs_metal_names ON #__jigs_metal_names.id = #__jigs_shop_metal_prices.item_id
			WHERE #__jigs_shop_metal_prices.shop_id = $building_id";
		$db->setQuery($query);
		$result		= $db->loadAssocList();
		return $result;
	}

	function get_shop_crystals()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_crystal_prices.item_id, " .
			"#__jigs_crystal_names.name, " .
			"#__jigs_crystal_prices.sell_price " . 
			"FROM #__jigs_crystal_prices " .
			"LEFT JOIN  #__jigs_crystal_names " .
			"ON #__jigs_crystal_prices.item_id = #__jigs_crystal_names.id " .
			"WHERE #__jigs_crystal_prices.shop_id =" . $building_id);
		$result		= $db->loadAssocList();
		return $result;
	}



	function get_players()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM #__jigs_players WHERE iduser =".$user->id);
		$result		= $db->loadRow();
		$map		= $result[0];
		$grid		= $result[1];
		$db->setQuery("SELECT
			#__jigs_players.iduser, 
			#__jigs_players.posx, 
			#__jigs_players.posy, 
			#__comprofiler.avatar
			FROM #__jigs_players 
			LEFT JOIN #__comprofiler ON #__jigs_players.iduser = #__comprofiler.user_id
			WHERE grid ='".$grid."' AND map='".$map."' AND #__jigs_players.iduser !='".$user->id."'");
		$result		= $db->loadAssocList();
		return $result;
	}

	// Called by JiGS.js.php via JSON On successful call the player is moved by mootools
	function save_coordinate()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$posx		= JRequest::getvar('posx');
		$posy		= JRequest::getvar('posy');
		$map		= JRequest::getvar('map');
		$grid		= JRequest::getvar('grid');
		$db->setQuery("UPDATE #__jigs_players SET posx='".$posx."',posy='".$posy."',map='".$map."',grid='".$grid.
			"'  WHERE iduser ='".$user->id."'");
		$db->query();
		$result		='success';
		return $result;
	}

	function attack_player()
	{
		$db		            = JFactory::getDBO();
		$player		        = JFactory::getUser();
		//$user2	        = substr(JRequest::getvar('character'),5);
		$user2		        = JRequest::getvar('character');
		$player2	        = JFactory::getUser($user2);

		$player->dice       = rand(0, 15);
		$player2->dice      = rand(0, 5);

		$query		         = "SELECT health,money,active FROM #__jigs_players WHERE iduser = $player->id";
		$db->setQuery($query);
		$result		        = $db->loadRow();
		$player->health     = $result[0];
		$player->money      = $result[1];
		$player->status     = $result[2];		

		$query		= "SELECT health,money,active FROM #__jigs_players WHERE iduser = $user2";
		$db->setQuery($query);
		$result		= $db->loadRow();
		$player2->health= $result[0];
		$player2->money	= $result[1];
		$player2->status= $result[2];		


		if ($player2->status!=1)
		{
			$message	= "This player is inactive. You cannot attack this player at this time<br/>";
		}
		elseif ($player->status !=1)
		{
			$message	= "You are inactive. You cannot attack players at this time<br/>";
		}

		else// roll the dice and let the games begin
		{
			if ($player->dice > $player2->dice)
			{
				$player->health		= $player->health -1;
				$player2->health	= $player2->health-30;
				$message	= "You attacked " . $player2->username .
					" and inflicted 30 points of damage. You: $player->health ,Opponent: $player2->health";
			}
			else
			{
				$player->health     = $player->health - 10;
				$player2->health    = $player2->health + 10;

				$message	        = "You attacked " . $player2->username . " and missed. " . $player2->username .
					" retaliated and inflicted 10 points of damage. You: $player->health ,Opponent: $player2->health ";
			}

			if ($player2->health <= 0)
			{
				$now			    = time();

				$player->money	    =  $player->money + $player2->money;
				$player2->money	    = 0;
				$query 		        = "UPDATE #__jigs_players SET active = 3,  grid=1, map= 3, posx = 4, posy=5, empty= 1 , time_killed = $now 
					WHERE iduser = $user2";
				$db->setQuery($query);
				$db->query();

				$query 		        = "UPDATE #__jigs_inventory SET #__jigs_inventory.player_id = $player->id 
					WHERE #__jigs_inventory.player_id = $player_id ";
				$db->setQuery($query);
				$db->query();

				$query 		        = "UPDATE #__jigs_players SET nbr_kills=nbr_kills+1, money = $player->money 
					WHERE #__jigs_players.iduser = $user->id" ;
				$db->setQuery();
				$db->query();
				$query 		        = "UPDATE #__jigs_players SET money = $player2->money WHERE #__jigs_players.iduser = $player->id";
				$db->setQuery($query);
				$db->query();

				$text		        = 'Citizen ' . $player2->username  . ' was hospitalised by citizen ' . $user->username ;
				$message	    = "You put " . $player2->username . " into hospital.";
				$this->sendWavyLines($text);
			}

			$db->setQuery("UPDATE #__jigs_players SET health='" . $player->health. "'  WHERE iduser ='" . $player->id . "'");
			$db->query();
			$db->setQuery("UPDATE #__jigs_players SET health='" . $player2->health. "'  WHERE iduser ='" . $player2->id . "'");
			$db->query();
		}
		$results[0]	= $player->health;
		$results[1]	= $player2->health;
		$results[2]	= $message;

		$this->sendFeedback($player->id,$message);

		return $results;
	}


	function attack_character()
	{
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$character_id	= JRequest::getInt('character');
		$sql			= "SELECT iduser, health, money, final_attack, final_defence, dexterity, level, id_weapon 
		FROM #__jigs_players 
		WHERE iduser = " . $user->id;
		$db->setQuery($sql);
		$player			= $db->loadObject();

		$player->dice	= rand(0, 15);
		$query			= "SELECT id, name, level, health, money FROM #__jigs_characters WHERE id =" . $character_id;
		$db->setQuery($query);
		$npc			= $db->loadObject();

		$npc->dice		= rand(0, 5);
		$attack_type	= JRequest::getCmd('type');

		switch ($attack_type)
		{
			///// If Player shoots test shooting skills + dexterity against NPCs speed //////////////
		case 'shoot':
			$query						= "SELECT #__jigs_weapons.magazine,
												  #__jigs_weapon_names.attack
											FROM #__jigs_weapons 
											LEFT JOIN #__jigs_weapon_names
											ON #__jigs_weapons.item_id = #__jigs_weapon_names.id
											WHERE #__jigs_weapons.id =" . $player->id_weapon;
			$db->setQuery($query);
			$player->weapon			    = $db->loadAssoc();
			$damage                     = (int)(($player->weapon['attack'] * $player->dexterity * $player->level) / $npc->level) + ($player->dice - $npc->dice);
			
			if ($player->weapon['magazine'] > 0)
			{
				if ($player->dice * $player->level + $player->dexterity > $npc->dice * $npc->level)
				{
					$npc->health	= intval($npc->health - $damage );
					$attack_message	= "You shoot $npc->name and inflict $damage damage points to his health.You: 
					$player->health ,Opponent: $npc->health ";
				}
				else
				{
					$attack_message	= "You shoot $npc->name and miss. You: $player->health, Opponent: $npc->health";
				}
				$player->weapon['magazine']--;
			
        		$attack_message	.= "number of bullets left: " . $player->weapon['magazine'];
			}
			else{
					$attack_message	= "You have no bullets in your gun clip";
			}
			break;
	
			//====== If Player kicks, test kicking and other fighting skills + speed + dexterity against NPCs speed ////////
		
		case 'kick':
			if ($player->dice > $npc->dice)
			{
				$npc->health		= intval($npc->health - 30);
				$attack_message		= "You kick " . $npc->name . "and inflict 30 damage points to his health.You: $player->health ,Opponent: $npc->health ";
			}
			else
			{
				$player->health		=	intval($player->health - 10);
				$attack_message		=	"You kick " . $npc->name . "and miss and incur 10 damage points to your health.You: $player->health ,Opponent: $npc->health ";
			}
			break;

			// If Player punches, test punch and other fighting skills + speed + dexterity against NPCs speed /////////////
		case 'punch':
			if ($player->dice >= $npc->dice)
			{
				$npc->health	=	intval($npc->health - 20);
				$attack_message	= "You punch " . $npc->name . "and inflict 20 damage points to his health.You: $player->health ,Opponent: $npc->health";
			}
			else
			{
				$player->health	= intval($player->health - 10);
				$attack_message	= "You punch " . $npc->name . "and miss and incur 10 damage points to your health.You: $player->health ,Opponent: $npc->health";
			}
			break;
		}
		////////////////////////////////////////// If NPC is dead ////////////////////////////////////
		if ($npc->health <= 0)
		{
			$npc->health	= 0;
			$this->dead_npc($npc);
		}

		////////////////////////////////////////// If Player is dead ////////////////////////////////////
		if ($player->health <= 0)
		{
			$player->health = 0;
			$this->dead_player($npc->name);		
		}

		/////////////////////////////////////// Now update everybodys stats to database //////////////////
		$sql = "UPDATE #__jigs_players SET health = $player->health WHERE iduser = $user->id ";
		$db->setQuery($sql);
		$db->query();

		$sql = "UPDATE #__jigs_characters SET health = $npc->health WHERE id = $npc->id";
		$db->setQuery($sql);
		$db->query();


		$magazine = $player->weapon['magazine'];
		$sql = "UPDATE #__jigs_weapons SET magazine = $magazine  WHERE id = $player->id_weapon";
		$db->setQuery($sql);
		$db->query();
		

		/////////////////////////////////////////////////////////////////////////////////////////////////
		$this->sendFeedback($player->iduser,$attack_message);

		$result[0]	= $player->health;
		$result[1]	= $npc->health;
		$result[2]	= $attack_message;
		$result[3]  = $player->weapon['magazine'];
		
		return $result;
		
	}

	function dead_npc($npc)
	{
		$db		    = JFactory::getDBO();
		$user		= JFactory::getUser();	
		$now		= time();
		$sql		= "UPDATE #__jigs_characters SET active = 0, empty = 1 , time_killed = $now WHERE id  = $npc->id";
		$db->setQuery($sql);
		$db->query();
		$sql		= "UPDATE #__jigs_inventory SET #__jigs_inventory.player_id = $user->id WHERE #__jigs_inventory.player_id = $npc->id";
		$db->setQuery($sql);
		$db->query();
		//// Update specific and General stats and payout when applicable

		$xp_type	= 'nbr_kills';
		$this->increment_xp($xp_type, $npc->money,$user->id);

		$text		= 'Citizen ' . $npc->name . ' was killed by citizen ' . $user->username . '<br/>' ;
		$this->sendWavyLines($text);
		$this->sendFeedback($user->id, $text);	
		return $text;
	}

	function dead_player($winner)
	{
		$user		= JFactory::getUser();
		$db		    = JFactory::getDBO();		
		$now		= time();
		$db->setQuery("UPDATE #__jigs_players SET active = 3,  grid=1, map= 3, posx = 4, posy=5, empty= 1 , time_killed = " . $now . " 
			WHERE iduser ='".$user->id."'");
		$result		= $db->query();

		$db->setQuery("UPDATE #__jigs_inventory SET #__jigs_inventory.player_id = $winner WHERE #__jigs_inventory.player_id = " . $user->id );
		$result		= $db->query();

		$db->setQuery("UPDATE #__jigs_players SET money = 0 WHERE #__jigs_players.iduser = " .   $user->id ) ;
		$result		= $db->query();

		$text= 'Citizen ' .  $user->username  . ' was put in hospital by ' . $winner ;
		$this->sendWavyLines($text);
		return;
	}

	function increment_xp($xp_type ,$payment,$user_id)
	{
		$db 	= JFactory::getDBO();
		$query	="UPDATE #__jigs_players SET $xp_type  = $xp_type  +1, xp = xp+1, money = money + " . $payment .
			" WHERE #__jigs_players.iduser = " .  $user_id;
		$db->setQuery($query);
		$db->query();
		$this->test_level($user_id);
		return $query;
	}

	function test_level($user_id)
	{
		$user		= JFactory::getUser();
		$db		    = JFactory::getDBO();
		$now		= time();
		$query		= "SELECT xp FROM #__jigs_players where iduser = $user_id";
		$db->setQuery($query);
		$xp		= $db->loadResult();
		$milestones	= array(100,200,400,800,1600,2000,4000,8000);

		foreach ($milestones as $check)
		{
			if ($xp == $check)
			{
				$query	= "UPDATE #__jigs_players SET level=level+1, statpoints = statpoints + 5 WHERE iduser = $user_id";
				$db->setQuery($query);
				$db->query();
				$text	= 'Citizen ' . $user->username . ' leveled up';
				$this->sendWavyLines($text);
				$this->sendFeedback($user->id,$text);
			}
		}
	}

	function swap()
	{
		$db		    = JFactory::getDBO();
		$user		= JFactory::getUser();
		$weapon_id	= JRequest::getvar('weapon_id');
		
		$db->setQuery("UPDATE #__jigs_players SET id_weapon = '" . $weapon_id . "' WHERE iduser =".$user->id);
		$db->query();
		$result		= $weapon_id ;
		return $result;
	}

	function deposit()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$qty		= JRequest::getvar('amount');
		$building_id	= JRequest::getvar('building_id');
		$now		= time();
		$db->setQuery("Select money, bank FROM #__jigs_players WHERE iduser = " . $user->id);
		$result		= $db->loadRow();
		$money		= $result[0];
		$bank		= $result[1];
		if ($qty <= $money)
		{
			$money = $money - $qty;
			$bank = $bank + $qty;
			$query = "UPDATE #__jigs_players SET money = $money, bank = $bank  WHERE iduser = " . $user->id;
			$db->setQuery($query);
			$db->query();
		}
		return $result;
	}

	function withdraw()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$qty		= JRequest::getvar('amount');
		$building_id	= JRequest::getvar('building_id');
		$now		= time();
		$db->setQuery("Select money, bank FROM #__jigs_players WHERE iduser = ".$user->id);
		$result		= $db->loadRow();
		$money		= $result[0];
		$bank		= $result[1];

		if ($qty <= $bank){
			$money	= $money + $qty;
			$bank	= $bank - $qty;
			$query	= "UPDATE #__jigs_players SET money = $money, bank = $bank  WHERE iduser =" . $user->id;
			$db->setQuery($query);
			$db->query();
		}
		return $result;
	}


	function buy_bullets()
	{
		$db		        = JFactory::getDBO();
		$user		    = JFactory::getUser();
		$qty		    = JRequest::getvar('amount');
		$building_id	= JRequest::getvar('building_id');
		$now		    = time();
		$db->setQuery("Select money, ammunition FROM #__jigs_players WHERE iduser = ".$user->id);
		$result		    = $db->loadRow();
		$money		    = $result[0];
		$ammunition	    = $result[1];

		if ($qty <= $money){
			$money	    = $money - $qty;
			$ammunition	= $ammunition + $qty;
			$query	    = "UPDATE #__jigs_players SET money = $money, ammunition = $ammunition  WHERE iduser =" . $user->id;
			$db->setQuery($query);
			$db->query();
		}
		return $result;
	}


	function sell_crops()
	{
		$total_crops	= $this->get_total_crops();
		$payment	    = $total_crops * 1000 ;
		$db		        = JFactory::getDBO();
		$user		    = JFactory::getUser();
		$query_1	    = "SELECT money FROM #__jigs_players WHERE iduser = ' . $user->id . '";
		$db->setQuery($query_1);
		$money_saved	= $db->loadResult();
		$xp_type	    = 'nbr_crops';
		$test		    = $this->increment_xp($xp_type ,$payment,$user->id);
		$text		    = $user->username . " has sold " . $total_crops . " crops.";
		$this->sendWavyLines($text);
		$query_2	    = "Update #__jigs_farms LEFT JOIN #__jigs_buildings on #__jigs_farms.building = #__jigs_buildings.id SET total = 0 WHERE #__jigs_buildings.owner = $user->id";
		$db->setQuery($query_2);
		$db->query();

		$text		    = "You sold " . $total_crops . " crops.";
		$this->sendFeedback($user->id, $text);
		return($test);
	}

	function get_total_crops()
	{
		$total_crop 	= 0;
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$query		= "SELECT total FROM #__jigs_farms 
			LEFT JOIN #__jigs_buildings 
			ON #__jigs_farms.building = #__jigs_buildings.id 
			WHERE #__jigs_buildings.owner = $user->id; ";
		$db->setQuery($query);
		$result		= $db->loadResultArray();
		foreach($result as $row)
		{
			$total_crop = $total_crop + $row;
		}
		return ($total_crop);
	}

	function sendWavyLines($text)
	{
		jimport( 'joomla.application.component.helper' );
		jimport( 'joomla.html.parameter' );

		$component	= JComponentHelper::getComponent( 'com_battle' );
		$params		= new JParameter( $component->params );
		$sbid		= $params->get( 'shoutbox_category' );

		$db		= JFactory::getDBO();
		$now		= time();
		$sql		= "INSERT INTO #__shoutbox (name, time,sbid, text) VALUES ('Wavy Lines:', $now,$sbid, '$text' )";
		$db->setQuery($sql);
		$db->query();
		return $sql;
	}


	function sendFeedback($id,$text)
	{
		$db		= JFactory::getDBO();
		$query		= "INSERT INTO #__jigs_logs (user_id, message) VALUES ($id,'$text')";
		$db->setQuery($query) ;
		$db->query();
		return ;
	}


}
