<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModeljigs extends JModel{

	function get_cells(){

		$map = JRequest::getvar('map');
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT row0,row1,row2,row3,row4,row5,row6,row7 FROM jos_jigs_maps WHERE id = ".$map);
		$result = $db->loadAssocList();
		return $result;

	}

	function get_portals(){

		$map = JRequest::getvar('map');
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT * FROM jos_jigs_portals WHERE from_map =" . $map);
		$result = $db->loadAssocList();
		return $result;
	}



	function add_message($message_id){

		$db =& JFactory::getDBO();
		$message_id=int($message_id);
		$user =& JFactory::getUser();
		$db->setQuery("SELECT  messages FROM jos_jigs_players WHERE iduser =".$user->id);
		$result = $db->loadAssocList();

		array_unshift ( $result , $message_id);
		$db->setQuery( "UPDATE  jos_jigs_players SET messages = $message WHERE iduser =".$user->id);
		$result = $db->query();
		return $result;

	}

	function get_messages(){
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT messages FROM jos_jigs_players WHERE iduser =".$user->id);
		$result = $db->loadResult();
		$result = explode(',',$result);

		foreach ($result as $message_id){
			$db->setQuery("SELECT string FROM jos_jigs_messages WHERE id =" . $message_id);
			$message_list[] = $db->loadResult();
		}

		return $message_list;
	}

	function get_stats() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$test = self::set_final_stats();
		$db->setQuery("
		SELECT level, health, strength, intelligence,speed, posx, posy, xp, money, bank, defence, final_defence, attack, final_attack, nbr_attacks, nbr_kills
		FROM jos_jigs_players 
		WHERE iduser =".$user->id);
		$result = $db->loadAssocList();
		return $result;
	}


	function get_player() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$test = self::set_final_stats();
		$db->setQuery("
		SELECT posx, posy, xp, grid, map
		FROM jos_jigs_players WHERE iduser =".$user->id);
		$result = $db->loadAssocList();
		return $result;
	}






	function set_final_stats() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("Select attack, defence FROM  jos_jigs_players WHERE iduser =".$user->id);
		$db->query();
		$result = $db->loadRow();
		$attack=$result[0];
		$defence=$result[1];
		$db->setQuery("
		Select jos_jigs_weapon_names.attack, jos_jigs_weapon_names.defence FROM jos_jigs_players
		LEFT JOIN jos_jigs_weapon_names
		ON jos_jigs_players.id_weapon = jos_jigs_weapon_names.id
		WHERE iduser =".$user->id);
		$db->query();
		$result = $db->loadRow();
		$weapon_attack=$result[0];
		$weapon_defence=$result[1];
		$final_attack	=	$attack + $weapon_attack;
		$final_defence	=	$defence + $weapon_defence;
		$db->setQuery("UPDATE jos_jigs_players SET final_attack = '" . $final_attack. "', final_defence = '" . $final_defence . "'WHERE iduser =".$user->id);
		$db->query();
		return ($result);
	}

	function leave_room(){
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$query = "Update jos_jigs_players SET active=1 WHERE iduser = $user->id";
		$db->setQuery($query);
		$db->query();
		return true;
	}


	function get_papers() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT jos_jigs_papers.item_id, jos_jigs_paper_names.name, jos_jigs_papers.buy_price " .
			"FROM jos_jigs_papers " .
			"LEFT JOIN jos_jigs_paper_names " .
			"ON jos_jigs_papers.item_id = jos_jigs_paper_names.id " .
			"WHERE jos_jigs_papers.player_id =".$user->id);
		$result = $db->loadAssocList();
		return $result;

	}


	function get_shop_papers() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT jos_jigs_papers.item_id, " .
				"jos_jigs_papers.sell_price, " . 
				"jos_jigs_paper_names.name " .
				"FROM jos_jigs_papers LEFT JOIN  jos_jigs_paper_names ON jos_jigs_papers.item_id = jos_jigs_paper_names.id " .
				"WHERE jos_jigs_papers.player_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;

	}

	function get_blueprints() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT jos_jigs_blueprints.id, jos_jigs_objects.name " .
			"FROM jos_jigs_blueprints " .
			"LEFT JOIN jos_jigs_objects " .
			"ON jos_jigs_blueprints.object = jos_jigs_objects.id " .
			"WHERE jos_jigs_blueprints.user_id =".$user->id);
		$result = $db->loadAssocList();
		return $result;

	}

	function get_shop_blueprints() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT jos_jigs_blueprints.object, " .
				"jos_jigs_blueprints.sell_price, " . 
				"jos_jigs_objects.name " .
				"FROM jos_jigs_blueprints LEFT JOIN  jos_jigs_objects ON jos_jigs_blueprints.object = jos_jigs_objects.id " .
				"WHERE jos_jigs_blueprints.user_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;

	}


	function get_shop_clothing() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT jos_jigs_clothing.item_id, " .
				"jos_jigs_clothing.sell_price, " . 
				"jos_jigs_clothing_names.name " .
				"FROM jos_jigs_clothing LEFT JOIN  jos_jigs_clothing_names ON jos_jigs_clothing.item_id = jos_jigs_clothing_names.id " .
				"WHERE jos_jigs_clothing.player_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;

	}

	function get_shop_spells() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT jos_jigs_spells.item_id, " .
				"jos_jigs_spells.sell_price, " . 
				"jos_jigs_spell_names.name " .
				"FROM jos_jigs_spells LEFT JOIN  jos_jigs_spell_names ON jos_jigs_spells.item_id = jos_jigs_spell_names.id " .
				"WHERE jos_jigs_spells.player_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;
	}

	function get_shop_weapons() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT jos_jigs_weapons.item_id, " .
				"jos_jigs_weapon_names.sell_price, " . 
				"jos_jigs_weapon_names.name " .
				"FROM jos_jigs_weapons LEFT JOIN  jos_jigs_weapon_names ON jos_jigs_weapons.item_id = jos_jigs_weapon_names.id " .
				"WHERE jos_jigs_weapons.player_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;
	}


	function get_inventory() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT jos_jigs_inventory.item_id, " .
				"jos_jigs_objects.name, " .
				"jos_jigs_shop_prices.buy_price " .
				"FROM jos_jigs_inventory " .

               "LEFT JOIN jos_jigs_objects " .
				"ON jos_jigs_inventory.item_id = jos_jigs_objects.id " .

                "LEFT JOIN jos_jigs_shop_prices " .
				"ON jos_jigs_inventory.item_id = jos_jigs_shop_prices.item_id " .

				"WHERE jos_jigs_inventory.player_id = ". $user->id .
				" AND jos_jigs_shop_prices.shop_id = " . $building_id ."
				");
		$result = $db->loadAssocList();
		return $result;
	}

	function get_crystals() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT jos_jigs_crystals.item_id, " .

		              "jos_jigs_crystal_names.name, " .
	                  "jos_jigs_crystal_prices.buy_price " .
				      "FROM jos_jigs_crystals " .

				      "LEFT JOIN jos_jigs_crystal_names " .
				      "ON jos_jigs_crystals.item_id = jos_jigs_crystal_names.id " .

				      "LEFT JOIN jos_jigs_crystal_prices " .
				      "ON jos_jigs_crystals.item_id = jos_jigs_crystal_prices.item_id " .

			       	  "WHERE jos_jigs_crystals.player_id = " . $user->id .
				      " AND jos_jigs_crystal_prices.shop_id = " . $building_id);

		$result = $db->loadAssocList();
		return $result;
	}



	function get_inventory2() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT jos_jigs_inventory.item_id, " .
				"jos_jigs_objects.name " .
				"FROM jos_jigs_inventory " .
               	"LEFT JOIN jos_jigs_objects " .
				"ON jos_jigs_inventory.item_id = jos_jigs_objects.id " .
				"WHERE jos_jigs_inventory.player_id = ". $user->id  

		);
		$result = $db->loadAssocList();
		return $result;
	}





	function get_metals2() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT jos_jigs_metals.item_id, " .
			  "jos_jigs_metals.quantity, " .
		"jos_jigs_metal_names.name " .

				"FROM jos_jigs_metals " .
				"LEFT JOIN  jos_jigs_metal_names " .
				"ON jos_jigs_metals.item_id = jos_jigs_metal_names.id " .
				"WHERE jos_jigs_metals.player_id =" . $user->id);
		$result = $db->loadAssocList();
		return $result;
	}

	function get_crystals2() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT jos_jigs_crystals.item_id, " .
		"jos_jigs_crystal_names.name, jos_jigs_crystals.quantity " .

				"FROM jos_jigs_crystals " .
				"LEFT JOIN  jos_jigs_crystal_names " .
				"ON jos_jigs_crystals.item_id = jos_jigs_crystal_names.id " .
				"WHERE jos_jigs_crystals.player_id =" . $user->id);
		$result = $db->loadAssocList();
		return $result;
	}


	function get_drugs() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT * " .
				"FROM jos_jigs_drugs " .
				"WHERE jos_jigs_drugs.iduser =".$user->id);
		$result = $db->loadRow();
		return $result;
	}

	function get_skills() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT * FROM jos_jigs_skills WHERE jos_jigs_skills.iduser =".$user->id);
		$result1 = $db->loadObject();
		for ($i= 1;$i< 9;$i++){
			$db->setQuery("SELECT name FROM jos_jigs_skill_names WHERE jos_jigs_skill_names.id = '". $result1->skill_ . $i ."'" );
			$result = $db->loadresult();
			$all[$i] =	$result;
		}
		return $all ;
	}


	function get_clothing() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT jos_jigs_clothing.item_id, jos_jigs_clothing_names.name " .
						"FROM jos_jigs_clothing " .
						"LEFT JOIN jos_jigs_clothing_names ON jos_jigs_clothing.item_id =  jos_jigs_clothing_names.id " .
				"WHERE jos_jigs_clothing.player_id =".$user->id);
		$result = $db->loadAssocList();
		return $result;
	}

	function get_weapon() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$char= 62;
		$db->setQuery("SELECT jos_jigs_weapon_names.* " .

				" FROM jos_jigs_players " .
						"LEFT JOIN jos_jigs_weapon_names ON jos_jigs_players.id_weapon = jos_jigs_weapon_names.id " .
						"WHERE jos_jigs_players.iduser = " . $user->id);
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


	function get_weapons() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT jos_jigs_weapons.item_id, jos_jigs_weapon_names.name, jos_jigs_weapon_names.sell_price " .
						" FROM jos_jigs_weapons " .
						" LEFT JOIN jos_jigs_weapon_names ON jos_jigs_weapons.item_id =  jos_jigs_weapon_names.id " .
				"WHERE jos_jigs_weapons.player_id =".$user->id);
		$result = $db->loadAssocList();
		return $result;
	}

	function get_weapons2() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT jos_jigs_weapons.item_id, jos_jigs_weapon_names.name " .
						"FROM jos_jigs_weapons " .
						"LEFT JOIN jos_jigs_weapon_names ON jos_jigs_weapons.item_id =  jos_jigs_weapon_names.id " .
				"WHERE jos_jigs_weapons.player_id =".$user->id);
		$result = $db->loadAssocList();
		return $result;
	}



	function get_spells() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT jos_jigs_spells.item_id, jos_jigs_spell_names.name " .
				"FROM jos_jigs_spells LEFT JOIN jos_jigs_spell_names ON jos_jigs_spells.item_id =jos_jigs_spell_names.id  " .
				"WHERE jos_jigs_spells.player_id =".$user->id);
		$result = $db->loadAssocList();
		return $result;
	}

	function get_software() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT * " .
				"FROM jos_jigs_software " .
				"WHERE jos_jigs_software.iduser =".$user->id);
		$result = $db->loadRow();
		return $result;
	}

	function get_shop_software() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT  " .
	"quantity_1 ,	price_1 ,	quantity_2 ,price_2 ,	quantity_3 	,price_3, " .
	"quantity_4 ,	price_4 ,	quantity_5 ,price_5 ,	quantity_6 ,	price_6 , " .
	"quantity_7 ,	price_7 ,	quantity_8 ,	price_8		".	
				"FROM jos_jigs_software " .

				"WHERE jos_jigs_software.iduser =".$building_id);
		$result = $db->loadRow();
		return $result;
	}
	function get_property() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT image " .
				"FROM jos_jigs_buildings " .
				"WHERE jos_jigs_buildings.proprio  =".$user->id);
		$result = $db->loadAssocList();
		return $result;
	}


	function buy() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =" . $user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM jos_jigs_shop_prices WHERE jos_jigs_shop_prices.item_id = " . $item . " AND jos_jigs_shop_prices.shop_id = " . $building_id);
		$sell_price = $db->loadResult();
		if ($player_money > $sell_price) {
			$player_money = $player_money - $sell_price;
			$db->setQuery( "INSERT INTO jos_jigs_inventory (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")"
			);

			$result = $db->query();

			$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2 = $db->query();
			$result3='true';

			return $player_money;
		}
	}


	function buy_weapon() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =" . $user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM jos_jigs_weapon_names WHERE jos_jigs_weapon_names.id = " . $item );
		$sell_price = $db->loadResult();
		if ($player_money > $sell_price) {
			$player_money = $player_money - $sell_price;
			$db->setQuery( "INSERT INTO jos_jigs_weapons (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")"
			);

			$result = $db->query();

			$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2 = $db->query();
			$result3='true';

			return $player_money;
		}
	}

	function buy_crystals() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =".$user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM jos_jigs_crystals WHERE jos_jigs_crystals.id =".$item);
		$sell_price = $db->loadResult();

		if ($player_money > $sell_price) {
			$player_money = $player_money - $sell_price;
				
			$db->setQuery( "INSERT INTO jos_jigs_crystals (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")"
			);


			$result = $db->query();

			$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2 = $db->query();
			$result3='true';	$result = $db->loadRow();

			return $player_money;
		}
	}
	function buy_papers() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =".$user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM jos_jigs_papers WHERE jos_jigs_papers.id =".$item);
		$sell_price = $db->loadResult();

		if ($player_money > $sell_price) {
			$player_money = $player_money - $sell_price;
				
			$db->setQuery( "INSERT INTO jos_jigs_papers (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")"
			);


			$result = $db->query();

			$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2 = $db->query();
			$result3='true';	$result = $db->loadRow();

			return $player_money;
		}
	}

	function buy_blueprints() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =".$user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM jos_jigs_blueprints WHERE jos_jigs_blueprints.id =".$item);
		$sell_price = $db->loadResult();

		if ($player_money > $sell_price) {
			$player_money = $player_money - $sell_price;
			$db->setQuery( "INSERT INTO jos_jigs_blueprints (user_id, object) VALUES ( $user->id  ,  $item )" );
			$result = $db->query();
			$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2 = $db->query();
			return $player_money;
		}
	}



	function buy_building() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =".$user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT price FROM jos_jigs_buildings WHERE jos_jigs_buildings.id =".$building_id);
		$sell_price = $db->loadResult();
		// If the Player has enough money
		if ($player_money >= $sell_price) {
				
			// player loses cost of building
			$player_money = $player_money - $sell_price;
			// player gets building
			$db->setQuery("UPDATE jos_jigs_buildings SET owner = $user->id WHERE jos_jigs_buildings.id = " . $building_id);
			$result = $db->query();
			// update new players cash in hand to database
			$db->setQuery("UPDATE jos_jigs_players SET money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2 = $db->query();
			$result3='true';


			//if the building is a farm set up or update the jos_jig_fields database record for this building

			if ($type='farm'){

				$x=	"INSERT INTO jos_jigs_fields (building, crops ) values  ($building_id,0) ON DUPLICATE KEY UPDATE crops = 0";
			}
			$db->setQuery( $x);
			$db->query();
			// $result = $db->loadRow();
			return $result;
		}
	}

	function buy_drugs() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getInt(item) ;
		$item= $item +1 ;
		$db->setQuery("SELECT quantity_". $item ." FROM jos_jigs_drugs  WHERE  iduser =".$user->id);
		$player_quantity= $db->loadResult();
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =".$user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT price_" . $item . " , quantity_" . $item . " FROM jos_jigs_drugs WHERE jos_jigs_drugs.iduser =" . $building_id);
		$buy_info = $db->loadRow();
		$buy_cost = $buy_info[0];
		$buy_quantity = $buy_info[1];

		if ($player_money > $buy_info[0]) {
				
				
			$player_money = $player_money - $buy_info[0];
			$player_quantity= $player_quantity + $buy_info[1];

				
			$db->setQuery("UPDATE jos_jigs_drugs SET jos_jigs_drugs.quantity_" . $item . " = " . $player_quantity. " WHERE jos_jigs_drugs.iduser = ".$user->id );
			$result = $db->query();
			$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2 = $db->query();
			$result3='true';

			return $player_quantity;
		}
	}

	function sell() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =".$user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM jos_jigs_shop_prices WHERE item_id = ". $item . " AND shop_id = " . $building_id );
		$buy_price = $db->loadResult();
		$player_money = $player_money + $buy_price;
		$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
		$result2 = $db->query();
		$db->setQuery("DELETE FROM jos_jigs_inventory WHERE jos_jigs_inventory.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result = $db->query();
		return $result;
	}

	function sell_weapon() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =".$user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT sell_price FROM jos_jigs_weapon_names WHERE id = ". $item );
		$buy_price = $db->loadResult();
		$player_money = $player_money + ($buy_price/2);
		$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
		$result2 = $db->query();
		$db->setQuery("DELETE FROM  jos_jigs_weapons WHERE jos_jigs_weapons.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result = $db->query();
		return $result;
	}


	function sell_crystals() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =".$user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM jos_jigs_crystal_prices WHERE jos_jigs_crystal_prices.item_id =".$item);
		$buy_price = $db->loadResult();
		$player_money = $player_money + $buy_price;
		$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
		$result2 = $db->query();
		$db->setQuery("DELETE FROM  jos_jigs_crystals WHERE jos_jigs_crystals.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result = $db->query();
		return $result;

	}
	function sell_papers() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getvar(item);
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =".$user->id);
		$player_money= $db->loadResult();
		$db->setQuery("SELECT buy_price FROM jos_jigs_papers WHERE jos_jigs_papers.id =".$item);
		$buy_price = $db->loadResult();
		$player_money = $player_money + $buy_price;
		$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
		$result2 = $db->query();
		$db->setQuery("DELETE FROM jos_jigs_papers WHERE jos_jigs_papers.player_id = ".$user->id ." AND item_id=" . $item . " LIMIT 1");
		$result = $db->query();
		return $result;

	}

	function sell_drugs()  {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$item= JRequest::getInt(item) ;
		$item= $item-1 ;
		echo Json_encode($item);
		$db->setQuery("SELECT quantity_". $item ." FROM jos_jigs_drugs  WHERE  iduser =".$user->id);
		$player_quantity= $db->loadResult();
		$db->setQuery("SELECT money FROM jos_jigs_players WHERE iduser =".$user->id);
		$player_money= $db->loadResult();

		$db->setQuery("SELECT price_" . $item . " , quantity_" . $item . " FROM jos_jigs_drugs WHERE jos_jigs_drugs.iduser =" . $user->id);
		$buy_info = $db->loadRow();
		$buy_cost = $buy_info[0];
		$buy_quantity = $buy_info[1];

		if ($buy_info[1] > 50){
				
			$player_money = $player_money + $buy_info[0];
			$player_quantity= $player_quantity - 50 ;

				
			$db->setQuery("UPDATE jos_jigs_drugs SET jos_jigs_drugs.quantity_" . $item . " = " . $player_quantity. " WHERE jos_jigs_drugs.iduser = " . $user->id );
			$result = $db->query();
			$db->setQuery("UPDATE jos_jigs_players SET jos_jigs_players.money = " . $player_money . " WHERE iduser = " . $user->id );
			$result2 = $db->query();
			$result3='true';

		}

	}


	function get_shop_inventory() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT jos_jigs_shop_prices.item_id, " .
				"jos_jigs_objects.name, " .
				"jos_jigs_shop_prices.sell_price " .
				"FROM jos_jigs_shop_prices " .
				"LEFT JOIN jos_jigs_objects " .
				"ON jos_jigs_shop_prices.item_id = jos_jigs_objects.id " .
				"WHERE jos_jigs_shop_prices.shop_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;
	}

	function get_shop_crystals() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT jos_jigs_crystal_prices.item_id, " .
			      "jos_jigs_crystal_names.name, " .
		   		  "jos_jigs_crystal_prices.sell_price " . 
			      "FROM jos_jigs_crystal_prices " .
		    	  "LEFT JOIN  jos_jigs_crystal_names " .
				  "ON jos_jigs_crystal_prices.item_id = jos_jigs_crystal_names.id " .
				  "WHERE jos_jigs_crystal_prices.shop_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;
	}



	function work_field() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$field= JRequest::getvar(field);
		$building_id= JRequest::getvar(building_id);
		$query= "SELECT status_field_" . $field . ",crops FROM jos_jigs_fields  WHERE building =" . $building_id;
		$y=$query;
		$db->setQuery($query);
		$result = $db->loadRowList();


		$job= $result[0][0];
		$job++;
		$crops = $result[0][1];
		if ($job==4){
			$crops++;
			$job=1;
		}
		$x=	"INSERT INTO jos_jigs_fields (building, status_field_" . $field . ", crops ) " .
		    " values  ($building_id, $job , $crops) ON DUPLICATE KEY UPDATE status_field_" . $field . " =  $job , crops = $crops";

		$db->setQuery($x);
		if(!$db->query()){
			echo Json_encode ($x);
		}
		return $result;
	}





	function get_shop_drugs() {
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$building_id= JRequest::getvar(building_id);
		$db->setQuery("SELECT
		quantity_1 ,	price_1 ,	quantity_2 ,price_2 ,	quantity_3 	,price_3, " .
	   "quantity_4 ,	price_4 ,	quantity_5 ,price_5 ,	quantity_6 ,	price_6 , " .
       "quantity_7 ,	price_7 ,	quantity_8 ,	price_8		".	
	   "FROM jos_jigs_drugs " .
	   "WHERE jos_jigs_drugs.iduser =".$building_id);
		$result = $db->loadRow();
		return $result;
	}



	function heartbeat(){
		$result_1 = $this->check_factories();
		$result_2 = $this->check_mines();
		$result = $this->get_players();
		return $result;
	}


	function get_players(){
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$db->setQuery("SELECT map,grid FROM jos_jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$map = $result[0];
		$grid = $result[1];
		$db->setQuery("SELECT
				jos_jigs_players.iduser, 
				jos_jigs_players.posx, 
				jos_jigs_players.posy, 
				jos_comprofiler.avatar
				FROM jos_jigs_players 
				LEFT JOIN jos_comprofiler ON jos_jigs_players.iduser = jos_comprofiler.user_id
				WHERE grid ='".$grid."' AND map='".$map."' AND jos_jigs_players.iduser !='".$user->id."'
							");

		$result = $db->loadAssocList();

		return $result;
	}

	// Called by JiGS.js.php via JSON On successful call the player is moved by mootools
	function save_coordinate() {
		$db =& JFactory::getDBO();

		$user =& JFactory::getUser();
		$posx = JRequest::getvar('posx');
		$posy = JRequest::getvar('posy');
		$map = JRequest::getvar('map');
		$grid = JRequest::getvar('grid');
		$db->setQuery("UPDATE jos_jigs_players SET posx='".$posx."',posy='".$posy."',map='".$map."',grid='".$grid."'  WHERE iduser ='".$user->id."'");
		$db->query();
		$result='success';
		return $result;
	}


	function respawn(){
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT id from jos_jigs_characters WHERE empty = 1");
		$db->query();
		$result = $db->loadResultArray();
		Foreach ($result as $row){
			$number_of_items = rand(1,3);
			for ($i=0 ;$i<$number_of_items;$i++){
				$item_id= rand(1, 15);
				$db->setQuery("INSERT INTO jos_jigs_inventory (item_id, player_id ) VALUES (" . $item_id . " ,  " .  $row  . ")");
				$db->query();
			}
			$db->setQuery("UPDATE jos_jigs_characters SET empty = 0 WHERE id = " .  $row );
			$db->query();
		}
		$now= time();
		$db->setQuery("UPDATE jos_jigs_characters SET active= 1, health= 100  WHERE  jos_jigs_characters.time_killed < (" . $now . "- (1 * 60))");
		$db->query();
	}


	function attack() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$user_id =$user->id;
		$character_id = JRequest::getvar(character);



		$player_dice= rand(0, 15);
		$character_dice=rand(0, 5);
		$db->setQuery("SELECT health,money,final_attack,final_defense FROM jos_jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$player_v= $result[0];
		$player_m= $result[1];
		$db->setQuery("SELECT health,money,name FROM jos_jigs_characters WHERE id =".$character_id);
		$result = $db->loadRow();
		$char_v= $result[0];
		$char_m= $result[1];
		$char_name = $result[2];
		$attack_type = JRequest::getvar(type);

		switch ($attack_type) {
			/////////////////// If Player shoots test shooting skills + speed + dexterity against NPCs speed ////////////////////////////////
			case 'shoot':
				if ($player_dice > $character_dice){
					$player_v=$player_v+1;
					$char_v=$char_v-30;
				}
				else {
					$player_v=$player_v-1;
					$char_v=$char_v+10;
				}





				break;
				/////////////////// If Player kicks test kicking and other fighting skills + speed + dexterity against NPCs speed ////////////////////////////////
			case 'kick':

				if ($player_dice > $character_dice){
					$player_v=$player_v+1;
					$char_v=$char_v-30;
				}
				else {
					$player_v=$player_v-1;
					$char_v=$char_v+10;
				}
				break;
				/////////////////// If Player punches test punch and other fighting skills + speed + dexterity against NPCs speed ////////////////////////////////
			case 'punch':
				if ($player_dice > $character_dice){
					$player_v=$player_v+1;
					$char_v=$char_v-30;
				}
				else {
					$player_v=$player_v-1;
					$char_v=$char_v+10;
				}
				break;
		}
		////////////////////////////////////////// If NPC is DEAD ////////////////////////////////////

		if ($char_v <= 0) {
			$now=time();
			$db->setQuery("UPDATE jos_jigs_characters SET active = 0, empty= 1 , time_killed = " . $now . " WHERE id ='".$character_id."'");
			$db->query();
			$db->setQuery("UPDATE jos_jigs_inventory SET jos_jigs_inventory.player_id = ".$user->id." WHERE jos_jigs_inventory.player_id = ".$character_id );
			$result = $db->query();


			//// Upate specific and General stats and payout when applicable

			$xp_type = 'nbr_kills';
			$test = $this->increment_xp($xp_type ,$char_m,$user_id);



			$text= 'Citizen ' . $char_name  . ' was killed by citizen ' . $user->username ;
			$db->setQuery("INSERT INTO jos_shoutbox (name, time, text) VALUES ('Wavy Lines:', " . $now .", '" . $text ."' )" ) ;
			$db->query() ;
		}

		$db->setQuery("UPDATE jos_jigs_players SET health='".$player_v."'  WHERE iduser ='".$user->id."'");
		$db->query();
		$db->setQuery("UPDATE jos_jigs_characters SET health='".$char_v."'  WHERE id ='".$character_id."'");
		$db->query();
		$v[0]=$player_v;
		$v[1]=$char_v;

		return $v;

	}

	function increment_xp($xp_type ,$payment,$user_id){

		$db =& JFactory::getDBO();
		$query="UPDATE jos_jigs_players SET $xp_type  = $xp_type  +1, xp = xp+1, money = money + " . $payment ." WHERE jos_jigs_players.iduser = " .  $user_id;
		$db->setQuery($query);
		$db->query();

		$this->test_level($user_id);


		return $query;
	}


	function test_level($user_id){
		$user =& JFactory::getUser();
		$db =& JFactory::getDBO();
		$now=time();
		$query="SELECT xp FROM jos_jigs_players where iduser = $user_id";
		$db->setQuery($query);
		$xp = $db->loadResult();
		$milestones = array(100,200,400,800,1600,2000,4000,8000);

		foreach ($milestones as $check){

			if ($xp == $check){
				$query="UPDATE jos_jigs_players SET level=level+1, statpoints = statpoints + 5 WHERE iduser = $user_id";
				$db->setQuery($query);
				$db->query();
					
				$text= 'Citizen ' . $user->username . ' leveled up';
				$db->setQuery("INSERT INTO jos_shoutbox (name, time, text) VALUES ('Wavy Lines:', " . $now .", '" . $text ."' )" ) ;
				$db->query() ;
					
					

					
			}
		}
	}

	function attack_playa() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$player_id = JRequest::getvar(player);

		$user2 =& JFactory::getUser($player_id);
		$player_dice= rand(0, 15);
		$player2_dice=rand(0, 5);
		$db->setQuery("SELECT health,money FROM jos_jigs_players WHERE iduser = ".$user->id);
		$result = $db->loadRow();
		$player_v= $result[0];
		$player_m= $result[1];
		$db->setQuery("SELECT health,money FROM jos_jigs_players WHERE iduser = ".$player_id);
		$result = $db->loadRow();
		$char_v= $result[0];
		$char_m= $result[1];

		if ($player_dice > $player2_dice){
			$player_v=$player_v+1;
			$char_v=$char_v-30;
		}
		else {
			$player_v=$player_v-1;
			$char_v=$char_v+10;
		}

		if ($char_v == 0 || $char_v < 0) {
				
			$now=time();
				
			$player_m= $player_m + $char_m ;
				
			$char_m = 0;

			$db->setQuery("UPDATE jos_jigs_players SET active = 3,  grid=1, map= 3, posx = 4, posy=5, empty= 1 , time_killed = " . $now . " WHERE iduser ='".$player_id."'");
			$db->query();

			$db->setQuery("UPDATE jos_jigs_inventory SET jos_jigs_inventory.player_id = " . $user->id . " WHERE jos_jigs_inventory.player_id = " . $player_id );
			$result = $db->query();

			$db->setQuery("UPDATE jos_jigs_players SET nbr_kills=nbr_kills+1, money = $player_m WHERE jos_jigs_players.iduser = " .  $user->id ) ;
			$result = $db->query();

			$db->setQuery("UPDATE jos_jigs_players SET money = $char_m WHERE jos_jigs_players.iduser = " .  $player_id ) ;
			$result = $db->query();

			//	$text= 'Citizen ' . $character_id  . ' was killed by citizen ' . $user->username ;
			//	$db->setQuery("INSERT INTO jos_shoutbox (name, time, text) VALUES ('Wavy Lines:', " . $now .", '" . $text ."' )" ) ;
			//	$db->query() ;

			$text= 'Citizen ' .  $user2->username  . ' was killed by citizen ' . $user->username ;
			$db->setQuery("INSERT INTO jos_shoutbox (name, time, text) VALUES ('Wavy Lines:', " . $now .", '" . $text ."' )" ) ;
			$db->query() ;




		}
		$db->setQuery("UPDATE jos_jigs_players SET health='".$player_v."'  WHERE iduser ='".$user->id."'");
		$db->query();

		$db->setQuery("UPDATE jos_jigs_players SET health='".$char_v."'  WHERE iduser ='".$player_id."'");
		$db->query();

		$v[0]=$player_v;
		$v[1]=$char_v;

		return $v;

	}




	function swap() {

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$weapon_id = JRequest::getvar(weapon_id);
		$db->setQuery("UPDATE jos_jigs_players SET id_weapon = '" . $weapon_id . "' WHERE iduser =".$user->id);
		$db->query();
		$result = $weapon_id ;
		return $result;
	}



	function mine(){

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$type = JRequest::getvar(type);
		$building_id = JRequest::getvar(building_id);
		$now= time();
		$query="INSERT INTO jos_jigs_mines (building_id, type, timestamp )" .
				" values  ($building_id,$type,$now) " .
				"ON DUPLICATE KEY UPDATE type = " . $type . ", timestamp = " .$now;
		$db->setQuery($query);
		$db->query();

		$result[0]=$type;
		$result[1]=$now;

		return $result;
	}



	function work_turbine(){

		$building_id = JRequest::getvar(building_id);
		$line = JRequest::getvar(line);
		$type = JRequest::getvar(type);
		$quantity = JRequest::getvar(quantity);
		$model = $this->getModel('building');
		$result = $model->work_turbine($building_id,$line,$type,$quantity);
		return $result;
	}

	function work_conveyer($building_id,$quantity,$type,$line){
		$now=time();
		$db =& JFactory::getDBO();
		$q="INSERT INTO jos_jigs_factories (building,line,type, quantity,timestamp) VALUES
	 ($building_id,$line, $type,$quantity,$now ) ON DUPLICATE KEY UPDATE type  =  $type , quantity = $quantity , timestamp= $now";
		$db->setQuery($q);
		$result = $db->query();
		return $result;
	}

	function deposit(){

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$qty = JRequest::getvar(amount);
		$building_id = JRequest::getvar(building_id);
		$now= time();
		$db->setQuery("Select money, bank FROM jos_jigs_players WHERE iduser = " . $user->id);
		$result = $db->loadRow();
		$money = $result[0];
		$bank= $result[1];

		if ($qty <= $money){
			$money = $money - $qty;
			$bank = $bank + $qty;
			$query = "UPDATE jos_jigs_players SET money = $money, bank = $bank  WHERE iduser = " . $user->id;
			$db->setQuery($query);
			$db->query();
		}
		return $result;
	}


	function withdraw(){

		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$qty = JRequest::getvar(amount);
		$building_id = JRequest::getvar(building_id);
		$now= time();
		$db->setQuery("Select money, bank FROM jos_jigs_players WHERE iduser =".$user->id);
		$result = $db->loadRow();
		$money = $result[0];
		$bank = $result[1];

		if ($qty <= $bank){
			$money = $money + $qty;
			$bank = $bank - $qty;
			$query = "UPDATE jos_jigs_players SET money = $money, bank = $bank  WHERE iduser =" . $user->id;
			$db->setQuery($query);
			$db->query();
		}
		return $result;
	}

	function sell_crops() {

		$crops= $this->get_crops();

		$payment = $crops * 1000 ;
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$query_1 ="SELECT money FROM jos_jigs_players WHERE iduser = '$user->id'";
		$db->setQuery($query_1);

		$money_saved = $db->loadResult();

		$xp_type = 'nbr_crops';
		$test = $this->increment_xp($xp_type ,$payment,$user->id);

		$query_2=	"Update jos_jigs_fields LEFT JOIN jos_jigs_buildings on jos_jigs_fields.building = jos_jigs_buildings.id SET crops = 0 WHERE jos_jigs_buildings.owner = $user->id";

		$db->setQuery($query_2);
		$db->query();

		return($test);

	}

	function get_crops(){

		$total_crop = 0;
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$query = "SELECT crops FROM jos_jigs_fields LEFT JOIN jos_jigs_buildings ON jos_jigs_fields.building = jos_jigs_buildings.id WHERE jos_jigs_buildings.owner = $user->id; ";
		$db->setQuery($query);
		$result = $db->loadResultArray();

		foreach($result as $row){
			$total_crop = $total_crop + $row;
		}

		return ($total_crop);
	}

	function check_mines(){
		$user =& JFactory::getUser();
		$now= time();
		$db =& JFactory::getDBO();
		$duration = $now - 50;

		$query	=	"SELECT jos_jigs_mines.building_id,
	                    jos_jigs_mines.type, 
	                    jos_jigs_mines.timestamp, 
	                    jos_jigs_buildings.owner 
	FROM jos_jigs_mines 
	LEFT JOIN jos_jigs_buildings 
	ON jos_jigs_mines.building_id = jos_jigs_buildings.id 
	WHERE timestamp!=0 && timestamp < " . $duration;

		$db->setQuery($query);

		$result = $db->loadObjectlist();

		$payment = 100;

		foreach ($result as $row){

			$playa = & JFactory::getUser($row->owner);
			$playa_name = $playa->username;

			if ($row->type==1){
				$type_crystal =rand( 1 , 30 );
				$query ="INSERT INTO jos_jigs_crystals (player_id , item_id, quantity )VALUES($row->owner ,$type_crystal, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1";
				$db->setQuery($query);
				$db->query();
					
				$text= 'Citizen ' . $playa_name  . ' has mined 1 unit of crystal:' . $type_crystal ;
					
			}
			if ($row->type==2){
				$type_metal =rand( 1 , 30 ) ;
				$query ="INSERT INTO jos_jigs_metals (player_id , item_id, quantity )VALUES( $row->owner ,$type_metal, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1";
				$db->setQuery($query);
				$db->query();

				$text= 'Citizen ' . $playa_name  . ' has mined 1 unit of metal:' . $type_metal ;
					
			}
			else{
					
				$query_1 ="SELECT money FROM jos_jigs_players WHERE iduser = '$row->owner'";
				$db->setQuery($query_1);
				$money_saved = $db->loadResult();
				$money= $money_saved + $payment;
				$x=	"Update jos_jigs_players SET money = $money WHERE iduser= " . $row->owner;
				$db->setQuery($x);
				$db->query();

				$text= 'Citizen ' . $playa_name  . ' has mined 1 unit of oil:' ;
			}

			$xp_type = 'nbr_drills';
			$test = $this->increment_xp($xp_type ,0,$row->owner);

			// send wavy lines
			$db->setQuery("INSERT INTO jos_shoutbox (name, time, text) VALUES ('Wavy Lines:', " . $now .", '" . $text ."' )" ) ;
			$db->query();
			// end wavy lines
		}




		$query="UPDATE jos_jigs_mines SET timestamp = 0 WHERE timestamp < ". $duration;
		$db->setQuery($query);
		$db->query();

		return ;
	}


	function check_mine(){

		$now= time();
		$building_id = JRequest::getvar(building_id);
		$user =& JFactory::getUser();
		$db =& JFactory::getDBO();
		$query="SELECT timestamp FROM jos_jigs_mines WHERE building_id = $building_id";
		$db->setQuery($query);
		$result[timestamp] = $db->loadResult();
		$result[now] = date('l jS \of F Y h:i:s A',$now);
		$result[since] = date('l jS \of F Y h:i:s A',$result[timestamp]);
		$result[elapsed] = (int)(($now-$result[timestamp]));
		$result[remaining]=(int)(50-((($now-$result[timestamp]))));
		return $result;
	}





	function check_factories(){

		$user =& JFactory::getUser();
		$now= time();
		$duration= $now - 50;
		$db =& JFactory::getDBO();
		// Find all factories where time remaining is below zero

		$query="SELECT jos_jigs_factories.type,
				   jos_jigs_buildings.owner, 
	               jos_jigs_objects.name
	FROM jos_jigs_factories 
	
	LEFT JOIN jos_jigs_buildings
	ON jos_jigs_factories.building = jos_jigs_buildings.id 
	
	LEFT JOIN jos_jigs_objects
	ON jos_jigs_factories.type = jos_jigs_objects.id 	
	
	WHERE timestamp!=0 AND timestamp < ". $duration;
		$db->setQuery($query);
		$result = $db->loadObjectlist();

		// loop through factory array giving out rewards of type

		foreach ($result as $row){
			$query1 ="INSERT INTO jos_jigs_inventory (player_id , item_id) VALUES ($row->owner ,$row->type)";
			$db->setQuery($query1);
			$db->query();
			$xp_type = 'nbr_objs';
			$increment = $this->increment_xp($xp_type ,0,$row->owner);

			// send wavy lines

			$playa = & JFactory::getUser($row->owner);
			$playa_name = $playa->username;
			$text= 'Citizen ' . $playa_name  . ' has created 1 ' . $row->name ;
			$db->setQuery("INSERT INTO jos_shoutbox (name, time, text) VALUES ('Wavy Lines:', " . $now .", '" . $text ."' )" ) ;
			$db->query();

			// end wavy lines

		}

		// Now Simply reset all factories where remainging time is less that zero
		$query="UPDATE jos_jigs_factories SET timestamp = 0 WHERE timestamp !=0 AND timestamp < " . $duration;
		$db->setQuery($query);
		$db->query();

		return $query;
	}


	function check_factory($building_id,$line_id){

		$building_id = JRequest::getvar(building);
		$line_id= JRequest::getvar(line);
		//$user =& JFactory::getUser();
		$now= time();
		$db =& JFactory::getDBO();
		$query="SELECT timestamp FROM jos_jigs_factories WHERE building = $building_id AND line = $line_id";
		$db->setQuery($query);
		$result['timestamp'] = $db->loadResult();

		$result[now] = date('l jS \of F Y h:i:s A',$now);
		$result[since] = date('l jS \of F Y h:i:s A',$result['timestamp']);
		$result[elapsed] = (int)(($now-$result['imestamp']));
		$result[remaining]=(int)(50-((($now-$result['timestamp']))));

		return $result;
	}

}
