<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modellist');

jimport( 'joomla.filesystem.folder' );

require_once JPATH_COMPONENT.'/helpers/messages.php';
require_once JPATH_COMPONENT.'/helpers/energy.php';

class BattleModelShop extends JModellegacy
{

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
            $query2= "INSERT INTO #__jigs_objects (player_id , item_id) VALUES (" . $user->id . " , " . $item . ")";
            $message = "You bought the object";
        }
        if ($buy=='batteries')
        {
            $query2= "INSERT INTO #__jigs_batteries (charge_percentage,capacity,id) VALUES (100,10,$user->id)";
            $message = "You bought the battery";
        }
        if ($buy=='weapon')
        {
            $query= "SELECT sell_price FROM #__jigs_weapon_types WHERE #__jigs_weapon_types.id = " . $item;
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
            $query2	= "DELETE FROM #__jigs_objects WHERE #__jigs_objects.player_id = $user->id  AND item_id= $item LIMIT 1";
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
            $query1= "SELECT sell_price FROM #__jigs_weapon_types WHERE id = ". $item ;
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





    function get_shop_blueprints()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_blueprints.object, #__jigs_blueprints.sell_price, #__jigs_object_types.name
                FROM #__jigs_blueprints
                LEFT JOIN  #__jigs_object_types
                ON #__jigs_blueprints.object = #__jigs_object_types.id WHERE #__jigs_blueprints.user_id =" . $building_id);
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
        $db->setQuery("SELECT #__jigs_spells.item_id, #__jigs_spells.sell_price, #__jigs_spell_types.name
        FROM #__jigs_spells LEFT JOIN  #__jigs_spell_types ON #__jigs_spells.item_id = #__jigs_spell_types.id
        WHERE #__jigs_spells.player_id =" . $building_id);
        $result= $db->loadAssocList();
        return $result;
    }

    function get_shop_weapons()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_weapons.item_id, #__jigs_weapon_types.sell_price, #__jigs_weapon_types.name
        FROM #__jigs_weapons LEFT JOIN  #__jigs_weapon_types ON #__jigs_weapons.item_id = #__jigs_weapon_types.id
        WHERE #__jigs_weapons.player_id =" . $building_id);
        $result= $db->loadAssocList();
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

    ////////////////////////////////////////////////////////////////////////////

    function get_shop_inventory()
    {
        $db= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id= JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_shop_prices.item_id, #__jigs_object_types.name, #__jigs_shop_prices.sell_price
                FROM #__jigs_shop_prices
                LEFT JOIN #__jigs_object_types
                ON #__jigs_shop_prices.item_id = #__jigs_object_types.id
                WHERE #__jigs_shop_prices.shop_id =" . $building_id);
        $result= $db->loadAssocList();
        return $result;
    }

    function get_shop_metals()
    {
        $db	= JFactory::getDBO();
        $building_id= JRequest::getvar('building_id');
        $query = "
            SELECT #__jigs_shop_metal_prices.item_id, #__jigs_metal_types.name, #__jigs_shop_metal_prices.sell_price
            FROM #__jigs_shop_metal_prices
            LEFT JOIN #__jigs_metals
            ON #__jigs_shop_metal_prices.item_id = #__jigs_metals.id
            LEFT JOIN #__jigs_metal_types
            ON #__jigs_metal_types.id = #__jigs_shop_metal_prices.item_id
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
        $db->setQuery("SELECT #__jigs_crystal_prices.item_id, #__jigs_crystal_types.name, #__jigs_crystal_prices.sell_price
            FROM #__jigs_crystal_prices
            LEFT JOIN  #__jigs_crystal_types
            ON #__jigs_crystal_prices.item_id = #__jigs_crystal_types.id
            WHERE #__jigs_crystal_prices.shop_id =" . $building_id);
        $result = $db->loadAssocList();
        return $result;
    }

    function get_metals_for_sale()
    {
        $db	= JFactory::getDBO();
        $user= JFactory::getUser();
        $building_id=  JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_objects.item_id, #__jigs_object_types.name, #__jigs_shop_prices.buy_price
        FROM #__jigs_objects LEFT JOIN #__jigs_object_types
        ON #__jigs_objects.item_id = #__jigs_object_types.id
        LEFT JOIN #__jigs_shop_prices ON #__jigs_objects.item_id = #__jigs_shop_prices.item_id
        WHERE #__jigs_objects.player_id = $user->id AND #__jigs_shop_prices.shop_id = $building_id ");
        $result = $db->loadAssocList();
        return $result;
    }

}
