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
        $time_string	= gmdate("Y-m-d \T H:i:s ", $now);
        $message		= "Cron activated at " . $time_string;
        $this->sendMessage($now,$message);
        $this->heartbeat();
        return ;

    }

    function heartbeat()
    {
        $now		= time();
        $this->sendMessage($now,'heartbeat begun');
        $result_1	= $this->check_factories();
        $result_2	= $this->check_reprocessors();
        $result_3	= $this->check_mines();
        $result_4	= $this->check_farms();
        $result_5	= $this->respawn();
        $result_6	= $this->check_apartments();
        //$result	= $this->get_players();
        $result_7	= $this->events();
        $result_8	= $this->check_generators();
        $result_9   = $this->update_groups();
        $result_10  = $this->check_rents();
        //$result_11	= $this->move_monsters();// moved to SiGS
        $result_12	= $this->update_pos();

        $now		= time();
        $this->sendMessage($now,'heartbeat complete');
        return ;
    }

    public function run_min_15()
    {
        $now			= time();
        $time_string	= gmdate("Y-m-d \T H:i:s ", $now);
        $message		= "Less Regular Cron activated at " . $time_string;
        $this->sendMessage($now,$message);
        $this->min_15();
        return ;
    }

    public function run_daily()
    {
        $now			= time();
        $time_string	= gmdate("Y-m-d \T H:i:s ", $now);
        $message		= "Daily Cron activated at " . $time_string;
        $this->sendMessage($now,$message);
        $this->daily();
        return;
    }

    public function daily()
    {
        $db 	    = JFactory::getDBO();
        $now		= time();
        $this->sendMessage($now,'Daily begun');
        $this->update_groups();
        $this->update_dividends();
        $this->add_daily_battery();
        return;
    }

    public function add_daily_battery()
    {
        $db         	= JFactory::getDBO();
        $now			= time();
        $time_string	= gmdate("Y-m-d \T H:i:s ", $now);
        $query			= "SELECT id, name FROM #__jigs_players";
        $db->setQuery($query);
        $playerlist		= $db->loadObjectList();

        foreach ($playerlist as $player)
        {
            $query					= "SELECT id From #__jigs_batteries WHERE user = $player->id";
            $db->setQuery($query);
            $db->query();
            //$playerlist		= $db->loadObjectList();
            $player->batteries = $db->getNumRows();

            if ($player->batteries < 6)
            {
                $query = "INSERT INTO #__jigs_batteries (user,timestamp) VALUES ($player->id, $player->batteries)";
                        $db->setQuery($query);
                        $db->query();
                        $message		= "Citizen $player->name received one battery at " . $time_string;
                        $this->sendMessage($now,$message);
            }
        }
        return;
    }

    public function update_dividends()
    {
        $now			= time();
        $time_string	= gmdate("Y-m-d \T H:i:s ", $now);
        $db         	= JFactory::getDBO();
        $query			= "UPDATE #__jigs_players SET bank = bank  + 100 WHERE 1 = 1";
        $db->setQuery($query);
        $db->query();
        $message		= "Dividends paid at  " . $time_string;
        $this->sendMessage($now,$message);
        return;
    }

    public function min_15()
    {
        $db 	    = JFactory::getDBO();
        $now		= time();
        $this->sendMessage($now,'Regular begun');
        $this->update_groups();
        return;
    }

    public function update_groups()
    {
        $db         = JFactory::getDBO();
        $factions    = array(35,36,42);

        foreach ($factions as $faction)
        {		
            $groups = $this->get_faction_groups($faction);
            if ($groups)
            {
                foreach ($groups as $group)
                {
                    $query          = "SELECT * FROM #__user_usergroup_map 
                        LEFT JOIN #__jigs_players 

                        ON #__user_usergroup_map.user_id = #__jigs_players.id
                        
                        WHERE group_id = $group ORDER BY #__jigs_players.xp DESC";

                    $db->setQuery($query);
                    $userlist = $db->loadObjectList();
                    $captain = $userlist[0]->id;
                    //$total = stdclass();
                    $total->$group->members = 0;
                    foreach ($userlist as $user){

                        $total->$group->members     = $total->$group->members + 1;
                        $total->$group->xp          += $user->xp;
                        $total->$group->money       += $user->money;
                        $total->$group->bank        += $user->bank;

                    }
                    $one        = $total->$group->members; 
                    $two        = $total->$group->xp ;
                    $three      = $total->$group->money;
                    $four       = $total->$group->bank ;  

                    $query = "INSERT INTO #__jigs_groups (gid,total_members, total_xp , total_money ,total_bank,captain ) 
                    VALUES ($group,$one,$two,$three,$four,$captain)
                    ON DUPLICATE KEY UPDATE 

                        total_members =  $one,
                        total_xp  =  $two,
                        total_money = $three,
                        total_bank = $four,
                        captain = $captain
                        ";
                    $db->setQuery($query);
                    $db->query();
                }
            }
        }
        return ;
    }

    public function get_faction_groups($faction)
    {
        $db         = JFactory::getDBO();
        $query      = "SELECT id FROM #__usergroups where parent_id = $faction";
        $db->setQuery($query);
        return $db->loadColumn();
    }

    public function get_userlist($group)
    {
        $db         = JFactory::getDBO();
        $query      = "SELECT user_id FROM #__user_usergroup_map WHERE group_id = $group";
        $db->setQuery($query);
        return $db->loadColumn();
    }

    public function get_user($user)
    {
                $db             = JFactory::getDBO();
                $query          = "SELECT * FROM #__jigs_players WHERE id = $user";
                $db->setQuery($query);
                return $db->loadObject();
    }

    /*
    function move_monsters(){$db 	= JFactory::getDBO();

        $db 	        = JFactory::getDBO();
        $query	        = "SELECT id from #__jigs_monsters";
        $db->setQuery($query);
        $result		    = $db->loadAssoclist();

        $random_index   = rand(1,count($result));

        $query          = "UPDATE #__jigs_monsters SET x =x+100 WHERE id = $random_index";
        $db->setQuery($query);
        $db->query();
        return $query;
    }
*/
    function events(){

        $choice = rand (0,2);

        switch ($choice){

            case 0:
            $text	= $this->local();
            break;

            case 1:
            $text	= $this->npc_v_npc();
            break;

            case 2:
            $text	= $this->personel();
            break;

            default:
            $text   = "And so on";
        }
        $this->sendWavyLines($text);
    }

    function local(){

        $local = rand (0,5);

                switch ($local){

                    case 0:
                    $text				= "Something Happens";
                    break;

                    case 1:
                    $text				= "Time Passes";
                    break;

                    case 2:
                    $text				= "A Virus Spreads";
                    break;

                    case 3:
                    $text				= "A terrorist attack!";
                    break;

                    case 4:
                    $text				= "A Zombie attack!";
                    break;

                    default:
                        $text           ="And so on";
                    break;


                }
        return $text;
    }

    function personel(){

    $personel = rand (0,2);

                switch ($personel){

                    case 0:
                    $text				= $this->converted_to();
                    break;

                    case 1:
                    $text				= $this->is_afraid_of();
                    break;

                    case 2:
                    $text				= $this->is_feeling();
                    break;
                    }
    return $text		;

    }






    function increment_xp($xp_type ,$payment,$user_id)
    {
        $db 	= JFactory::getDBO();
        $query	="UPDATE #__jigs_players SET $xp_type  = $xp_type  +1, xp = xp+1, money = money + " . $payment .
            " WHERE #__jigs_players.id = " .  $user_id;
        $db->setQuery($query);
        $db->query();
        $this->test_level($user_id);
        return $query;
    }

    function test_level($user_id)
    {
        $user	= JFactory::getUser();
        $db	= JFactory::getDBO();
        $now	= time();
        $query	= "SELECT xp FROM #__jigs_players where id = $user_id";
        $db->setQuery($query);
        $xp		= $db->loadResult();
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
                $this->sendFeedback($user->id,$text);
            }
        }
    }

    function getName()
    {
    }

    function respawn()
    {
        $db		= JFactory::getDBO();
        $query		= "SELECT id from #__jigs_characters WHERE #__jigs_characters.empty = 1";
        $db->setQuery($query);
        $result		= $db->loadObjectlist();
        $now		= time();
        $time_string	= gmdate("Y-m-d \T H:i:s ", $now);
        $message	= "Respawning at " . $time_string;
        $this->sendMessage($now,$message);

        $dead		= count($result);
        $this->sendMessage($now,"there are " . $dead . " respawns");

        if ($result)
        {
            foreach ($result as $row)
            {
                $number_of_items = rand(1,3);
                for ($i=0 ;$i<$number_of_items;$i++){
                    $item_id		= rand(1, 15);
                    $db->setQuery("INSERT INTO #__jigs_inventory (item_id, player_id ) VALUES (" . $item_id . " ,  " .  $row->id  . ")");
                    $db->query();
                }
                $db->setQuery("UPDATE #__jigs_characters SET empty = 0 WHERE id = " .  $row->id );
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

    function get_monsters()
    {
        $db     = JFactory::getDBO();

        $query  = "SELECT grid FROM #__jigs_players WHERE id =63";
        $db->setQuery($query);
        $grid   = $db->loadResult();
        if ($grid<1){
            $grid = 1;
        }
        $db->setQuery("SELECT #__jigs_monsters.id,
                                #__jigs_monsters.type,
                                #__jigs_monsters.grid,
                                #__jigs_monsters.x,
                                #__jigs_monsters.y,
                                #__jigs_monsters.health,
                                #__jigs_monster_types.name,
                                #__jigs_monster_types.level,
                                #__jigs_monster_types.spritesheet,
                                #__jigs_monster_types.cellwidth,
                                #__jigs_monster_types.cellheight,
                                #__jigs_monster_types.numberofcells

                                FROM #__jigs_monsters
                                LEFT JOIN #__jigs_monster_types
                                ON  #__jigs_monsters.type = #__jigs_monster_types.id
                                WHERE grid = 99 AND active = 1 ");
        $result = $db->loadObjectlist();
        return $result;
    }

    function check_reprocessors()
    {
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

        if ($result)
        {
            foreach ($result as $row)
            {
                $query	= "SELECT #__jigs_metals.quantity FROM #__jigs_metals
                    WHERE player_id = $row->owner AND item_id = $row->metal1";
                $db->setQuery($query);
                $metal1_quantity        = $db->loadResult();

                if(!$metal1_quantity)
                {
                    $playa	= JFactory::getUser($row->owner);
                    $this->sendFeedback($playa->id ,$query);
                }

                $query	= "SELECT #__jigs_metals.quantity FROM #__jigs_metals
                    WHERE player_id = $row->owner AND item_id = $row->metal2";
                $db->setQuery($query);
                $metal2_quantity = $db->loadResult();

                if(!$metal2_quantity)
                {
                    $playa	= JFactory::getUser($row->owner);
                    $this->sendFeedback($playa->id ,$query);
                }

                $total_metal_1	= $metal1_quantity + $row->quantity_1;
                $total_metal_2	= $metal2_quantity + $row->quantity_2;

                $query	= "INSERT INTO #__jigs_metals (player_id , item_id, quantity)
                    VALUES ($row->owner, $row->metal1, $total_metal_1)
                    ON DUPLICATE KEY UPDATE quantity = $total_metal_1 ";
                $db->setQuery($query);

                if(!$db->query())
                {
                    $playa      = JFactory::getUser($row->owner);
                    $this->sendFeedback($playa->id ,$query);
                }

                $query	    = "INSERT INTO #__jigs_metals (player_id , item_id,quantity)
                    VALUES ($row->owner, $row->metal2, $total_metal_2)
                    ON DUPLICATE KEY UPDATE  quantity= $total_metal_2 ";
                $db->setQuery($query);

                if(!$db->query())
                {
                    $playa = JFactory::getUser($row->owner);
                    $this->sendFeedback($playa->id ,$query);
                }

                $xp_type	= 'nbr_objs';
                $increment	= $this->increment_xp($xp_type ,0,$row->owner);

                // send wavy lines

                $playa		= JFactory::getUser($row->owner);
                $playa_name	= $playa->username;
                $playa_id	= $playa->id;
                $text		= "Citizen  $playa_name  has reprocessed  $row->type_quantity " .  $row->type_name ."(s)";
                $this->sendWavyLines($text);
                $this->sendFeedback($playa_id ,$text);
                $this->sendMessage($now,$text);
                // end wavy lines
            }
            // Now Simply reset all factories where remainging time is less that zero
            $query ="UPDATE #__jigs_reprocessors SET timestamp = 0,finished = 0 WHERE finished !=0 AND finished < " . $now;
            $db->setQuery($query);
            $db->query();
        }// end if

        return $query;
    }

    function check_mines()
    {

        //$user		= JFactory::getUser();
        $now		= time();
        $db		= JFactory::getDBO();
        $duration	= $now - 50;
        $query		= "SELECT #__jigs_mines.building,
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
                $type_crystal	= rand( 1 , 30 );
                $query		=
                    "INSERT INTO #__jigs_crystals (player_id , item_id, quantity )
                    VALUES($row->owner ,$type_crystal, 1)
                    ON DUPLICATE KEY UPDATE quantity = quantity + 1";
                $db->setQuery($query);
                $db->query();
                $text	= 'Citizen ' . $playa_name  . ' has mined 1 unit of crystal:' . $type_crystal ;
                $text2	= 'You mined 1 unit of crystal:<br/>' ;
            }
            if ($row->type==2)
            {
                $type_metal = rand( 1 , 32 ) ;
                if ($type_metal>16)
                {
                    $type_metal = 1;
                }

                $query	="INSERT INTO #__jigs_metals (player_id , item_id, quantity )
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
                $query_1	="SELECT money FROM #__jigs_players WHERE id = '$row->owner'";
                $db->setQuery($query_1);
                $money_saved	= $db->loadResult();
                $money		= $money_saved + $payment;
                $x		= "UPDATE #__jigs_players SET money = $money WHERE id = " . $row->owner;
                $db->setQuery($x);
                $db->query();
                $text		= 'Citizen ' . $playa_name  . ' has mined 1 unit of oil:' ;
                $text2		= 'You mined 1 unit of oil:<br/>' ;
                $xp_type	= 'nbr_drills';
                $test		= $this->increment_xp($xp_type ,0,$row->owner);
            }

            $this->sendFeedback($playa_id, $text2);
            $this->sendWavyLines($text);
            $this->sendMessage($now,$text);
            $query = "UPDATE #__jigs_mines SET timestamp = 0 WHERE timestamp < ". $duration;
            $db->setQuery($query);
            $db->query();
        }
        return ;
    }

    function check_farms()
    {
        $user	= JFactory::getUser();
        $now	= time();
        $db	= JFactory::getDBO();
    // Find all fields where finished(unix time) has passed
        $query ="SELECT #__jigs_farms.finished,
            #__jigs_farms.field,
            #__jigs_farms.status,
            #__jigs_farms.crop,
            #__jigs_farms.amount,
            #__jigs_farms.building,

            #__jigs_buildings.owner,
            #__jigs_buildings.quality_rate

            FROM #__jigs_farms
            LEFT JOIN #__jigs_buildings
            ON #__jigs_farms.building = #__jigs_buildings.id
            WHERE #__jigs_farms.finished !=0 AND  #__jigs_farms.finished < ". $now;
        $db->setQuery($query);
        $result	= $db->loadObjectlist();
        $crop_quantity_index = 10; // gamesmaster global score
        // loop through field array giving out rewards of type
        // 0 : Barren/Harvested
        // 1 : Tilling
        // 2 : Tilled
        // 3 : Sowing
        // 4 : Sowed
        // 5 : Harvesting
        // 6 : Harvested/ Barren
        if ($result)
        {
            foreach ($result as $row)
            {
                $row->status++;
                $row->finished	= 0;
                //$crop= $row->crop;
                // If Field is harvested
                if ($row->status >= 6)
                {
                    $index		= $row->quality_rate * 3 * $crop_quantity_index;
                    //$harvested	= $row->crop - (1000 - (int) $index);
                    $harvested	= 950;
                    $query		= "INSERT INTO #__jigs_crops(owner, type, amount)
                     values ($row->building, $row->crop, $harvested)
                     On Duplicate KEY UPDATE amount = amount + $harvested";
                    $db->setQuery($query);
                    $db->query();
                    //$row->total++;
                    $row->status	= 0;
                    // send wavy lines
                    $playa		= JFactory::getUser($row->owner);
                    $playa_name	= $playa->username;
                    $playa_id	= $playa->id;
                    $text		= 'Citizen ' . $playa_name  . ' has harvested 1 field ' ;
                    $this->sendWavyLines($text);
                    $this->sendFeedback ($playa_id,$text);
                    $this->sendMessage($now,$text);
                    // end wavy lines
                }
                /////////////////////////////$total = $row->total,/////////////////////////////////////////////////////////////
                $query		= "UPDATE #__jigs_farms SET status	= $row->status,
                    timestamp = $now,
                    finished = $row->finished
                    WHERE building	= $row->building
                    AND field = $row->field";
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
        $user 		    = JFactory::getUser();
        $now		    = time();
        $time_string	= gmdate("Y-m-d \T H:i:s ", $now);
        $this->sendMessage($now,'factories check begun at'. $time_string );

        $db 		    = JFactory::getDBO();
        // Find all factories where finished(unix time) has passed
        $query="SELECT #__jigs_factories.finished,
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

        $result         = $db->loadObjectlist();

        $text           = "checking " . count($result) . " factories";
        $now            = time();
        $this->sendMessage($now,$text);


        // loop through factory array giving out rewards of type

        if ($result)
        {
            foreach ($result as $row)
            {
                $quantity 		= $row->quantity;
                $this->sendMessage($now, "quantity is " . $quantity);

                for ($i=1;$i <= $quantity ;$i++){
                    $query1		= "INSERT INTO #__jigs_inventory (player_id , item_id) VALUES ($row->owner ,$row->type)";
                    $db->setQuery($query1);
                    $db->query();
                    $xp_type	= 'nbr_objs';
                    // $increment	= $this->increment_xp($xp_type ,0,$row->owner);
                    // send wavy lines
                    $playa		= JFactory::getUser($row->owner);
                    $playa_name	= $playa->username;
                    $this->sendMessage($now,'owner is ' . $playa_name);
                    $playa_id	= $playa->id;
                    $text		= 'Citizen ' . $playa_name  . ' has created 1 ' . $row->name ;
                    $this->sendWavyLines($text);
                    //$this->sendFeedback($playa_id ,$text);
                    $this->sendMessage($now,$text);
                    // end wavy lines

                }
            }
            // Now Simply reset all factories where remainging time is less that zero
            $query = "UPDATE #__jigs_factories SET timestamp = 0,finished = 0 WHERE finished !=0 AND finished < " . $now;
            $db->setQuery($query);
            $db->query();
        }// end if

        $this->sendMessage($now,'factories checked');
        return $query;
    }

    function check_generators()
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $now    = time();
        $query  = "SELECT * FROM #__jigs_generators ";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        foreach($result as $row)
        {
            $query ="Update #__jigs_batteries SET  units = units + 1, timestamp =  $now WHERE user = $row->building AND units < 100";
            $db->setQuery($query);
            $db->query();
        }

        $this->sendMessage($now,'generators checked');
        return ;
    }


        function check_apartments()
    {
        //$user 	= JFactory::getUser();
        $now		= time();
        $db 		= JFactory::getDBO();
        // Find all factories where finished(unix time) has passed
        $expire		= $now - (1*60*60*1);//1 hour ago
        $query		= "SELECT * FROM #__jigs_flats WHERE #__jigs_flats.timestamp < $expire AND timestamp != 0";
        $db->setQuery($query);
        $result		= $db->loadObjectlist();
        $rent		= 10;
        $text		= count($result);
        $this->sendMessage($now,$text);

        // loop
        if ($result)
        {
            foreach ($result as $row)
            {
                $query = "Select bank FROM #__jigs_players WHERE id = $row->resident";
                $db->setQuery($query);
                $bank = $db->loadResult();
                $user				= JFactory::getUser($row->resident);
                $playa_name			= $user->username;

                if ($bank < $rent)// bank is less than rent so evict the player
                {
                    $query	= "UPDATE #__jigs_flats SET timestamp = 0, resident = 0
                        WHERE building = $row->building AND flat = $row->flat";
                    $db->setQuery($query);
                    $db->query();
                    // send wavy lines & feedback
                    $txt = "You were evicted";
                    $this->sendFeedback($user->id ,$txt);
                    $text = "Citizen  $playa_name  was evicted";
                    $this->sendWavyLines($text);
                    // end wavy lines
                }
                else
                {
                    $query	= "UPDATE #__jigs_players SET bank = bank - $rent WHERE id = $row->resident";
                    $db->setQuery($query);
                    $db->query();
                    $query	= "UPDATE #__jigs_flats SET timestamp = $now WHERE building = $row->building AND flat = $row->flat";
                    $db->setQuery($query);
                    $db->query();
                    // send wavy lines & feedback
                    $txt = "Your lease was renewed at apartment number $row->flat Building: $row->building @ ". gmdate("Y-m-d \TH:i:s\Z", $now);
                    $this->sendFeedback($user->id ,$txt);
                    $text	= "Citizen " .  $playa_name . " renewed a lease";
                    $this->sendWavyLines($text);
                    //$this->sendFeedback($user->id, $text);
                    $this->sendMessage($now,$text);
                    // end wavy lines
                }
            }
        }
        $this->sendMessage($now,'apartments checked');
        return;
    }

    function check_rents()
    {
        $now		= time();
        $duration	= 1*60*60*24;
        $time_string    = gmdate("Y-m-d \T H:i:s ", $now);
        $db		= JFactory::getDBO();
        $query   	= "SELECT id,owner from #__jigs_buildings WHERE #__jigs_buildings.timer + $duration < $now & owner != 0 ";
        $db->setQuery($query);
        $result    	= $db->loadObjectlist();

        $message    	= "Building Payments  at " . $time_string;
        $this->sendMessage($now,$message);

        $clients    	= count($result);
        $this->sendMessage($now,"there are " . $clients . " making payments");

        if ($result)
        {
            foreach ($result as $row)
            {

                $query   	= "SELECT name,bank from #__jigs_players WHERE #__jigs_players.id = $row->owner";
                $db->setQuery($query);
                $result2    	= $db->loadObject();

                if ($result2->bank >=100){
                    $result2->bank = $result2->bank-100;
                    $query   	= "UPDATE #__jigs_players SET bank = $result2->bank WHERE #__jigs_players.id = $row->owner";
                    $db->setQuery($query);
                    $db->query();

                    $query   	= "UPDATE #__jigs_buildings SET timer =$now WHERE #__jigs_buildings.id = $row->id";
                    $db->setQuery($query);
                    $db->query();

                    $this->sendMessage($now,"citizen $result2->name paid rent on building $row->id ");

                }else
                {
                    $this->evict($row->id);
                    $this->sendMessage($now,"citizen $result2->name was evicted from building $row->id ");
                }

            }
        }
    }

    function evict($id)
    {
            $db		= JFactory::getDBO();
            $query  = "UPDATE #__jigs_buildings SET owner= 0 WHERE #__jigs_buildings.id = $id";
            $db->setQuery($query);
            $db->query();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function sendWavyLines($text)
    {
        $sbid	= 24;
        $db	= JFactory::getDBO();
        $now	= time();
        $sql	= "INSERT INTO #__shoutbox (name, time,sbid, text) VALUES ('Wavy Lines:', $now,$sbid, \"$text\" )";
        $db->setQuery($sql);
        $db->query();
        return $sql;
    }

    function sendFeedback($id,$text)
    {
        $db	= JFactory::getDBO();
        $query	= "INSERT INTO #__jigs_logs (user_id, message) VALUES ($id,'$text')";
        $db->setQuery($query) ;
        $db->query();
        return ;
    }

    function sendMessage($now,$message)
    {
        $sbid	    = 23;
        $db	        = JFactory::getDBO();
        $query	    = "INSERT INTO #__shoutbox (sbid, name, time, text) values ( $sbid, 'wavy lines', $now, '$message')";
        $db->setQuery($query);
        $db->query();
        return ;
    }

    function get_spiritual($id){
        $db			= JFactory::getDBO();
        $query		= "SELECT name FROM #__jigs_spiritual where id = $id";
        $db->setQuery($query);
        $name		= $db->loadResult();
        return $name;

    }
    function get_phobia($id){
        $db			= JFactory::getDBO();
        $query		= "SELECT name FROM #__jigs_phobias where id = $id";
        $db->setQuery($query);
        $name		= $db->loadResult();
        return $name;
    }
    function get_mood($id){
        $db			= JFactory::getDBO();
        $query		= "SELECT name FROM #__jigs_moods where id = $id";
        $db->setQuery($query);
        $name		= $db->loadResult();
        return $name;
    }

    function is_afraid_of(){
        $player		= $this->get_player();
        $id			= rand(1,30);
        $name		=$this->get_phobia($id);
        $text 		= $player->username . " is afraid of " . $name ;
        return $text;
    }

    function is_feeling(){
        $player		= $this->get_player();
        $id			= rand(1,30);
        $name		= $this->get_mood($id);
        $text 		= $player->username . " is " . $name ;
        return $text;
    }

    function converted_to(){
        $player		= $this->get_player();
        $id			= rand(1,30);
        $name 		= $this->get_spiritual($id);
        $text 		= $player->username . " converted to " . $name ;
        return $text;
    }

    function get_player(){
        $db					= JFactory::getDBO();
        $id					= rand(3000,3100);
        $player	= JFactory::getUser($id);
        $player->dice		= rand(0, 5);
        $query				= "SELECT health,money,name FROM #__jigs_characters WHERE id > $id LIMIT 0,1";
        $db->setQuery($query);
        $result				= $db->loadRow();
        $player->health		= $result[0];
        $player->money		= $result[1];
        $player->username	= $result[2];

        return $player;
    }

    function npc_v_npc(){
        $player		= $this->get_player();
        $player2	= $this->get_player();

        if ($player->dice > $player2->dice)
        {
            $player->health		= $player->health -1;
            $player2->health	= $player2->health-30;
            $text				= $player->username . " attacked " . $player2->username .
                " and inflicted 30 points of damage. ";
        }
        else
        {
            $player->health		= $player->health - 10;
            $player2->health	= $player2->health + 10;
            $text				= $player->username ." attacked " . $player2->username . " and missed. " . $player2->username .
                    " retaliated and inflicted 10 points of damage. ";
        }

        return ($text);
    }

    function update_pos(){
        $db         = JFactory::getDBO();
        $monsters   = $this->get_monsters( $this->get_coord()['grid']);
        $entryData  = array('category' => 'kittensCategory', 'title' => 'title', 'article'  => $monsters, 'when' => time()  );
        $context    = new ZMQContext();
        $socket     = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
        if($socket->connect("tcp://localhost:5555")){
            //   echo 'connected';
        };
        if($socket->send(json_encode($entryData))) {
            echo 'sent';
        };

        return;
        //}
    }

    function get_coord()
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $db->setQuery("SELECT #__jigs_players.posx,
                #__jigs_players.posy,
                #__jigs_players.map,
                #__jigs_players.grid,
                #__comprofiler.avatar,
                #__jigs_players.active
                FROM #__jigs_players
                LEFT JOIN #__comprofiler
                ON #__comprofiler.user_id = #__jigs_players.id
                WHERE #__jigs_players.id =63");
        $result = $db->loadRow();
        return $result;
    }
}
