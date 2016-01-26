<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modellist');

jimport( 'joomla.filesystem.folder' );

require_once JPATH_COMPONENT.'/helpers/messages.php';
require_once JPATH_COMPONENT.'/helpers/energy.php';
//require_once JPATH_COMPONENT.'/helpers/jigs.php';

class BattleModelJigs extends JModellegacy
{
    function getDirectoryContent()
    {
        $dir = '/var/www/meme/images/sito/';
        $files = scandir($dir);
        $random = rand(1,1000);
        return $files[$random];
    }
    function get_cells()
    {

        $map    = JRequest::getvar('map');
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $db->setQuery("SELECT row0,row1,row2,row3,row4,row5,row6,row7 FROM #__jigs_maps WHERE id = " . $map);
        $result = $db->loadAssocList();
        return $result;

    }

    function get_free_seed(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $query          = "SELECT seed_list FROM #__jigs_crop_seeds WHERE #__jigs_crop_seeds.owner = $user->id ";
        $db->setQuery($query);
        $result         = $db->loadResult();
        $result_array   = explode(',',$result);
        if (in_array(1,$result_array)) {

            $message = "You already received your yearly supply of Bonsanto(tm) Basic Seeds level 1";
            $message .= "Your attempt to defraud the people of Pryamid City has been recorded";
        }else{
            $result_array[] = 1;
            $string         = implode($result_array,',');
            $sql            = "INSERT INTO #__jigs_crop_seeds (seed_list,owner)
                              VALUES ('$string', $user->id) ON DUPLICATE KEY
                              UPDATE seed_list = '$string'";
            $db->setQuery($sql);
            $db->query();
            $message= "You receive your yearly supply of Bonsanto Basic Seeds level 1";
        }
        MessagesHelper::sendFeedback($user->id,$message);
        return ($message);
    }

    function get_portals(){
        $map    = JRequest::getvar('map');
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $db->setQuery("SELECT * FROM #__jigs_portals WHERE from_map =" . $map);
        $result = $db->loadAssocList();
        return $result;
}


    function get_messages()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $db->setQuery("SELECT message FROM #__jigs_logs WHERE user_id = $user->id  ORDER BY timestamp DESC LIMIT 6");
        $message_list= $db->loadObjectList();
        return $message_list;
    }


    function get_stats()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        //	$test = self::set_final_stats();
        $sql= "SELECT level, health, strength, intelligence,speed, posx, posy, xp,energy, money, bank, defence, final_defence,
            attack, final_attack, nbr_attacks, nbr_kills, flags FROM #__jigs_players WHERE id = " . $user->id;
        $db->setQuery($sql);
        $result= $db->loadAssocList();

        return $result;
    }


    function get_player()
     {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $test= self::set_final_stats();
        $db->setQuery("	SELECT posx, posy, xp, grid, map FROM #__jigs_players WHERE id =".$user->id);
        $result= $db->loadAssocList();
        return $result;
    }

    function set_final_stats()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $db->setQuery("Select attack, defence FROM  #__jigs_players WHERE id =".$user->id);
        $db->query();
        $result= $db->loadRow();
        $attack= $result[0];
        $defence= $result[1];
        $db->setQuery("	Select #__jigs_weapon_names.attack, #__jigs_weapon_names.defence FROM #__jigs_players
            LEFT JOIN #__jigs_weapon_names
            ON #__jigs_players.id_weapon = #__jigs_weapon_names.id
            WHERE #__jigs_players.id =".$user->id);
        $db->query();
        $result= $db->loadRow();
        $weapon_attack= $result[0];
        $weapon_defence= $result[1];
        $final_attack= $attack + $weapon_attack;
        $final_defence= $defence + $weapon_defence;
        $db->setQuery("UPDATE #__jigs_players SET final_attack = '" . $final_attack. "', final_defence = '" . $final_defence . "'WHERE id =".$user->id);
        $db->query();
        return ($result);
    }

    function leave_room()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $query= "Update #__jigs_players SET active=1,posx=100,posy=100 WHERE id = $user->id";
        $db->setQuery($query);
        $db->query();
        return true;
    }

    function get_shop_blueprints()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_blueprints.object, #__jigs_blueprints.sell_price, #__jigs_objects.name
                FROM #__jigs_blueprints
                LEFT JOIN  #__jigs_objects
                ON #__jigs_blueprints.object = #__jigs_objects.id WHERE #__jigs_blueprints.user_id =" . $building_id);
        $result= $db->loadAssocList();
        return $result;

    }

    function get_shop_clothing()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_clothing.item_id, #__jigs_clothing.sell_price, #__jigs_clothing_names.name
                FROM #__jigs_clothing LEFT JOIN  #__jigs_clothing_names ON #__jigs_clothing.item_id = #__jigs_clothing_names.id
                WHERE #__jigs_clothing.player_id =" . $building_id);
        $result= $db->loadAssocList();
        return $result;

    }

    function get_shop_spells()
    {
        $db = JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_spells.item_id, #__jigs_spells.sell_price, #__jigs_spell_names.name
        FROM #__jigs_spells LEFT JOIN  #__jigs_spell_names ON #__jigs_spells.item_id = #__jigs_spell_names.id
        WHERE #__jigs_spells.player_id =" . $building_id);
        $result= $db->loadAssocList();
        return $result;
    }

    function get_shop_weapons()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_weapons.item_id, #__jigs_weapon_names.sell_price, #__jigs_weapon_names.name
        FROM #__jigs_weapons LEFT JOIN  #__jigs_weapon_names ON #__jigs_weapons.item_id = #__jigs_weapon_names.id
        WHERE #__jigs_weapons.player_id =" . $building_id);
        $result= $db->loadAssocList();
        return $result;
    }

    function get_inventory_to_sell()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_inventory.item_id, #__jigs_objects.name, #__jigs_shop_prices.buy_price
                FROM #__jigs_inventory
            LEFT JOIN #__jigs_objects ON #__jigs_inventory.item_id = #__jigs_objects.id
            LEFT JOIN #__jigs_shop_prices
            ON #__jigs_inventory.item_id = #__jigs_shop_prices.item_id
            WHERE #__jigs_inventory.player_id = $user->id
            AND #__jigs_shop_prices.shop_id = $building_id ");
        $result = $db->loadAssocList();
        return $result;
    }

    function get_metals_to_sell()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');

        $query= "SELECT #__jigs_metals.item_id,
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
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id=  JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_inventory.item_id, #__jigs_objects.name, #__jigs_shop_prices.buy_price
        FROM #__jigs_inventory LEFT JOIN #__jigs_objects
        ON #__jigs_inventory.item_id = #__jigs_objects.id
        LEFT JOIN #__jigs_shop_prices ON #__jigs_inventory.item_id = #__jigs_shop_prices.item_id
        WHERE #__jigs_inventory.player_id = $user->id AND #__jigs_shop_prices.shop_id = $building_id ");
        $result = $db->loadAssocList();
        return $result;
    }

    function get_crystals()
    {
        $db = JFactory::getDBO();
        $user = JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery(
            "SELECT #__jigs_crystals.item_id, #__jigs_crystal_names.name, #__jigs_crystal_prices.buy_price
            FROM #__jigs_crystals LEFT JOIN #__jigs_crystal_names
                ON #__jigs_crystals.item_id = #__jigs_crystal_names.id
            LEFT JOIN #__jigs_crystal_prices ON #__jigs_crystals.item_id = #__jigs_crystal_prices.item_id
            WHERE #__jigs_crystals.player_id = $user->id AND #__jigs_crystal_prices.shop_id = " . $building_id);

        $result = $db->loadAssocList();
        return $result;
    }

    function get_backpack()
    {
        $db= JFactory::getDBO();
        $user   = JFactory::getUser();
        $db->setQuery("SELECT #__jigs_inventory.id, #__jigs_inventory.item_id, #__jigs_objects.name
            FROM #__jigs_inventory
            LEFT JOIN #__jigs_objects ON #__jigs_inventory.item_id = #__jigs_objects.id
            WHERE #__jigs_inventory.player_id = ". $user->id
        );
        $result= $db->loadObjectList();
        return $result;
    }

    function get_inventory2()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery("SELECT DISTINCT #__jigs_inventory.item_id, #__jigs_objects.name
            FROM #__jigs_inventory
            LEFT JOIN #__jigs_objects
            ON #__jigs_inventory.item_id = #__jigs_objects.id
            WHERE #__jigs_inventory.player_id = ". $user->id);
        $result		= $db->loadObjectList();
        foreach ($result as $row)
        {
            $sql= "SELECT id FROM #__jigs_inventory WHERE #__jigs_inventory.player_id = $user->id  and #__jigs_inventory.item_id = $row->item_id";
            $db->setQuery($sql);
            $quantity= $db->loadAssocList();
            $row->quantity= count($quantity);
        }
        return $result;
    }

    function get_metals2()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $db->setQuery("SELECT #__jigs_metals.item_id, " .
            "#__jigs_metals.quantity, #__jigs_metal_names.name FROM #__jigs_metals LEFT JOIN  #__jigs_metal_names ON #__jigs_metals.item_id = #__jigs_metal_names.id  WHERE #__jigs_metals.player_id =" . $user->id);
        $result		= $db->loadAssocList();
        return $result;
    }

    function get_crystals2()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $db->setQuery("SELECT #__jigs_crystals.item_id, #__jigs_crystal_names.name, #__jigs_crystals.quantity
        FROM #__jigs_crystals LEFT JOIN  #__jigs_crystal_names
        ON #__jigs_crystals.item_id = #__jigs_crystal_names.id
        WHERE #__jigs_crystals.player_id =" . $user->id);
        $result= $db->loadAssocList();
        return $result;
    }

    function get_skills()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $db->setQuery("SELECT #__jigs_skills.level, #__jigs_skills.active, #__jigs_skill_names.name
                        FROM #__jigs_skills
                        LEFT join #__jigs_skill_names
                        ON #__jigs_skills.skill_id =  #__jigs_skill_names.id
                        WHERE #__jigs_skills.player_id =" . $user->id);
        $all= $db->loadAssocList();
        return $all ;
    }

    function get_clothing()
    {
        $db  = JFactory::getDBO();
        $user = JFactory::getUser();
        $db->setQuery(" SELECT #__jigs_clothing.item_id, #__jigs_clothing_names.name
                        FROM #__jigs_clothing
                        LEFT JOIN #__jigs_clothing_names
                        ON #__jigs_clothing.item_id =  #__jigs_clothing_names.id
                        WHERE #__jigs_clothing.player_id =".$user->id);
        $result		= $db->loadAssocList();
        return $result;
    }

    function reload()
    {
        $db            = JFactory::getDBO();
        $user            = JFactory::getUser();
        // Get all the info from the database
        // There are three tables.
        // 1) The player table which includes the player stats ,what actual gun and how many spare bullets
        // 2) The weapons table which is a list of every instance of weapon in the game
        //    and how many bullets are in that particular gun
        // 3) The weapon_name  table which lists various stats for a gun type including the max number of bullets in a clip
        //
        $query              = "SELECT id_weapon,ammunition FROM #__jigs_players WHERE id = " . $user->id;
        $db->setQuery($query);
        $_result    = $db->loadAssoc();
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
            $_result    = $db->loadAssoc(); //load assoc is a joomla method that loads an associated array
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
            elseif(current_magazine < $max_ammunition && $ammunition < $empty_slots)
            {
                $current_magazine = $current_magazine + $ammunition;
                $ammunition        = $ammunition - $empty_slots;
                $message= "You reload your weapon to $current_magazine bullets ";
            }
            // now we need to save the info back to two tables
            // 1) the players table with number of bullets remaining in backpack
            // 2) number of bullets in this instance of weapon
            // The third table with weapon_type stats does not get updated with anything
    

            $query              = "UPDATE #__jigs_players SET ammunition= $ammunition
                                    WHERE id = $user->id";
            $db->setQuery($query);
            $db->query();
            $query              = "UPDATE #__jigs_weapons SET magazine = $current_magazine  
                                    WHERE id = $id_weapon AND player_id = $user->id";
            $db->setQuery($query);
            $db->query();
         }
    MessagesHelper::sendFeedback($user->id,$message);

    return $current_magazine;

    }

    function get_weapon()
    {

        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $db->setQuery("SELECT #__jigs_weapon_names.* ,

            #__jigs_weapons.magazine,
            #__jigs_players.ammunition
            FROM #__jigs_players

            LEFT JOIN #__jigs_weapons
            ON #__jigs_players.id_weapon = #__jigs_weapons.id

            LEFT JOIN #__jigs_weapon_names
            ON #__jigs_weapons.item_id = #__jigs_weapon_names.id


            WHERE #__jigs_players.id = " . $user->id);
        $result = $db->loadAssocList();


        $image = '<a rel="{handler: \'iframe\', size: {x: 640, y: 480}}" href="index.php?option=com_battle&view=weapons&id=' .  $user->id . ' "> ' .
            '<img src="components/com_battle/images/weapons/' . $result[0]['image'] . '"></a>' .
            '<span class="label">Id: </span>' . $result[0][0] .'<br>

            <span class="label">Bullets per clip:</span> ' . $result[0][2] .
            '<br><span class="label">Attack: </span>' . $result[0]['attack'] .'

            <span class="label">Defence:</span> ' . $result[0]['defence'] .
            '<br>
            <span class="label">Precision: </span>' . $result[0]['precision'] .'
            <span class="label">Trigger:</span> ' . $result[0]['trigger'] .
            '<br><span class="label">Price: </span>' . $result[0]['price'] .'
            <span class="label">Ammunition Price:</span> ' . $result[0]['prix_munition'];
            if ($user->id>0)
            {
            $image .= '<br><span class="label">Magazine: </span><div id = "magazine">' . $result[0]['magazine']. '</div>';
            $image .= '<br><span class="label">Ammunition: </span><div id = "ammunition">' . $result[0]['ammunition']. '</div><input type="button" value="Reload" onclick= "reload();"></button>';
            }
            return $image;
    }

    function get_weapons()
    {

        $db    = JFactory::getDBO();
        $user= JFactory::getUser();

        $db->setQuery("SELECT #__jigs_weapons.item_id, #__jigs_weapon_names.name, #__jigs_weapon_names.sell_price FROM #__jigs_weapons
                LEFT JOIN #__jigs_weapon_names ON #__jigs_weapons.item_id =  #__jigs_weapon_names.id
                WHERE #__jigs_weapons.player_id =".$user->id);

        $result     = $db->loadAssocList();
        return $result;
    }

    function get_weapons2()
    {

        $db	= JFactory::getDBO();
        $user= JFactory::getUser();

        $db->setQuery("SELECT #__jigs_weapons.item_id, #__jigs_weapon_names.name FROM #__jigs_weapons
                LEFT JOIN #__jigs_weapon_names
                ON #__jigs_weapons.item_id =  #__jigs_weapon_names.id
                WHERE #__jigs_weapons.player_id =".$user->id);
        $result= $db->loadAssocList();
        return $result;
    }



    function get_spells()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $db->setQuery("SELECT #__jigs_spells.item_id, #__jigs_spell_names.name
                FROM #__jigs_spells LEFT JOIN #__jigs_spell_names
                ON #__jigs_spells.item_id =#__jigs_spell_names.id
                WHERE #__jigs_spells.player_id =".$user->id);

        $result= $db->loadAssocList();
        return $result;
    }

    function get_software()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $db->setQuery("SELECT * FROM #__jigs_software WHERE #__jigs_software.id =".$user->id);
        $result= $db->loadRow();
        return $result;
    }

    function get_shop_software()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar(building_id);
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
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $db->setQuery("SELECT image, `name`, grid, id FROM #__jigs_buildings WHERE #__jigs_buildings.owner  =".$user->id);
        $result= $db->loadAssocList();
        return $result;
    }


    function jump()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar(buildingid);
        $properties = $this->get_property();
        foreach ($properties as $property){
            if ($building_id == $property['id']){
                $grid=$property['grid'];
                $query = "UPDATE #__jigs_players SET grid =$grid WHERE id=$user->id";
                $db->setQuery($query);
                $db->query();

            }
        }
        return $result;
    }

    function retrieve()
    {
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $item= JRequest::getvar('item');
        $sql            = "UPDATE #__jigs_inventory SET player_id = $user->id, location = 1 WHERE id = $item";
        $db->setQuery($sql);
        $result2= $db->query();
        $result3='true';
        return $sql;

    }

    function store()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $item= JRequest::getvar('item');
        $room= JRequest::getvar('room');
        $sql            = "UPDATE #__jigs_inventory SET player_id = $building_id, location = $room WHERE id= $item";
        $db->setQuery($sql);
        $db->query();
        return 'true';
    }

/*
    function buy_metal()
    {
        $db				= JFactory::getDBO();
        $user			= JFactory::getUser();
        $building_id	= JRequest::getvar('building_id');
        $item			= JRequest::getvar('metal');
        $db->setQuery("SELECT money FROM #__jigs_players WHERE id =" . $user->id);
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
            $sql		= "UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id;
            $db->setQuery($sql);

            $result2	= $db->query();
            $result3	= 'true';
            $message    = "You bought the metal";
        }
        else
        {
            $message= "You do not have enough cash";
        }
        MessagesHelper::sendFeedback($user->id,$message);
        return $player_money;
    }
    */
    ///// ADD UP ALL ENERGY FROM ALL BATTERIES FOR ONE USER /////
    function get_total_energy($id)
    {
        $batteries= $this->get_all_energy($id);
        //$batteries= $EnergyHelper::getAllEnergyNew($id);
        $total= 0;
        foreach ($batteries as $battery)
        {
            $total	= $total + $battery->units;
        }
        return $total;
    }

    ///// GET ALL BATTERIES FOR ONE USER /////
    function get_all_energy($id)
    {
        $db= JFactory::getDBO();
        $sql= "SELECT * FROM #__jigs_batteries WHERE user = " . $id;
        $db->setQuery($sql);
        $_all_energy= $db->loadObjectList();
        return $_all_energy;
    }

/*
    function use_hobbits($id,$total,$workforce_required)
    {
        $message	= "$workforce_required hobbits have begun work";
        MessagesHelper::sendFeedback($id,$message );
 
        $db         = JFactory::getDBO();
        
        if ($total >= $workforce_required)
        {
            $query                  = "UPDATE #__jigs_hobbits SET status = 2
            WHERE owner = $id
            ORDER BY xp ASC
            LIMIT $workforce_required";
            $db->setQuery($query);
            $db->query;
          //  $message_result = Jview::loadHelper('messages'); //got an error without this
            $message = "$workforce_required hobbits have begun work";
            MessagesHelper::sendFeedback($id,$message );
            return true;
        }
      MessagesHelper::sendFeedback($id, "no hobbits");
       return false;
    }
*/
    ///// TAKE ENERGY FROM USER'S BATTERIES UNTIL $energy_units_required IS REACHED /////
    function use_battery($id, $energy_units_required)
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $message= "Energy Required : " . $energy_units_required;
        MessagesHelper::sendFeedback($user->id,$message);
        $batteries= $this->get_all_energy($id);
        $total= $this->get_total_energy($id);
        $message= "Total Energy available : " . $total;
        MessagesHelper::sendFeedback($user->id,$message);
        if ($total < $energy_units_required)
        {
            $message = "not enough energy";
            MessagesHelper::sendFeedback($user->id,$message);
            return false;
        }
        $i=1;
        foreach ($batteries as $battery)
        {
            if($energy_units_required > 0)
            {
                if ($energy_units_required < $battery->units)
                {
                    $db= JFactory::getDBO();
                    $battery->units = $battery->units - $energy_units_required;
                    $message= $energy_units_required . " unit(s) deducted from battery " . $i ;
                    $energy_units_required	= 0;
                    MessagesHelper::sendFeedback($user->id,$message);
                }
                else
                {
                    $energy_units_required	= $energy_units_required - $battery->units;
                    $message .= $battery->units . " unit(s) deducted from  battery " . $i . "<br/>";
                    $battery->units	= 0;
                    $message .= "zero units remaining in battery " . $i ."</br>";
                    MessagesHelper::sendFeedback($user->id,$message);
                }
                $sql= "UPDATE #__jigs_batteries SET units = " . $battery->units . " WHERE id = " . $battery->id;
                $db->setQuery($sql);
                $result	= $db->query();
            }
            else
            {
                $message= "energy transer complete";
                MessagesHelper::sendFeedback($user->id,$message);
                break;
            }
            $i++;
        }
        $total= $this->get_total_energy($id);
        $message= $total . " remaining energy units";
        MessagesHelper::sendFeedback($user->id,$message);
        return true;
    }
    /// GIVE BATTERY FROM USER TO BUILDING ///
    function swap_battery()
    {
        $user           = JFactory::getUser();
        $db             = JFactory::getDBO();
        $building_id    = JRequest::getvar('building_id');
        $id             = JRequest::getvar('id');
        $sql            = "UPDATE #__jigs_batteries SET user = $building_id where id = $id";
        $db->setQuery($sql);
        $result         = $db->query();
        $energy_total   = $this->get_total_energy($building_id);
        MessagesHelper::sendFeedback($user->id, "transferred battery $id to building $building_id. Building now has $energy_total energy units");
        return $energy_total ;
    }

    function charge_battery()
    {
    }

    ///// SELECT ALL BATTERIES FOR A USER /////
    function get_batteries()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $sql= "SELECT * FROM #__jigs_batteries WHERE user =" . $user->id;
        $db->setQuery($sql);
        $result= $db->loadRowlist();
        //return $sql;
        return $result;
    }

    function moved_get_character_inventory($id)
    {
        $db    = JFactory::getDBO();
        $user= JFactory::getUser();
        $db->setQuery("SELECT #__jigs_inventory.item_id, #__jigs_objects.name FROM #__jigs_inventory LEFT JOIN #__jigs_objects
                ON #__jigs_inventory.item_id = #__jigs_objects.id WHERE #__jigs_inventory.player_id =".$id);
        $result= $db->loadAssocList();
        return $result;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/*	
    function get_player_money($db,$user)
    {
        $db->setQuery("SELECT money FROM #__jigs_players WHERE id =" . $user->id);
        $player_money	= $db->loadResult();
        return $player_money;
    }
*/
    function get_sell_price($db,$query)
    {
        $db->setQuery($query);
        $sell_price	= $db->loadResult();
        return $sell_price;
    }

    function update_player_money($db,$player_money,$user)
    {
        $query = "UPDATE #__jigs_players SET #__jigs_players.money = $player_money  WHERE id = $user->id";
        $db->setQuery($query);
        $db->query();
    }

    /**
     * @return mixed
     */
    function buy()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $item= JRequest::getvar('item');
        $buy= JRequest::getvar('buy');
        $amount         = JRequest::getvar('amount');
        $player_money= $this->get_player_money($db,$user);
        if ($buy=='objects')
        {

            $query= "SELECT sell_price FROM #__jigs_shop_prices WHERE #__jigs_shop_prices.item_id = $item AND #__jigs_shop_prices.shop_id = " . $building_id;
            $query2= "INSERT INTO #__jigs_inventory (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")";
            $message = "You bought the object";
        }
        if ($buy=='batteries')
        {
            $query2= "INSERT INTO #__jigs_batteries (charge_percentage,capacity,id) VALUES (100,10,$user->id)";
            $message = "You bought the battery";
        }
        if ($buy=='weapon')
        {
            $query= "SELECT sell_price FROM #__jigs_weapon_names WHERE #__jigs_weapon_names.id = " . $item;
            $query2= "INSERT INTO #__jigs_weapons (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")";
            $message = "You bought the weapon";

        }
        if ($buy=='crystal')
        {
            $query= "SELECT sell_price FROM #__jigs_crystals WHERE #__jigs_crystals.id =".$item;
            $query2= "INSERT INTO #__jigs_crystals (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")";
            $message = "You bought the crystal";
        }

        if ($buy=='papers')
        {
            $query = "SELECT sell_price FROM #__jigs_papers WHERE #__jigs_papers.id =".$item;
            $query2 = "INSERT INTO #__jigs_papers (user_id, item_id) VALUES ( $user->id  ,  $item )";
            $message = "You bought the papers";
        }
        if($buy=='blueprints')
        {
            $query = "SELECT sell_price FROM #__jigs_blueprints WHERE #__jigs_blueprints.id =".$item;
            $query2 = "INSERT INTO #__jigs_blueprints (user_id, object) VALUES ( $user->id  ,  $item )";
            $message = "You bought the blueprints";
        }
        if($buy=="building")
        {
            $query      = "SELECT price FROM #__jigs_buildings WHERE #__jigs_buildings.id =" . $building_id;
            $query2     = "UPDATE #__jigs_buildings SET owner = $user->id WHERE #__jigs_buildings.id = " . $building_id;
            $message    = "You bought the building";
        }
        if($buy=="bullets")
        {
            $query2     = "UPDATE #__jigs_players SET ammunition = ammunition + $amount  WHERE #__jigs_players.id = " . $user->id;
            $message    = $message2->message = "You bought $amount bullets";
        }

//////////////////////////////////////////// Get Sell Price	
        if ($buy == "batteries")
        {
            $sell_price	 = 100;
        }
        elseif($buy == "bullets")
        {
            $sell_price	 = $amount * 10;
        }
         else
        {
            $sell_price = $this->get_sell_price($db,$query);
        }

//////////////////////////////////////////// Deduct Sell Price	

        if ($player_money >= $sell_price)
        {
            $player_money	= $player_money - $sell_price;

            $db->setQuery($query2);
            $db->query();
            $this->update_player_money($db,$player_money,$user);
        }
//////////////////////////////////////////// Or Not
        else
        {
            $message = "You do not have enough cash";
        }
        ////////////////// Send Messages //////////////////////////
        MessagesHelper::sendFeedback($user->id,$message);
        $message2->money = $player_money;
        $message2->amount= $amount;
        return $message2;
        }

////////////////////////////////////////////////////////////////

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
        $res1		= $db->query();
        $result1	= $db->loadObjectList();
        $numRows1	= count($result1);  //$db->getNumRows();

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

    /////////// Select Money /////////////////////////
    function get_player_money($db,$user)
    {
        $query = "SELECT money FROM #__jigs_players WHERE id =".$user->id;
        $db->setQuery($query);
        $player_money = $db->loadResult();
        return $player_money;
    }

    function update_players_money($db,$player_money,$user)
    {
        $query = "UPDATE #__jigs_players SET #__jigs_players.money = " . $player_money . " WHERE id = " . $user->id;

        ////////////////// Send Messages //////////////////////////
        $text = "You have $player_money credit";

        MessagesHelper::sendFeedback($user->id, $text);

        $db->setQuery($query);
        $db->query();
        return;
    }

    function sell()
    {
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $building_id    = JRequest::getvar('building_id');
        $item           = JRequest::getvar('item');
        $sell           = JRequest::getvar('sell');
        $player_money   = $this->get_player_money($db,$user);
        if ($sell == 'objects')
        {
            $query1	= "SELECT buy_price FROM #__jigs_shop_prices WHERE item_id =  $item AND shop_id = " . $building_id;
            $query2	= "DELETE FROM #__jigs_inventory WHERE #__jigs_inventory.player_id = $user->id  AND item_id= $item LIMIT 1";
            $text	= "You sold object.";
        }

        if ($sell == 'crops')
        {
            $total_crops    = $this->get_total_crops();
            $query2         = "Update #__jigs_farms
                                LEFT JOIN #__jigs_buildings
                                on #__jigs_farms.building = #__jigs_buildings.id
                                SET total = 0
                                WHERE #__jigs_buildings.owner = $user->id";
            $text           = "You sold $total_crops crops.";
            $xp_type        = 'nbr_crops';
        }

        if ($sell=="battery")
        {
            $query2= "UPDATE #__jigs_batteries SET id = $building_id WHERE id =  $user->id LIMIT 1";
            $text= "You sold battery";
        }

        if ($sell=="metal")
        {
            $query1= "SELECT buy_price FROM #__jigs_shop_metal_prices WHERE item_id = $item AND shop_id = " . $building_id;
            $query2= "UPDATE #__jigs_metals SET quantity = quantity - 1 WHERE #__jigs_metals.player_id = $user->id AND item_id= $item ";
            $text= "You sold metal";
        }
        if ($sell=="weapon")
        {
            $query1= "SELECT sell_price FROM #__jigs_weapon_names WHERE id = ". $item ;
            $query2= "DELETE FROM  #__jigs_weapons WHERE #__jigs_weapons.player_id = $user->id AND item_id=" . $item . " LIMIT 1";
            $text= "You sold weapon";
        }

        if ($sell=="crystals")
        {
            $query1= "SELECT buy_price FROM #__jigs_crystal_prices WHERE #__jigs_crystal_prices.item_id =".$item;
            $query2= "DELETE FROM  #__jigs_crystals WHERE #__jigs_crystals.player_id = $user->id AND item_id= $item  LIMIT 1";
            $text= "You sold crystals";
        }

        if ($sell=="papers")
        {
            $query1= "SELECT buy_price FROM #__jigs_papers WHERE #__jigs_papers.id =".$item ;
            $query2= "DELETE FROM #__jigs_papers WHERE #__jigs_papers.player_id = $user->id  AND item_id= $item  LIMIT 1";
            $text= "You sold papers";
        }
        //////////////////////////Get Buy Price for player /////////
        if ($sell=="crops")
        {
            $buy_price	= $total_crops * 1000 ;
        }
        elseif ($sell=="battery")
        {
            $buy_price	    = 90;
        }
        else
        {
            $db->setQuery($query1);
            $buy_price	= $db->loadResult();
        }
        ////Update players money////////////////////////////////////
        $player_money	= $player_money + $buy_price;
        $this->update_players_money($db,$player_money,$user);
        ////////// Delete item or update ownership /////////////////
        $db->setQuery($query2);
        $db->query();
        /////////////////// Increment XP ///////////////////////////
        $test       = $this->increment_xp($xp_type,$user->id);
        ////////////////// Send Messages //////////////////////////
        MessagesHelper::sendFeedback($user->id, $text);
        return $player_money;
    }
////////////////////////////////////////////////////////////////////////////

    function get_shop_inventory()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_shop_prices.item_id, #__jigs_objects.name, #__jigs_shop_prices.sell_price
                FROM #__jigs_shop_prices
                LEFT JOIN #__jigs_objects
                ON #__jigs_shop_prices.item_id = #__jigs_objects.id
                WHERE #__jigs_shop_prices.shop_id =" . $building_id);
        $result= $db->loadAssocList();
        return $result;
    }

    function get_flat_inventory()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $query          = "SELECT #__jigs_objects.name,	#__jigs_inventory.item_id
        FROM #__jigs_objects
        LEFT JOIN #__jigs_inventory
        ON #__jigs_objects.id = #__jigs_inventory.item_id
        WHERE #__jigs_inventory.player_id =" . $building_id;
        $db->setQuery($query);
        $result= $db->loadAssocList();
        return $result;
    }

    function get_shop_metals()
    {
        $db	= JFactory::getDBO();
        $building_id= JRequest::getvar('building_id');
        $query = "
            SELECT #__jigs_shop_metal_prices.item_id, #__jigs_metal_names.name, #__jigs_shop_metal_prices.sell_price
            FROM #__jigs_shop_metal_prices
            LEFT JOIN #__jigs_metals
            ON #__jigs_shop_metal_prices.item_id = #__jigs_metals.id
            LEFT JOIN #__jigs_metal_names
            ON #__jigs_metal_names.id = #__jigs_shop_metal_prices.item_id
            WHERE #__jigs_shop_metal_prices.shop_id = $building_id";
        $db->setQuery($query);
        $result		= $db->loadAssocList();
        return $result;
    }

    function get_shop_crystals()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id = JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_crystal_prices.item_id, #__jigs_crystal_names.name, #__jigs_crystal_prices.sell_price
            FROM #__jigs_crystal_prices
            LEFT JOIN  #__jigs_crystal_names
            ON #__jigs_crystal_prices.item_id = #__jigs_crystal_names.id
            WHERE #__jigs_crystal_prices.shop_id =" . $building_id);
        $result = $db->loadAssocList();
        return $result;
    }

    function get_players()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $db->setQuery("SELECT map,grid FROM #__jigs_players WHERE id =".$user->id);
        $result= $db->loadRow();
        $map= $result[0];
        $grid= $result[1];
        $db->setQuery("SELECT	#__jigs_players.id,#__jigs_players.posx, #__jigs_players.posy, #__comprofiler.avatar
            FROM #__jigs_players
            LEFT JOIN #__comprofiler
            ON #__jigs_players.id = #__comprofiler.user_id
            WHERE grid ='$grid' AND map='$map' AND #__jigs_players.id !='$user->id' AND active =1'");
        $result		= $db->loadAssocList();
        return $result;
    }

    // Called by JiGS.js.php via JSON On successful call the player is moved by mootools
    function save_coordinate()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $posx= JRequest::getvar('posx');
        $posy= JRequest::getvar('posy');
        $map= JRequest::getvar('map');
        $grid= JRequest::getvar('grid');
        $db->setQuery("SELECT active FROM #__jigs_players WHERE id ='$user->id'");
        $active		= $db->loadResult();
        if (active==1)
        {
            $db->setQuery("UPDATE #__jigs_players SET posx = $posx,posy=$posy, map = $map, grid=$grid WHERE id = $user->id");
            $db->query();
            $result		= 'success';
        }
        else
        {
            $result		= 'fail';
        }
        return $result;
    }

    function attack_player()
    {
        $db                 = JFactory::getDBO();
        $player             = JFactory::getUser();
        //$user2			= substr(JRequest::getvar('character'),5);
        $user2              = JRequest::getvar('character');
        $player2            = JFactory::getUser($user2);
        $player->dice       = rand(0, 15);
        $player2->dice      = rand(0, 5);

        // todo reduce this to one call using in array

        $query              = "SELECT health,money,active FROM #__jigs_players WHERE id = $player->id";
        $db->setQuery($query);
        $result             = $db->loadRow();
        $player->health     = $result[0];
        $player->money      = $result[1];
        $player->status     = $result[2];
        $query              = "SELECT health,money,active FROM #__jigs_players WHERE id = $user2";
        $db->setQuery($query);
        $result             = $db->loadRow();
        $player2->health    = $result[0];
        $player2->money     = $result[1];
        $player2->status    = $result[2];
        if ($player2->status!=1)
        {
            $message= "This player is inactive. You cannot attack this player at this time<br/>";
        }
        elseif ($player->status !=1)
        {
            $message= "You are inactive. You cannot attack players at this time<br/>";
        }
        else// roll the dice and let the games begin
        {
            $attack_type        = JRequest::getCmd('type');
            switch ($attack_type)
            {
                ///// If Player shoots test shooting skills + dexterity against NPCs speed //////////////
                case 'shoot':
                    $query= "SELECT #__jigs_weapons.magazine,#__jigs_weapon_names.attack
                                            FROM #__jigs_weapons
                                            LEFT JOIN #__jigs_weapon_names
                                            ON #__jigs_weapons.item_id = #__jigs_weapon_names.id
                                            WHERE #__jigs_weapons.id =" . $player->id_weapon;
                    $db->setQuery($query);
                    $player->weapon		= $db->loadAssoc();
                    $damage                 = (int)(($player->weapon['attack'] * $player->dexterity * $player->level) / $npc->level) + ($player->dice - $npc->dice);
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
                break ;
                case 'kick':
                if ($player->dice > $player2->dice) {
                    $npc->health= intval($npc->health - 30);
                    $attack_message	= "You kick " . $player2->name . "and inflict 30 damage points to his health.You: $player->health ,Opponent: $npc->health ";
                } else {
                    $player->health	=intval($player->health - 10);
                    $attack_message	="You kick " . $player2->name . "and miss and incur 10 damage points to your health.You: $player->health ,Opponent: $npc->health ";
                }
                break;

                // If Player punches, test punch and other fighting skills + speed + dexterity against NPCs speed /////////////
                case 'punch':
                if ($player->dice >= $npc->dice)
                {
                    $npc->health=intval($player2->health - 20);
                    $attack_message	= "You punch " . $npc->name . "and inflict 20 damage points to his health.You: $player->health ,Opponent: $npc->health";
                }
                else
                {
                    $player->health = intval($player->health - 10);
                    $attack_message = "You punch " . $player2->name . "and miss and incur 10 damage points to your health.You: $player->health ,Opponent: $npc->health";
                }
                break;

            }

            if ($player2->health <= 0)
            {
                $now                = time();
                $player->money      =  $player->money + $player2->money;
                $player2->money     = 0;
                $query              = "UPDATE #__jigs_players
                  SET active = 3,  grid=1, map= 3, posx = 4, posy=5, empty= 1 , time_killed = $now
                    WHERE id        = $user2";
                $db->setQuery($query);
                $db->query();
                $query             = "UPDATE #__jigs_inventory
                    SET #__jigs_inventory.player_id = $player->id
                    WHERE #__jigs_inventory.player_id = $player2->id ";
                $db->setQuery($query);
                $db->query();
                $query              = "UPDATE #__jigs_players SET nbr_kills=nbr_kills+1, money = $player->money
                    WHERE #__jigs_players.id = $player->id" ;
                $db->setQuery($query);
                $db->query();
                $query 		        = "UPDATE #__jigs_players SET money = $player2->money WHERE #__jigs_players.id = $player->id";
                $db->setQuery($query);
                $db->query();
                $text		        = 'Citizen ' . $player2->username  . ' was hospitalised by citizen ' . $player->username ;
                $message	    = "You put " . $player2->username . " into hospital.";
                $this->sendWavyLines($text);
            }
            $db->setQuery("UPDATE #__jigs_players SET health='" . $player->health. "'  WHERE id ='" . $player->id . "'");
            $db->query();
            $db->setQuery("UPDATE #__jigs_players SET health='" . $player2->health. "'  WHERE id ='" . $player2->id . "'");
            $db->query();
        }
        $results[0]	                = $player->health;
        $results[1]	                = $player2->health;
        $results[2]	                = $message;

        MessagesHelper::sendFeedback($player->id,$message);

        return $results;
    }

    function attack_character()
    {
        $db                 = JFactory::getDBO();
        $user               = JFactory::getUser();
        $character_id       = JRequest::getInt('character');
        $sql                = "SELECT id, health, money, final_attack, final_defence, dexterity, level, id_weapon
        FROM #__jigs_players
        WHERE id = " . $user->id;
        $db->setQuery($sql);
        $player	            = $db->loadObject();
        $player->dice       = rand(0, 15);
        $query= "SELECT id, name, level, health, money FROM #__jigs_characters WHERE id =" . $character_id;
        $db->setQuery($query);
        $npc                = $db->loadObject();
        $npc->dice          = rand(0, 5);
        $attack_type2        = JRequest::getCmd('type');

        switch ($attack_type2)
        {
            ///// If Player shoots test shooting skills + dexterity against NPCs speed //////////////
            case 'shoot':
                $query= "SELECT #__jigs_weapons.magazine,#__jigs_weapon_names.attack
                                            FROM #__jigs_weapons
                                            LEFT JOIN #__jigs_weapon_names
                                            ON #__jigs_weapons.item_id = #__jigs_weapon_names.id
                                            WHERE #__jigs_weapons.id =" . $player->id_weapon;
                $db->setQuery($query);
                $player->weapon		= $db->loadAssoc();
                $damage                 = (int)(($player->weapon['attack'] * $player->dexterity * $player->level) / $npc->level) + ($player->dice - $npc->dice);

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
                $npc->health= intval($npc->health - 30);
                $attack_message	= "You kick " . $npc->name . "and inflict 30 damage points to his health.You: $player->health ,Opponent: $npc->health ";
            }
            else
            {
                $player->health	=intval($player->health - 10);
                $attack_message	="You kick " . $npc->name . "and miss and incur 10 damage points to your health.You: $player->health ,Opponent: $npc->health ";
            }
            break;
            // If Player punches, test punch and other fighting skills + speed + dexterity against NPCs speed /////////////
        case 'punch':
            if ($player->dice >= $npc->dice)
            {
                $npc->health=intval($npc->health - 20);
                $attack_message = "You punch " . $npc->name . "and inflict 20 damage points to his health.You: $player->health ,Opponent: $npc->health";
            }
            else
            {
                $player->health = intval($player->health - 10);
                $attack_message = "You punch " . $npc->name . "and miss and incur 10 damage points to your health.You: $player->health ,Opponent: $npc->health";
            }
            break;
        }
        ////////////////////////////////////////// If NPC is dead ////////////////////////////////////
        if ($npc->health <= 0)
        {
            $npc->health = 0;
            $this->dead_npc($npc);
        }
        ////////////////////////////////////////// If Player is dead ////////////////////////////////////
        if ($player->health <= 0)
        {
            $player->health = 0;
            $this->dead_player($npc->name);
        }
        /////////////////////////////////////// Now update everybodys stats to database //////////////////
        $sql = "UPDATE #__jigs_players SET health = $player->health WHERE id = $user->id ";
        $db->setQuery($sql);
        $db->query();
        $sql = "UPDATE #__jigs_characters SET health = $npc->health WHERE id = $npc->id";
        $db->setQuery($sql);
        $db->query();
        $magazine = $player->weapon['magazine'];
        $sql = "UPDATE #__jigs_weapons SET magazine = $magazine  WHERE id = $player->id_weapon";
        $db->setQuery($sql);
        $db->query();
        MessagesHelper::sendFeedback($player->id,$attack_message);
        $result[0]  = $player->health;
        $result[1]  = $npc->health;
        $result[2]  = $attack_message;
        $result[3]  = $player->weapon['magazine'];
        return $result;
    }
    function dead_npc($npc)
    {
        $db	 = JFactory::getDBO();
        $user = JFactory::getUser();
        $now = time();
        $sql = "UPDATE #__jigs_characters SET active = 0, empty = 1 , time_killed = $now WHERE id  = $npc->id";
        $db->setQuery($sql);
        $db->query();
        $sql = "UPDATE #__jigs_inventory SET #__jigs_inventory.player_id = $user->id WHERE #__jigs_inventory.player_id = $npc->id";
        $db->setQuery($sql);
        $db->query();
        //// Update specific and General stats and payout when applicable
        $xp_type= 'nbr_kills';
        $this->increment_xp($xp_type,$user->id);
        $player_money = $this->get_player_money($db,$user);
        $player_money = $player_money + $npc->money;
        $this->update_player_money($db,$player_money,$user);
        $text= 'Citizen ' . $npc->name . ' was hospitalised by citizen ' . $user->username . '<br/>' ;
        $this->sendWavyLines($text);
        $text = "You hospitalised citizen $npc->name <br/>";
        $text.= "You took $npc->money credits <br/>";
        $text.= "You picked up some items<br/>";
        MessagesHelper::sendFeedback($user->id, $text);
        return $text;
    }

    function dead_player($winner)
    {
        $user   = JFactory::getUser();
        $db     = JFactory::getDBO();
        $now    = time();
        $db->setQuery("UPDATE #__jigs_players SET active = 3,  grid=1, map= 3, posx = 4, posy=5, empty= 1 , time_killed = " . $now . "
                WHERE id ='".$user->id."'");
        $db->query();
        $db->setQuery("UPDATE #__jigs_inventory SET #__jigs_inventory.player_id = $winner WHERE #__jigs_inventory.player_id = " . $user->id );
        $result = $db->query();
        $db->setQuery("UPDATE #__jigs_players SET money = 0 WHERE #__jigs_players.id = " .   $user->id ) ;
        $result = $db->query();
        //	$text= 'Citizen ' . $character_id  . ' was killed by citizen ' . $user->username ;
        //	$db->setQuery("INSERT INTO #__shoutbox (name, time, text) VALUES ('Wavy Lines:', " . $now .", '" . $text ."' )" ) ;
        //	$db->query() ;
        $text   = 'Citizen ' .  $user->username  . ' was put in hospital by ' . $winner ;
        $db->setQuery("INSERT INTO #__shoutbox (name, time, text) VALUES ('Wavy Lines:', " . $now .", '" . $text ."' )" ) ;
        $db->query() ;
    }
  
    function increment_xp($xp_type,$user_id)
    {
        $db    = JFactory::getDBO();
        $query = "UPDATE #__jigs_players SET $xp_type  = $xp_type + 1, xp = xp+1, WHERE #__jigs_players.id = " .  $user_id;
        $db->setQuery($query);
        $db->query();
        $this->test_level($user_id);
        return $query;
    }

    function test_level($user_id)
    {
        $user       = JFactory::getUser();
        $db         = JFactory::getDBO();
        $now        = time();
        $query      = "SELECT xp FROM #__jigs_players where id = $user_id";
        $db->setQuery($query);
        $xp	        = $db->loadResult();
        $milestones = array(100,200,400,800,1600,2000,4000,8000);
        foreach ($milestones as $check)
        {
            if ($xp == $check)
            {
                $query	= "UPDATE #__jigs_players SET level=level+1, statpoints = statpoints + 5 WHERE id = $user_id";
                $db->setQuery($query);
                $db->query();
                $text	= 'Citizen ' . $user->username . ' leveled up';
                $this->sendWavyLines($text);
                MessagesHelper::sendFeedback($user->id,$text);
            }
        }
    }

    function swap()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $weapon_id  = JRequest::getvar('weapon_id');
        //todo does player own this weapon type?
        $db->setQuery("UPDATE #__jigs_players SET id_weapon = '" . $weapon_id . "' WHERE id =".$user->id);
        $db->query();
        $result    = $weapon_id ;
        return $result;
    }

    function deposit()
    {
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $qty            = JRequest::getvar('amount');
        $building_id    = JRequest::getvar('building_id');
        $now            = time();
        $db->setQuery("Select money, bank FROM #__jigs_players WHERE id = " . $user->id);
        $result         = $db->loadRow();
        $money          = $result[0];
        $bank           = $result[1];
        if ($qty <= $money)
        {
            $money = $money - $qty;
            $ban   = $bank + $qty;
            $query = "UPDATE #__jigs_players SET money = $money, bank = $bank  WHERE id = " . $user->id;
            $db->setQuery($query);
            $db->query();
        }
        return $result;
    }

    function withdraw()
    {
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $qty            = JRequest::getvar('amount');
        $building_id    = JRequest::getvar('building_id');
        $now            = time();
        $db->setQuery("Select money, bank FROM #__jigs_players WHERE id = ".$user->id);
        $result         = $db->loadRow();
        $money          = $result[0];
        $bank           = $result[1];

        if ($qty <= $bank){
            $money      = $money + $qty;
            $bank       = $bank - $qty;
            $query      = "UPDATE #__jigs_players SET money = $money, bank = $bank  WHERE id =" . $user->id;
            $db->setQuery($query);
            $db->query();
        }
        return $result;
    }

/*
    function buy_bullets()
    {
        $db		= JFactory::getDBO();
        $user		= JFactory::getUser();
        $qty		= JRequest::getvar('amount');
        $building_id	= JRequest::getvar('building_id');
        $now		= time();
        $db->setQuery("Select money, ammunition FROM #__jigs_players WHERE id = ".$user->id);
        $result		    = $db->loadRow();
        $money		    = $result[0];
        $ammunition	    = $result[1];

        if ($qty <= $money){
            $money	    = $money - $qty;
            $ammunition	= $ammunition + $qty;
            $query	    = "UPDATE #__jigs_players SET money = $money, ammunition = $ammunition  WHERE id =" . $user->id;
            $db->setQuery($query);
            $db->query();
        }
        return $result;
    }
*/

    function eat()
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $query  = $db->getQuery(true);
        $query->select('health, money');
        $query->from('#__jigs_players');
        $query->where('id = ' . $user->id);
        $db->setQuery($query);
        $result = $db->loadAssoc();
        $health = $result['health'];
        $money  = $result['money'];
        // return json_encode($query);

        if ($money > 10)
        {
            $money  = $money - 10;
            $health = $health + 100;

            if ($health >100){
                $health = 100;
            }
            $sql    = "Update #__jigs_players SET money = $money, health = $health WHERE id= " . $user->id;
            $db->setQuery($sql);
            $db->query();
            $return = "success";
        }
        else
        {
            $return	= "broke";
        }

    return $return;
    }

    function get_total_crops()
    {
        $total_crop = 0;
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $query      = "SELECT total FROM #__jigs_farms
                        LEFT JOIN #__jigs_buildings
                        ON #__jigs_farms.building = #__jigs_buildings.id
                        WHERE #__jigs_buildings.owner = $user->id; ";
        $db->setQuery($query);
        $result     = $db->loadResultArray();
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

        $component  = JComponentHelper::getComponent( 'com_battle' );
        $params     = new JParameter( $component->params );
        $sbid       = $params->get( 'shoutbox_category' );
        $db         = JFactory::getDBO();
        $now        = time();
        $sql        = "INSERT INTO #__shoutbox (name, time,sbid, text) VALUES ('Wavy Lines:', $now,$sbid, '$text' )";
        $db->setQuery($sql);
        $db->query();
        return $sql;
    }

    function sendFeedback($id,$text)
    {
        $db         = JFactory::getDBO();
        $query      = "INSERT INTO #__jigs_logs (user_id, message) VALUES ($id,'$text')";
        $db->setQuery($query) ;
        $db->query();
        return ;
    }
    function get_free_seeds(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $query          = "SELECT seed_list FROM #__jigs_crop_seeds WHERE #__jigs_crop_seeds.owner = $user->id ";
        $db->setQuery($query);
        $result         = $db->loadResult();
        $result_array   = explode(',',$result);
        if (!in_array(1,$result_array)){

            $result_array[] = 1;
            $string         = implode($result_array,',');
            $sql            = "UPDATE #__jigs_crop_seeds SET seed_list ='" . $string ."' WHERE owner= $user->id";
            $db->setQuery($sql);
            $db->query();
        }
        return ($sql);
    }

    function attackMonster(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id            = JRequest::getvar('id');

        $query          = "SELECT * FROM #__jigs_monsters WHERE id= $id";
        $db->setQuery($query);
        $result     = $db->loadResultArray();


        $query          = "UPDATE #__jigs_monsters SET health = health -10 WHERE id= $id";




        $db->setQuery($query);
        $db->query();



        $query          = "SELECT health FROM  #__jigs_monsters WHERE id= $id";
        $db->setQuery($query);
        $result['id']    =  $id  ;
        $result['health']     = $db->loadResult();



        $entryData = array(
            'category' => 'monsterHealthCategory',
            'title'    => 'title',
            'article'  => $result,
            'when' => time()  );
        $context    = new ZMQContext();
        $socket     = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
        if($socket->connect("tcp://localhost:5555")){
            //   echo 'connected';
        };
        if($socket->send(json_encode($entryData))) {
          //  echo 'delivered';
        };

        return true;
    }
}



