<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modellist');

class BattleModeljigs extends JModellist{
	

	// This is a test method to be called by a chrontab via the kodaly app
	
	function populate_players2()
	{
		//		$user_id= $user['id'];
		//		$user_username= $user['username'];
		
		$db				= JFactory::getDBO();
		$query			= "INSERT INTO `jos_jigs_players2` ( `id`) VALUES (1)";
		$db->setQuery($query);
		$result			= $db->query();
		return;
	}
	
	
	function eat()
	{
		$db			= JFactory::getDBO();
		$user			= JFactory::getUser();
		$query			= $db->getQuery(true);
		$query->select('health, money');
		$query->from('#__jigs_players');
		$query->where('id = ' . $user->id);
		$db->setQuery($query);
		$result			= $db->loadAssoc();
		$health			= $result['health'];
		$money			= $result['money'];
		
	//	return json_encode($query);
		
		
		
		if ($money > 10)
		{
			$money		= $money - 10;
			$health		= $health + 10;
			$sql		= "Update #__jigs_players SET money = $money, health = $health WHERE id= " . $user->id;
			$db->setQuery($sql);
			$db->query();
			$return		= "success";
		}
		else
		{
			 $return		= "broke";
		}
	
		return $return;
	}
	
	function update_flags($flags)
	{
	
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
    		$flags		= implode( ',', $flags);
		$sql		="UPDATE #__jigs_players SET flags =('$flags') WHERE id =". $user->id;
		$db->setQuery($sql);
		$db->query();
		return $result;
	
	}
	function get_cells()
	{

		$map		= JRequest::getvar('map');
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT row0,row1,row2,row3,row4,row5,row6,row7 FROM #__jigs_maps WHERE id = ".$map);
		$result		= $db->loadAssocList();
		return $result;

	}

	function get_portals()
	{

		$map		= JRequest::getvar('map');
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT * FROM #__jigs_portals WHERE from_map =" . $map);
		$result		= $db->loadAssocList();
		return $result;
	}

	function add_message($message_id)
	{

		$db		= JFactory::getDBO();
		$message_id	=int($message_id);
		$user		= JFactory::getUser();
		$db->setQuery("SELECT  messages FROM #__jigs_players WHERE id =".$user->id);
		$result		= $db->loadAssocList();

		array_unshift ( $result , $message_id);
		$db->setQuery( "UPDATE  #__jigs_players SET messages = $message WHERE id =".$user->id);
		$result		= $db->query();
		return $result;

	}

	function get_messages_old()
	{
		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT messages FROM #__jigs_players WHERE id =".$user->id);
		$result		= $db->loadResult();
		$result		= explode(',',$result);

		foreach ($result as $message_id)
		{
			$db->setQuery("SELECT string FROM #__jigs_messages WHERE id =" . $message_id);
			$message_list[]		= $db->loadResult();
		}

		return $message_list;
	}
	
	
	
	
	function get_messages()
	{
		$db					= JFactory::getDBO();
		$user				= JFactory::getUser();
		$db->setQuery("SELECT message FROM #__jigs_logs WHERE user_id =".$user->id ." ORDER BY timestamp DESC");
		$message_list		= $db->loadObjectList();
	
	return $message_list;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	

	function get_stats() 
	{
		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
	//	$test		= self::set_final_stats();
		$sql		= "SELECT level, health, strength, intelligence,speed, posx, posy, xp,energy, money, bank, defence, final_defence,
		 attack, final_attack, nbr_attacks, nbr_kills, flags FROM #__jigs_players WHERE id = " . $user->id;
		$db->setQuery($sql);
		$result		= $db->loadAssocList();
		
		return $result;
	}


	function get_player() 
	{
		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$test		= self::set_final_stats();
		$db->setQuery("
		SELECT posx, posy, xp, grid, map
		FROM #__jigs_players WHERE id =".$user->id);
		$result		= $db->loadAssocList();
		return $result;
	}

	function set_final_stats() 
	{

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$db->setQuery("Select attack, defence FROM  #__jigs_players WHERE id =".$user->id);
		$db->query();
		$result			= $db->loadRow();
		$attack			= $result[0];
		$defence		= $result[1];
		$db->setQuery("
		Select #__jigs_weapon_names.attack, #__jigs_weapon_names.defence FROM #__jigs_players
		LEFT JOIN #__jigs_weapon_names
		ON #__jigs_players.id_weapon = #__jigs_weapon_names.id
		WHERE id =".$user->id);
		$db->query();
		$result				= $db->loadRow();
		$weapon_attack		= $result[0];
		$weapon_defence		= $result[1];
		$final_attack		= $attack + $weapon_attack;
		$final_defence		= $defence + $weapon_defence;
		$db->setQuery("UPDATE #__jigs_players SET final_attack = '" . $final_attack. "', final_defence = '" . $final_defence . "'WHERE id =".$user->id);
		$db->query();
		return ($result);
	}

	function leave_room()
	{
		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$query		= "Update #__jigs_players SET active=1 WHERE id = $user->id";
		$db->setQuery($query);
		$db->query();
		return true;
	}


	function get_papers() 
	{

		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT #__jigs_papers.item_id, #__jigs_paper_names.name, #__jigs_papers.buy_price " .
			"FROM #__jigs_papers " .
			"LEFT JOIN #__jigs_paper_names " .
			"ON #__jigs_papers.item_id = #__jigs_paper_names.id " .
			"WHERE #__jigs_papers.player_id =".$user->id);
		$result		= $db->loadAssocList();
		return $result;

	}


	function get_shop_papers() 
	{

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_papers.item_id, " .
				"#__jigs_papers.sell_price, " . 
				"#__jigs_paper_names.name " .
				"FROM #__jigs_papers LEFT JOIN  #__jigs_paper_names ON #__jigs_papers.item_id = #__jigs_paper_names.id " .
				"WHERE #__jigs_papers.player_id =" . $building_id);
		$result			= $db->loadAssocList();
		return $result;

	}

	function get_blueprints() 
	{
		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT #__jigs_blueprints.id, #__jigs_objects.name " .
			"FROM #__jigs_blueprints " .
			"LEFT JOIN #__jigs_objects " .
			"ON #__jigs_blueprints.object = #__jigs_objects.id " .
			"WHERE #__jigs_blueprints.user_id =".$user->id);
		$result		= $db->loadAssocList();
		return $result;

	}

	function get_shop_blueprints()
	 {

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


	function get_shop_clothing() 
	{

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_clothing.item_id, " .
				"#__jigs_clothing.sell_price, " . 
				"#__jigs_clothing_names.name " .
				"FROM #__jigs_clothing LEFT JOIN  #__jigs_clothing_names ON #__jigs_clothing.item_id = #__jigs_clothing_names.id " .
				"WHERE #__jigs_clothing.player_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;

	}

	function get_shop_spells()
	{

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_spells.item_id, " .
				"#__jigs_spells.sell_price, " . 
				"#__jigs_spell_names.name " .
				"FROM #__jigs_spells LEFT JOIN  #__jigs_spell_names ON #__jigs_spells.item_id = #__jigs_spell_names.id " .
				"WHERE #__jigs_spells.player_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;
	}

	function get_shop_weapons() 
	{

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_weapons.item_id, " .
				"#__jigs_weapon_names.sell_price, " . 
				"#__jigs_weapon_names.name " .
				"FROM #__jigs_weapons LEFT JOIN  #__jigs_weapon_names ON #__jigs_weapons.item_id = #__jigs_weapon_names.id " .
				"WHERE #__jigs_weapons.player_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;
	}


	function get_inventory_to_sell() 
	{

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar('building_id');
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
	function get_metals_to_sell() 
	{
	
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
			
		$query		= "SELECT #__jigs_metals.item_id, 
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
		$result = $db->loadAssocList();
		return $result;
	}
	
	function get_metals_for_sale() 
	{
	
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar('building_id');
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
	

	
	function get_crystals() 
	{

		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_crystals.item_id, " .

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



	function get_inventory2() 
	{

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT DISTINCT 
				#__jigs_inventory.item_id, " .
				"#__jigs_objects.name " .
				"FROM #__jigs_inventory " .
               	"LEFT JOIN #__jigs_objects " .
				"ON #__jigs_inventory.item_id = #__jigs_objects.id " .
				"WHERE #__jigs_inventory.player_id = ". $user->id  
		);
		$result = $db->loadObjectList();
		foreach ($result as $row){
			$sql			="SELECT id FROM #__jigs_inventory WHERE #__jigs_inventory.player_id = $user->id  and #__jigs_inventory.item_id = $row->item_id";
			$db->setQuery($sql);
			$quantity		= $db->loadAssocList();
			$row->quantity	= count($quantity);
		}
		return $result;
	}





	function get_metals2() 
	{

		$db		= JFactory::getDBO();
		$user	= JFactory::getUser();
		$db->setQuery("SELECT #__jigs_metals.item_id, " .
			  "#__jigs_metals.quantity, " .
		"#__jigs_metal_names.name " .

				"FROM #__jigs_metals " .
				"LEFT JOIN  #__jigs_metal_names " .
				"ON #__jigs_metals.item_id = #__jigs_metal_names.id " .
				"WHERE #__jigs_metals.player_id =" . $user->id);
		$result = $db->loadAssocList();
		return $result;
	}

	function get_crystals2() 
	{

		$db		= JFactory::getDBO();
		$user	= JFactory::getUser();
		$db->setQuery("SELECT #__jigs_crystals.item_id, " .
		"#__jigs_crystal_names.name, #__jigs_crystals.quantity " .

				"FROM #__jigs_crystals " .
				"LEFT JOIN  #__jigs_crystal_names " .
				"ON #__jigs_crystals.item_id = #__jigs_crystal_names.id " .
				"WHERE #__jigs_crystals.player_id =" . $user->id);
		$result = $db->loadAssocList();
		return $result;
	}


	function get_skills() 
	{

		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT * FROM #__jigs_skills WHERE #__jigs_skills.id =".$user->id);
		$result1 	= $db->loadObject();
		for ($i= 1;$i< 9;$i++){
			$db->setQuery("SELECT name FROM #__jigs_skill_names WHERE #__jigs_skill_names.id = '". $result1->skill_ . $i ."'" );
			$result = $db->loadresult();
			$all[$i] =	$result;
		}
		return $all ;
	}


	function get_clothing() 
	{

		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT #__jigs_clothing.item_id, #__jigs_clothing_names.name " .
						"FROM #__jigs_clothing " .
						"LEFT JOIN #__jigs_clothing_names ON #__jigs_clothing.item_id =  #__jigs_clothing_names.id " .
				"WHERE #__jigs_clothing.player_id =".$user->id);
		$result = $db->loadAssocList();
		return $result;
	}

	function get_weapon() 
	{

		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$char		= 62;
		$db->setQuery("SELECT #__jigs_weapon_names.* " .

				" FROM #__jigs_players " .
						"LEFT JOIN #__jigs_weapon_names ON #__jigs_players.id_weapon = #__jigs_weapon_names.id " .
						"WHERE #__jigs_players.id = " . $user->id);
		$result = $db->loadRow();
		$image = '<a rel="{handler: \'iframe\', size: {x: 640, y: 480}}" href="index.php?option=com_battle&view=weapons&id=' .  $user->id . ' "> ' .
				'<img src="components/com_battle/images/weapons/' . $result[1] . '"></a><br>' .
						'Id: ' . $result[0] .'| Bullets per clip: ' . $result[2] .
                         '<br>Attack: ' . $result[3] .'| Defence: ' . $result[4] .
						'<br>Precision: ' . $result[5] .'| Detente: ' . $result[6] .
							'<br>Price: ' . $result[7] .'| Ammunition Price: ' . $result[8] 
		;

		return $image;
	}


	function get_weapons() 
	{

		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT #__jigs_weapons.item_id, #__jigs_weapon_names.name, #__jigs_weapon_names.sell_price " .
						" FROM #__jigs_weapons " .
						" LEFT JOIN #__jigs_weapon_names ON #__jigs_weapons.item_id =  #__jigs_weapon_names.id " .
				"WHERE #__jigs_weapons.player_id =".$user->id);
		$result		= $db->loadAssocList();
		return $result;
	}

	function get_weapons2() 
	{

		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT #__jigs_weapons.item_id, #__jigs_weapon_names.name " .
						"FROM #__jigs_weapons " .
						"LEFT JOIN #__jigs_weapon_names ON #__jigs_weapons.item_id =  #__jigs_weapon_names.id " .
				"WHERE #__jigs_weapons.player_id =".$user->id);
		$result		= $db->loadAssocList();
		return $result;
	}



	function get_spells()
	 {

		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT #__jigs_spells.item_id, #__jigs_spell_names.name " .
				"FROM #__jigs_spells LEFT JOIN #__jigs_spell_names ON #__jigs_spells.item_id =#__jigs_spell_names.id  " .
				"WHERE #__jigs_spells.player_id =".$user->id);
		$result		= $db->loadAssocList();
		return $result;
	}

	function get_software() 
	{

		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT * " .
				"FROM #__jigs_software " .
				"WHERE #__jigs_software.id =".$user->id);
		$result		= $db->loadRow();
		return $result;
	}

	function get_shop_software() 
	{

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$db->setQuery("SELECT  " .
	"quantity_1 ,	price_1 ,	quantity_2 ,price_2 ,	quantity_3 	,price_3, " .
	"quantity_4 ,	price_4 ,	quantity_5 ,price_5 ,	quantity_6 ,	price_6 , " .
	"quantity_7 ,	price_7 ,	quantity_8 ,	price_8		".	
				"FROM #__jigs_software " .

				"WHERE #__jigs_software.id =".$building_id);
		$result		= $db->loadRow();
		return $result;
	}
	function get_property() 
	{

		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT image " .
				"FROM #__jigs_buildings " .
				"WHERE #__jigs_buildings.proprio  =".$user->id);
		$result		= $db->loadAssocList();
		return $result;
	}


	function buy()
	{
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$item			= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =" . $user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_shop_prices WHERE #__jigs_shop_prices.item_id = " . $item . " AND #__jigs_shop_prices.shop_id = " . $building_id);
		$sell_price		= $db->loadResult();
		if ($player_money > $sell_price) {
			$player_money	= $player_money - $sell_price;
			$db->setQuery( "INSERT INTO #__jigs_inventory (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")"
			);

			$result		= $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
			$result2	= $db->query();
			$result3	='true';

			return $player_money;
		}
	}

	function buy_metal() 
	{
	
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$item			= JRequest::getvar(metal);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =" . $user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_shop_metal_prices 
		WHERE #__jigs_shop_metal_prices.item_id = " . $item . " 
		AND #__jigs_shop_metal_prices.shop_id = " . $building_id);
		$sell_price		= $db->loadResult();

		if ($player_money > $sell_price) {
			$player_money	= $player_money - $sell_price;
			$sql			= "INSERT INTO #__jigs_metals (player_id , item_id,quantity) 
			VALUES (" . $user->id . " , " . $item . ",1) 
			ON DUPLICATE KEY UPDATE quantity = quantity + 1";
			$db->setQuery($sql);
			$result			= $db->query();
			$sql			= "UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id;
			$db->setQuery($sql);
			$result2		= $db->query();
			$result3		= 'true';
	
			return $player_money;
		}
		
		return $player_money;
	}
	
		function buy_battery() {
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =" . $user->id);
		$player_money	= $db->loadResult();
		$sell_price		= 100;
		if ($player_money > $sell_price) {
			$player_money	= $player_money - $sell_price;
			$sql			= "INSERT INTO #__jigs_batteries (charge_percentage,capacity,id) VALUES (100,10,$user->id)";
			$db->setQuery($sql);
			$result			= $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
			$result2		= $db->query();
			$result3		= 'true';
			return $player_money;
		}
		return $player_money;
  }
  
  
  
  		function sell_battery() {
			$db					= JFactory::getDBO();
			$user				= JFactory::getUser();
			$building_id		= JRequest::getvar('building_id');
			$db->setQuery("SELECT money FROM #__jigs_players WHERE id =" . $user->id);
			$player_money		= $db->loadResult();
			$sell_price			= 90;
		
			$player_money	= $player_money + $sell_price;
			$sql2			= "Update #__jigs_batteries SET id = $building_id WHERE id = " . $user->id . " LIMIT 1";
			$db->setQuery($sql2);
			$result			= $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
			$result2		= $db->query();
			$result3		= 'true';
	
		return $sql2;
  }
			
			
		function get_batteries() {
			$db					= JFactory::getDBO();
			$user				= JFactory::getUser();
			$sql				= "SELECT * FROM #__jigs_batteries WHERE id =" . $user->id;
			$db->setQuery($sql);
			$result				= $db->loadRowlist();
			//return $sql;
			return $result;
  }
  
  		function use_energy($unit_to_deplete){
  		
  			$batteriesArray = $this->get_batteries();
  			foreach($batteriesArray as $battery){
  			
  				if($battery['capacity'] * ($battery['charge_precentage'] / 100)  >  $unit_to_deplete)
  				{  				
  					$x		= $battery['charge_precentage'] - $unit_to_deplete ;
  					$sql	= "UPDATE #__jigs_batteries SET charge_precentage = $x WHERE id = $battery['id']";
  					$db->setQuery($sql);
  					$db->query();
  					return;
  				
  				}
  			}
  		}
  
  
  
  
  
  
	function buy_weapon() {
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$item			= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =" . $user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_weapon_names WHERE #__jigs_weapon_names.id = " . $item );
		$sell_price		= $db->loadResult();
		if ($player_money > $sell_price) {
			$player_money	= $player_money - $sell_price;
			$db->setQuery( "INSERT INTO #__jigs_weapons (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")"
			);

			$result		= $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
			$result2	= $db->query();
			$result3	='true';
			return $player_money;
		}
	}

	function buy_crystals() {
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$item			= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_crystals WHERE #__jigs_crystals.id =".$item);
		$sell_price		= $db->loadResult();

		if ($player_money > $sell_price)
		{
			$player_money		= $player_money - $sell_price;
			$db->setQuery( "INSERT INTO #__jigs_crystals (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")");
			$result			= $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
			$result2		= $db->query();
			$result3		= 'true';	
			$result			= $db->loadRow();
			return $player_money;
		}
	}

	function buy_papers() {
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$item			= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_papers WHERE #__jigs_papers.id =".$item);
		$sell_price		= $db->loadResult();

		if ($player_money > $sell_price) {
			$player_money = $player_money - $sell_price;
				
			$db->setQuery( "INSERT INTO #__jigs_papers (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")"
			);
			$result			= $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
			$result2		= $db->query();
			$result3		='true';	$result = $db->loadRow();

			return $player_money;
		}
	}

	function buy_blueprints() {
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$item			= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_blueprints WHERE #__jigs_blueprints.id =".$item);
		$sell_price		= $db->loadResult();

		if ($player_money > $sell_price) {
			$player_money = $player_money - $sell_price;
			$db->setQuery( "INSERT INTO #__jigs_blueprints (user_id, object) VALUES ( $user->id  ,  $item )" );
			$result		= $db->query();
			$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
			$result2	= $db->query();
			return $player_money;
		}
	}



	function buy_building() {
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar(building_id);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT price FROM #__jigs_buildings WHERE #__jigs_buildings.id =".$building_id);
		$sell_price		= $db->loadResult();
		// If the Player has enough money
		if ($player_money >= $sell_price) {
				
			// player loses cost of building
			$player_money = $player_money - $sell_price;
			// player gets building
			$db->setQuery("UPDATE #__jigs_buildings SET owner = $user->id WHERE #__jigs_buildings.id = " . $building_id);
			$result = $db->query();
			// update new players cash in hand to database
			$db->setQuery("UPDATE #__jigs_players SET money = " . $player_money . " WHERE id = " . $user->id );
			$result2 = $db->query();
			$result3='true';


			//if the building is a farm set up or update the #__jig_fields database record for this building

			if ($type='farm'){

				$x=	"INSERT INTO #__jigs_fields (building, crops ) values  ($building_id,0) ON DUPLICATE KEY UPDATE crops = 0";
			}
			$db->setQuery( $x);
			$db->query();
			// $result = $db->loadRow();
			return $result;
		}
	}


	function sell() {

		$db						= JFactory::getDBO();
		$user					= JFactory::getUser();
		$building_id			= JRequest::getvar('building_id');
		$item					= JRequest::getvar('item');
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =".$user->id);
		$player_money			= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM #__jigs_shop_prices WHERE item_id = ". $item . " AND shop_id = " . $building_id );
		$buy_price				= $db->loadResult();
		$player_money			= $player_money + $buy_price;
		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
		$result2				= $db->query();
		$db->setQuery("DELETE FROM #__jigs_inventory WHERE #__jigs_inventory.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result					= $db->query();
		return $result;
	}

	function sell_metal() {
	
		$db 				= JFactory::getDBO();
		$user				= JFactory::getUser();
		$building_id		= JRequest::getvar('building_id');
		$item				= JRequest::getvar('metal');
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id = ".$user->id);
		$player_money		= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM #__jigs_shop_metal_prices WHERE item_id = ". $item . " AND shop_id = " . $building_id );
		$buy_price			= $db->loadResult();
		$player_money		= $player_money + $buy_price;
		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
		$result2			= $db->query();
		$sql				= "UPDATE #__jigs_metals SET quantity = quantity - 1 WHERE #__jigs_metals.player_id = " . $user->id . " AND item_id= $item ";
		$db->setQuery($sql);
		$result				= $db->query();
		return $result;
	}	
	
	
	function sell_weapon() {

		$db					= JFactory::getDBO();
		$user				= JFactory::getUser();
		$building_id		= JRequest::getvar('building_id');
		$item				= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =".$user->id);
		$player_money		= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM #__jigs_weapon_names WHERE id = ". $item );
		$buy_price			= $db->loadResult();
		$player_money		= $player_money + ($buy_price/2);
		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
		$result2			= $db->query();
		$db->setQuery("DELETE FROM  #__jigs_weapons WHERE #__jigs_weapons.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result				= $db->query();
		return $result;
	}


	function sell_crystals() {

		$db				= JFactory::getDBO();
		$user 			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$item			= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM #__jigs_crystal_prices WHERE #__jigs_crystal_prices.item_id =".$item);
		$buy_price		= $db->loadResult();
		$player_money 	= $player_money + $buy_price;
		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
		$result2		= $db->query();
		$db->setQuery("DELETE FROM  #__jigs_crystals WHERE #__jigs_crystals.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result			= $db->query();
		return $result;

	}
	function sell_papers() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$item			= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM #__jigs_players WHERE id =".$user->id);
		$player_money	= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM #__jigs_papers WHERE #__jigs_papers.id =".$item);
		$buy_price		= $db->loadResult();
		$player_money	= $player_money + $buy_price;
		$db->setQuery("UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id );
		$result2		= $db->query();
		$db->setQuery("DELETE FROM #__jigs_papers WHERE #__jigs_papers.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result			= $db->query();
		return $result;

	}



	function get_shop_inventory() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_shop_prices.item_id, " .
				"#__jigs_objects.name, " .
				"#__jigs_shop_prices.sell_price " .
				"FROM #__jigs_shop_prices " .
				"LEFT JOIN #__jigs_objects " .
				"ON #__jigs_shop_prices.item_id = #__jigs_objects.id " .
				"WHERE #__jigs_shop_prices.shop_id =" . $building_id);
		$result			= $db->loadAssocList();
		return $result;
	}
	
	function get_shop_metals() {
		
		$db				= JFactory::getDBO();
		$building_id	= JRequest::getvar('building_id');
		$query 			= "
	SELECT #__jigs_shop_metal_prices.item_id, #__jigs_metal_names.name, #__jigs_shop_metal_prices.sell_price
	FROM #__jigs_shop_metal_prices
	LEFT JOIN #__jigs_metals ON #__jigs_shop_metal_prices.item_id = #__jigs_metals.id
	LEFT JOIN #__jigs_metal_names ON #__jigs_metal_names.id = #__jigs_shop_metal_prices.item_id
	WHERE #__jigs_shop_metal_prices.shop_id = $building_id";
		$db->setQuery($query);
		$result			= $db->loadAssocList();
		return $result;
	}
	

	

	function get_shop_crystals() {

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$building_id	= JRequest::getvar('building_id');
		$db->setQuery("SELECT #__jigs_crystal_prices.item_id, " .
			      "#__jigs_crystal_names.name, " .
		   		  "#__jigs_crystal_prices.sell_price " . 
			      "FROM #__jigs_crystal_prices " .
		    	  "LEFT JOIN  #__jigs_crystal_names " .
				  "ON #__jigs_crystal_prices.item_id = #__jigs_crystal_names.id " .
				  "WHERE #__jigs_crystal_prices.shop_id =" . $building_id);
		$result			= $db->loadAssocList();
		return $result;
	}



	function work_field()
	{
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$field			= JRequest::getvar('field');
		$building_id	= JRequest::getvar('building_id');
		$now			= time();
		$finished		= $now + 50;
		
		
		
		//$crop	= JRequest::getvar('crop');
		$query			= "SELECT status,crop FROM #__jigs_farms  WHERE building =" . $building_id . " AND field =" . $field;
		$db->setQuery($query);
		$result			= $db->loadRowList();
		
		$status			= $result[0][0];
		$crop			= $result[0][1];
		$status++;
		
		$sql			= "INSERT INTO #__jigs_farms (building,field, status,timestamp, crop,finished ) " .  " 
						values  ($building_id,$field, $status,$now , $crop, $finished) 
						ON DUPLICATE KEY UPDATE status =  $status ,timestamp = $now,  crop = $crop , finished = $finished ";

		$db->setQuery($sql);
		if(!$db->query())
			{
			$message="error";
			return $query;
			}
			else{
			return true;
		}
	}




	function heartbeat(){
		$result_1		= $this->check_factories();
		$result_2		= $this->check_mines();
		$result_4		= $this->check_farms();
		$result_3		= $this->respawn();
		$result			= $this->get_players();
		
		return $result;
	}


	function get_players(){
		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM #__jigs_players WHERE id =".$user->id);
		$result		= $db->loadRow();
		$map		= $result[0];
		$grid		= $result[1];
		$db->setQuery("SELECT
				#__jigs_players.id, 
				#__jigs_players.posx, 
				#__jigs_players.posy, 
				#__comprofiler.avatar
				FROM #__jigs_players 
				LEFT JOIN #__comprofiler ON #__jigs_players.id = #__comprofiler.user_id
				WHERE grid ='".$grid."' AND map='".$map."' AND #__jigs_players.id !='".$user->id."'
							");

		$result		= $db->loadAssocList();

		return $result;
	}

	// Called by JiGS.js.php via JSON On successful call the player is moved by mootools
	function save_coordinate() {
		$db			= JFactory::getDBO();

		$user		= JFactory::getUser();
		$posx		= JRequest::getvar('posx');
		$posy		= JRequest::getvar('posy');
		$map		= JRequest::getvar('map');
		$grid		= JRequest::getvar('grid');
		$db->setQuery("UPDATE #__jigs_players SET posx='".$posx."',posy='".$posy."',map='".$map."',grid='".$grid."'  WHERE id ='".$user->id."'");
		$db->query();
		$result		='success';
		return $result;
	}


	function respawn(){
		$db			= JFactory::getDBO();
		$db->setQuery("SELECT id from #__jigs_characters WHERE empty = 1");
		$db->query();
		$result		= $db->loadResultArray();
		Foreach ($result as $row){
			$number_of_items = rand(1,3);
			for ($i=0 ;$i<$number_of_items;$i++){
				$item_id= rand(1, 15);
				$db->setQuery("INSERT INTO #__jigs_inventory (item_id, player_id ) VALUES (" . $item_id . " ,  " .  $row  . ")");
				$db->query();
			}
			$db->setQuery("UPDATE #__jigs_characters SET empty = 0 WHERE id = " .  $row );
			$db->query();
		}
		$now		= time();
		$db->setQuery("UPDATE #__jigs_characters SET active= 1, time_killed=0,  health= 100  WHERE  #__jigs_characters.time_killed < (" . $now . "- (1 * 60)) AND #__jigs_characters.time_killed !=0");#
		$db->query();
	}


	function attack_playa()
	{

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$player_id		= JRequest::getvar('player');

		$user2			= JFactory::getUser($player_id);
		$player_dice	= rand(0, 15);
		$player2_dice	=rand(0, 5);
		$db->setQuery("SELECT health,money,active FROM #__jigs_players WHERE id = ".$user->id);
		$result			= $db->loadRow();
		$player_health	= $result[0];
		$player_money	= $result[1];
		$player_status	= $result[2];		
		$db->setQuery("SELECT health,money,active FROM #__jigs_players WHERE id = ".$player_id);
		$result			= $db->loadRow();
		$char_health	= $result[0];
		$char_money		= $result[1];
		$char_status	= $result[2];		
		
		
		if ($char_status!=1)
		{
			$message="This player is inactive. You cannot attack this player at this time<br/>";
		}
			
		elseif ($player_status !=1)
		{
				
			$message="You are inactive. You cannot attack players at this time<br/>";
				
		}
			
		else// roll the dice and let the games begin
		{

			if ($player_dice > $player2_dice)
			{
				$player_health	= $player_health -1;
				$char_health	= $char_health-30;
				$message		= "You attacked " . $user2->username . " and inflicted 30 point of damage<br/>";
			}
			else
			 {
			$player_health	= $player_health - 1;
			$message		= "You attacked " . $user2->username . " and missed. " . $user2->username . " retaliated and inflicted 10 points of damage.<br/>";
			$char_health	= $char_health + 10;
			}

			if ($char_health == 0 || $char_health < 0) 
			{
				$now=time();
				$message	= "You put " . $user2->username . " into hospital<br/>";
				$player_m	= $player_m + $char_m ;
				$char_m		= 0;
				$db->setQuery("UPDATE #__jigs_players SET active = 3,  grid=1, map= 3, posx = 4, posy=5, empty= 1 , time_killed = " . $now . " WHERE id ='".$player_id."'");
				$db->query();
				$db->setQuery("UPDATE #__jigs_inventory SET #__jigs_inventory.player_id = " . $user->id . " WHERE #__jigs_inventory.player_id = " . $player_id );
				$result = $db->query();
				$db->setQuery("UPDATE #__jigs_players SET nbr_kills=nbr_kills+1, money = $player_m WHERE #__jigs_players.id = " .  $user->id ) ;
				$result = $db->query();
				$db->setQuery("UPDATE #__jigs_players SET money = $char_m WHERE #__jigs_players.id = " .  $player_id ) ;
				$result = $db->query();
///////////////////////
				$text= 'Citizen ' .  $user2->username  . ' was hospitalised by citizen ' . $user->username ;
				$this->sendWavyLines($text);

/////////////////////////////////
			}
			$db->setQuery("UPDATE #__jigs_players SET health='".$player_v."'  WHERE id ='".$user->id."'");
			$db->query();
			$db->setQuery("UPDATE #__jigs_players SET health='".$char_v."'  WHERE id ='".$player_id."'");
			$db->query();
		}
		$results[0]	= $player_health;
		$results[1]	= $char_health;
		$results[2]	= $message;
		$this->sendFeedback($user->id,$message);

		return $results;

	}
	
	
	function attack() 
	{

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$character_id	= JRequest::getInt('character');
		$sql= "SELECT id, health, money, final_attack, final_defence, ammunition FROM #__jigs_players WHERE id = " . $user->id;
		$db->setQuery($sql);
		$player			= $db->loadObject();
		$player->dice = rand(0, 15);

		$db->setQuery("SELECT id, name, health, money FROM #__jigs_characters WHERE id =" . $character_id);
		$npc = $db->loadObject();
		
		$npc->dice=rand(0, 5);
		$attack_type = JRequest::getCmd('type');

		switch ($attack_type) {
///// If Player shoots test shooting skills + speed + dexterity against NPCs speed //////////////
			case 'shoot':

				if ($player->dice > $npc->dice)
				{
					
					$npc->health	= intval($npc->health - 10);
					$attack_message	= "You shoot " . $npc->name . " and inflict 30 damage points to his health<br/>";
				}
				else{
					$attack_message	= "You shoot " . $npc->name . " and miss.";
				}
				$player->ammunition--;
				break;
//====== If Player kicks, test kicking and other fighting skills + speed + dexterity against NPCs speed ////////
			case 'kick':
				if ($player->dice > $npc->dice){
					$npc->health	= intval($npc->health - 10);
					$attack_message	= "You kick " . $npc->name . "and inflict 30 damage points to his health<br/>";
				}
				else {
					
					$player->health		=	intval($player->health - 10);
					$attack_message	=	"You kick " . $npc->name . "and miss and incur 10 damage points to your health<br/>";
				}
				break;

		/////////////////// If Player punches, test punch and other fighting skills + speed + dexterity against NPCs speed ////////////////////////////////
			case 'punch':
				if ($player->dice >= $npc->dice){
		
					$npc->health	=	intval($npc->health - 20);
					$attack_message	= "You punch " . $npc->name . "and inflict 30 damage points to his health<br/>";
				}
				else {
					
					$player->health	= intval($player->health - 10);
					$attack_message	= "You punch " . $npc->name . "and miss and incur 10 damage points to your health<br/>";
				}
				break;
		}
		////////////////////////////////////////// If NPC is dead ////////////////////////////////////

		if ($npc->health <= 0) {
			$npc->health	= 0;
			$this->dead_npc($npc);
		}
		
		////////////////////////////////////////// If Player is dead ////////////////////////////////////
				
		if ($player->health <= 0) {
			$player->health = 0;
			$this->dead_player($npc->name);		
		}
		
		/////////////////////////////////////// Now update everybodys stats to database //////////////////

		$sql = "UPDATE #__jigs_players SET health = $player->health, ammunition = $player->ammunition WHERE id = $user->id ";
		$db->setQuery($sql);
		$db->query();
	
		$sql = "UPDATE #__jigs_characters SET health = $npc->health WHERE id = $npc->id";
		$db->setQuery($sql);
		$db->query();
	
		/////////////////////////////////////////////////////////////////////////////////////////////////

		$this->sendFeedback($player->id,$attack_message);
		
		$result[0]	= $player;
		$result[1]	= $npc;
		$result[2]  = $attack_message;
		return $result;
	
	}
	
	function dead_npc($npc)
	{
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();	
		$now			= time();
		$sql			= "UPDATE #__jigs_characters
		SET active = 0, empty = 1 , time_killed = $now WHERE id  = $npc->id";
		$db->setQuery($sql);
		$db->query();
		$sql			= "UPDATE #__jigs_inventory
		SET #__jigs_inventory.player_id = $user->id WHERE #__jigs_inventory.player_id = $npc->id";
		$db->setQuery($sql);
		$db->query();
	//// Update specific and General stats and payout when applicable
		
		$xp_type		= 'nbr_kills';
		$this->increment_xp($xp_type, $npc->money,$user->id);
	
		$text = 'Citizen ' . $npc->name . ' was killed by citizen ' . $user->username ;
		$this->sendWavyLines($text);
		$this->sendFeedback($user->id,$text);	
		return $text;
	}
	

	
	
	function dead_player($winner)
	{
		$user			= JFactory::getUser();
		$db				= JFactory::getDBO();		
		$now			= time();
		$db->setQuery("UPDATE #__jigs_players SET active = 3,  grid=1, map= 3, posx = 4, posy=5, empty= 1 , time_killed = " . $now . " 
				WHERE id ='".$user->id."'");
		$result			= $db->query();
		
		$db->setQuery("UPDATE #__jigs_inventory SET #__jigs_inventory.player_id = $winner WHERE #__jigs_inventory.player_id = " . $user->id );
		$result			= $db->query();
		
		$db->setQuery("UPDATE #__jigs_players SET money = 0 WHERE #__jigs_players.id = " .   $user->id ) ;
		$result			= $db->query();
		
		$text= 'Citizen ' .  $user->username  . ' was put in hospital by ' . $winner ;
		$this->sendWavyLines($text);
		return;
	}

	function increment_xp($xp_type ,$payment,$user_id)
	{

		$db =& JFactory::getDBO();
		$query="UPDATE #__jigs_players SET $xp_type  = $xp_type  +1, xp = xp+1, money = money + " . $payment ." WHERE #__jigs_players.id = " .  $user_id;
		$db->setQuery($query);
		$db->query();

		$this->test_level($user_id);


		return $query;
	}


	function test_level($user_id){
		$user		= JFactory::getUser();
		$db			= JFactory::getDBO();
		$now		= time();
		$query		= "SELECT xp FROM #__jigs_players where id = $user_id";
		$db->setQuery($query);
		$xp			= $db->loadResult();
		$milestones = array(100,200,400,800,1600,2000,4000,8000);

		foreach ($milestones as $check)
		{

			if ($xp == $check)
			{
				$query		= "UPDATE #__jigs_players SET level=level+1, statpoints = statpoints + 5 WHERE id = $user_id";
				$db->setQuery($query);
				$db->query();
				$text		= 'Citizen ' . $user->username . ' leveled up';
				$this->sendWavyLines($text);
				$this->sendFeedback($user->id,$text);
				
			}
		}
	}


	function swap() 
	{

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$weapon_id		= JRequest::getvar(weapon_id);
		$db->setQuery("UPDATE #__jigs_players SET id_weapon = '" . $weapon_id . "' WHERE id =".$user->id);
		$db->query();
		$result			= $weapon_id ;
		return $result;
	}

	function get_mines($building_id)
	{
		$user		= JFactory::getUser();
		//	$result = array() ;
		$now		= time();
		$db			= JFactory::getDBO();
		$query		="SELECT * FROM `#__jigs_mines` WHERE `building_id` =" . $building_id;
		$db->setQuery($query);
		$result		= $db->loadAssoc();
		$payment	= 100;
		$type		= $result['type'];
		$name		= $user->id;
		if (($result[timestamp] > 0) && ($now-$result[timestamp] > 50))
		{
			$query	= "UPDATE #__jigs_mines SET timestamp = 0 WHERE building_id = " . $building_id;
			$db->setQuery($query);
			$db->query();
			$result[timestamp] = 0;
			if ($type==1)
			{
				$type_crystal	= rand( 1 , 30 ) ;
				$query			= "INSERT INTO #__jigs_crystals (player_id , item_id, quantity )
									VALUES($name ,$type_crystal, 1)
									ON DUPLICATE KEY 
									UPDATE `quantity` = `quantity` + 1";
				
				$db->setQuery($query);
				$db->query();
			}
			if ($type==2)
			{
				$type_metal			= rand( 1 , 60 ) ; //30 limit see next line
				if ($type_metal >30)
				{
					$type_metal 	= 1; // this is to increase the chances that carbon will be excavated.
				};
				$query			= "INSERT INTO #__jigs_metals (player_id , item_id, quantity )
									VALUES( $name ,$type_metal, 1) 
									ON DUPLICATE KEY 
									UPDATE quantity = quantity + 1";
				$db->setQuery($query);
				$db->query();
			}
			else
			{
				$query_1		= "SELECT money` FROM #__jigs_players WHERE id = '$user->id'";
				$db->setQuery($query_1);
				$money_saved	= $db->loadResult();
				$money	= $money_saved + $payment;
				$x				=	"Update #__jigs_players SET `money` = $money WHERE id= " . $user->id;
				$db->setQuery($x);
				$db->query();
			}
			}
			//exit();
			$result[now] = date('l jS \of F Y h:i:s A',$now);
			$result[since] = date('l jS \of F Y h:i:s A',$result[timestamp]);
			$result[elapsed] = (int)(($now-$result[timestamp]));
			$result[remaining]=(int)(50-((($now-$result[timestamp]))));
			return $result;
	}

	function mine()
	{
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$type			= JRequest::getvar(type);
		$building_id	= JRequest::getvar(building_id);
		$now			= time();
		$query			= "INSERT INTO #__jigs_mines (building_id, type, timestamp )
							values  ($building_id,$type,$now) 
							ON DUPLICATE KEY 
							UPDATE type =  $type , timestamp = " . $now;
		$db->setQuery($query);
		$db->query();
		$result[0]		= $type;
		$result[1]		= $now;
		return $result;
	}



	function work_turbine()
	{
		$building_id		= JRequest::getvar(building_id);
		$line				= JRequest::getvar(line);
		$type				= JRequest::getvar(type);
		$quantity			= JRequest::getvar(quantity);
		$model				= $this->getModel('building');
		$result				= $model->work_turbine($building_id,$line,$type,$quantity);
		return $result;
	}



	function deposit()
	{
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$qty			= JRequest::getvar(amount);
		$building_id	= JRequest::getvar(building_id);
		$now			= time();
		$db->setQuery("Select money, bank FROM #__jigs_players WHERE id = " . $user->id);
		$result			= $db->loadRow();
		$money			= $result[0];
		$bank			= $result[1];
		if ($qty <= $money){
			$money = $money - $qty;
			$bank = $bank + $qty;
			$query = "UPDATE #__jigs_players SET money = $money, bank = $bank  WHERE id = " . $user->id;
			$db->setQuery($query);
			$db->query();
		}
		return $result;
	}


	function withdraw()
	{

		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$qty			= JRequest::getvar(amount);
		$building_id	= JRequest::getvar(building_id);
		$now			= time();
		$db->setQuery("Select money, bank FROM #__jigs_players WHERE id = ".$user->id);
		$result			= $db->loadRow();
		$money			= $result[0];
		$bank			= $result[1];

		if ($qty <= $bank){
			$money		= $money + $qty;
			$bank		= $bank - $qty;
			$query		= "UPDATE #__jigs_players SET money = $money, bank = $bank  WHERE id =" . $user->id;
			$db->setQuery($query);
			$db->query();
		}
		return $result;
	}

	function sell_crops() 
	{

		$total_crops	= $this->get_total_crops();
		$payment		= $total_crops * 1000 ;
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$query_1		= "SELECT money FROM #__jigs_players WHERE id = ' . $user->id . '";
		$db->setQuery($query_1);
		$money_saved	= $db->loadResult();
		$xp_type		= 'nbr_crops';
		$test			= $this->increment_xp($xp_type ,$payment,$user->id);
		$text			= $user->name . " has sold " . $total_crops . " crops.";
		$this->sendWavyLines($text);
		$query_2		= "Update #__jigs_farms LEFT JOIN #__jigs_buildings on #__jigs_farms.building = #__jigs_buildings.id SET total = 0 WHERE #__jigs_buildings.owner = $user->id";
		$db->setQuery($query_2);
		$db->query();

		return($test);

	}

	function get_total_crops()
	{

		$total_crop 	= 0;
		$db				= JFactory::getDBO();
		$user			= JFactory::getUser();
		$query			= "SELECT total FROM #__jigs_farms 
							LEFT JOIN #__jigs_buildings 
							ON #__jigs_farms.building = #__jigs_buildings.id 
							WHERE #__jigs_buildings.owner = $user->id; ";
		$db->setQuery($query);
		$result			= $db->loadResultArray();
		foreach($result as $row)
		{
			$total_crop = $total_crop + $row;
		}
		return ($total_crop);
	}

	function check_mines()
	{
		$user			= JFactory::getUser();
		$now			= time();
		$db				= JFactory::getDBO();
		$duration		= $now - 50;

		$query			= "SELECT #__jigs_mines.building_id,
	                    #__jigs_mines.type, 
	                    #__jigs_mines.timestamp, 
	                    #__jigs_buildings.owner 
					FROM #__jigs_mines 
					LEFT JOIN #__jigs_buildings 
					ON #__jigs_mines.building_id = #__jigs_buildings.id 
					WHERE timestamp!=0 && timestamp < " . $duration;

		$db->setQuery($query);
		$result			= $db->loadObjectlist();
		$payment		= 100;

		foreach ($result as $row){

			$playa = & JFactory::getUser($row->owner);
			$playa_name = $playa->username;
			$playa_id = $playa->id;

			if ($row->type==1){
				$type_crystal		= rand( 1 , 30 );
				$query = "INSERT INTO #__jigs_crystals (player_id , item_id, quantity )
						VALUES($row->owner ,$type_crystal, 1) 
						ON DUPLICATE KEY UPDATE quantity = quantity + 1";
				$db->setQuery($query);
				$db->query();
				$text	= 'Citizen ' . $playa_name  . ' has mined 1 unit of crystal:' . $type_crystal ;
				$text2= 'You mined 1 unit of crystal:<br/>' ;
			}
			if ($row->type==2){
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
				$text	= 'Citizen ' . $playa_name  . ' has mined 1 unit of metal:' . $type_metal ;
				$text2	= 'You mined 1 unit of metal:<br/>' ;	
			}
			else
			{
					
				$query_1 ="SELECT money FROM #__jigs_players WHERE id = '$row->owner'";
				$db->setQuery($query_1);
				$money_saved = $db->loadResult();
				$money= $money_saved + $payment;
				$x=	"Update #__jigs_players SET money = $money WHERE id = " . $row->owner;
				$db->setQuery($x);
				$db->query();
				$text	= 'Citizen ' . $playa_name  . ' has mined 1 unit of oil:' ;
				$text2	= 'You mined 1 unit of oil:<br/>' ;
				$this->sendFeedback($playa_id, $text2);
				$this->sendWavyLines($text);
				$xp_type		= 'nbr_drills';
				$test			= $this->increment_xp($xp_type ,0,$row->owner);
			}
		$query	= "UPDATE #__jigs_mines SET timestamp = 0 WHERE timestamp < ". $duration;
		$db->setQuery($query);
		$db->query();

		return ;
	}

		function sendWavyLines($text)
		{
			jimport( 'joomla.application.component.helper' );
			jimport( 'joomla.html.parameter' );

			$component		= JComponentHelper::getComponent( 'com_battle' );
			$params			= new JParameter( $component->params );
			$sbid			= $params->get( 'shoutbox_category' );

			$db			= JFactory::getDBO();
			$now		= time();
			$sql		= "INSERT INTO #__shoutbox (name, time,sbid, text) VALUES ('Wavy Lines:', $now,$sbid, '$text' )";
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



	function check_mine()
	{

		$now					= time();
		$building_id			= JRequest::getvar('building_id');
		$user					= JFactory::getUser();
		$db						= JFactory::getDBO();
		$query					="SELECT timestamp FROM #__jigs_mines WHERE building_id = $building_id";
		$db->setQuery($query);
		$result['timestamp']	= $db->loadResult();
		$result['now']			= date('l jS \of F Y h:i:s A',$now);
		$result['since']		= date('l jS \of F Y h:i:s A',$result['timestamp']);
		$result['elapsed']		= (int)(($now-$result['timestamp']));
		$result['remaining']	= (int)(50-((($now-$result['timestamp']))));
		return $result;
	}
	
	function check_farms()
	{

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
				if ($row->status >= 6)
				{
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
	
	function check_factories()
	{

		$user 		= JFactory::getUser();
		$now		=	 time();
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
			$quantity = $row->quantity;
			for ($i=1;$i <= $quantity ;$i++){
			
			$query1				= "INSERT INTO #__jigs_inventory (player_id , item_id) VALUES ($row->owner ,$row->type)";
			$db->setQuery($query1);
			$db->query();
			$xp_type			= 'nbr_objs';
			$increment			= $this->increment_xp($xp_type ,0,$row->owner);

			// send wavy lines

			$playa			= JFactory::getUser($row->owner);
			$playa_name		= $playa->username;
			$playa_id		= $playa->id;
			$text			= 'Citizen ' . $playa_name  . ' has created 1 ' . $row->name ;
			$this->sendWavyLines($text);
			$this->sendFeedback($playa_id ,$text);
			// end wavy lines
			
			}
		}
		// Now Simply reset all factories where remainging time is less that zero
		$query="UPDATE #__jigs_factories SET timestamp = 0,finished = 0 WHERE finished !=0 AND finished < " . $now;
		$db->setQuery($query);
		$db->query();
		}// end if

		return $query;
	}
	
	
	
	function check_farm()
	{
		$building_id		= JRequest::getvar('building');
		$field_id		= JRequest::getvar('field');
		//$user =& JFactory::getUser();
		$now			= time();
		$db			= JFactory::getDBO();
		$query			= "SELECT status,timestamp,finished 
						FROM #__jigs_farms 
						WHERE building = $building_id 
						AND field = $field_id";
		$db->setQuery($query);
		$result			= $db->loadAssoc();
		$result['now']		= date('l jS \of F Y h:i:s A',$now);
		$result['since']	= date('l jS \of F Y h:i:s A',$result['timestamp']);
		$result['elapsed']	= (int)(($now-$result['timestamp']));
		$result['remaining']	= (int)($result['finished'] - $now );
		$result['status']	= (int)($result['status']);
		$result['field']	= $field_id;
		
		return $result;
	
	}
	

	function check_factory($building_id,$line_id)
	{
		$building_id		= JRequest::getvar('building');
		$line_id			= JRequest::getvar('line');
		//$user =& JFactory::getUser();
		$now				= time();
		$db					=& JFactory::getDBO();
		$query				="SELECT timestamp,finished FROM #__jigs_factories WHERE building = $building_id AND line = $line_id";
		$db->setQuery($query);
		$result				= $db->loadAssoc();
		$result['now']		= date('l jS \of F Y h:i:s A',$now);
		$result['since']	= date('l jS \of F Y h:i:s A',$result['timestamp']);
		$result['elapsed']	= (int)(($now-$result['timestamp']));
		$result['remaining']=(int)($result['finished'] - $now );
		return $result;
	}

}
