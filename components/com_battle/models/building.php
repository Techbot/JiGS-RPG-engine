<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

jimport( 'joomla.filesystem.folder' );

require_once JPATH_COMPONENT.'/helpers/messages.php';

class BattleModelBuilding extends JModelLegacy
{

////////////////////////////////////////////////////////////////////////////////////////////////////////////

//      Work Methods

//////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///// CREATE NEW GENERATOR FROM A BUILDING /////
    function work_turbine()
    {
        $building_id		= JRequest::getvar('building_id');
        $line				= JRequest::getvar('line');
        $type				= JRequest::getvar('type');
        $quantity			= JRequest::getvar('quantity');
        $now				= time();
        $db					= JFactory::getDBO();
        $q					= "INSERT INTO #__jigs_generators (building, quantity, timestamp)
        VALUES ($building_id,$quantity,$now )
        ON DUPLICATE KEY
        UPDATE quantity = $quantity , timestamp= $now";
        $db->setQuery($q);
        $result				= $db->query();
        return $result;
    }

    function work_conveyer()
    {
        $energy_unit			= 1;
        $building_id			= JRequest::getvar('building_id');
        $line				= JRequest::getvar('line');
        $type				= JRequest::getvar('type');
        $quantity			= JRequest::getint('quantity');
        $energy_units			= $energy_unit * $quantity;
        $now				= time();
        $db				= JFactory::getDBO();
        $sql				= "SELECT * FROM #__jigs_objects WHERE id = " . $type;
        $db->setQuery($sql);
        $product			= $db->loadObject();
        $user				= JFactory::getUser();
        $name				= $product->name;
        $description			= $product->description;
        $level				= $product->level;
        $man_time			= $product->man_time;
        $metal_1			= $product->metal_1;
        $quantity_1			= $product->quantity_1;
        $metal_2			= $product->metal_2;
        $quantity_2			= $product->quantity_2;
        $sql				= "SELECT quantity FROM #__jigs_metals WHERE item_id = " . $metal_1 . " AND player_id = " . $user->id ;
        $resource 			= $db->setQuery($sql);
        $player_qty_1			= $db->loadResult();
        $sql				= "SELECT quantity FROM #__jigs_metals WHERE item_id = " . $metal_2 . " AND player_id = " . $user->id ;
        $resource 			= $db->setQuery($sql);
        $player_qty_2			= $db->loadResult();
        $model				= JModel::getInstance('jigs','BattleModel');


        $energy_required	= $quantity * 1;
        if (!$model->use_battery($building_id, $energy_required))
        {
            return false;
        }

        if ($player_qty_1 >= $quantity_1 && $player_qty_2 >= $quantity_2)
        {
            $player_qty_1		= $player_qty_1 - $quantity_1;
            $player_qty_2		= $player_qty_2 - $quantity_2;
            $finished		= $now + ($quantity * $man_time * 60 );
            $finished		= $now + (1 * 1 * 60);
            $sql			= "INSERT INTO #__jigs_factories (building,line,type, quantity,timestamp,finished)
                            VALUES ($building_id, $line, $type, $quantity, $now, $finished )
                            ON DUPLICATE KEY UPDATE type =  $type , quantity = $quantity , timestamp= $now ,finished = $finished";
            $db->setQuery($sql);
            if (!$db->query())
            {
                echo Json_encode($sql);
                return false;
            };
            $sql			= "UPDATE #__jigs_metals SET quantity = $player_qty_1
                            WHERE item_id = " . $metal_1 . " AND player_id =". $user->id;
            $db->setQuery($sql);
            if (!$db->query())
            {
                echo Json_encode($sql);
                return false;
            };
            $sql			= "UPDATE #__jigs_metals SET quantity = $player_qty_2
                            WHERE item_id = " . $metal_2 . " AND player_id =". $user->id;;
            $db->setQuery($sql);

            if (!$db->query())
            {
                echo Json_encode($sql);
                return false;
            };
        }

        else{

            $message="not enough metals";
            echo Json_encode($message);
            return false;
        }

        return true;
    }

/////////////////////////////////////////////////////////////	

    function work_reprocessor()
    {


        $building_id            = JRequest::getVar('building_id');
        $quantity               = JRequest::getVar('quantity');
        $type                   = JRequest::getVar('type');
        $line                   = JRequest::getVar('line');
        $now                    = time();
        $db                     = JFactory::getDBO();
        $sql                    = "SELECT * FROM #__jigs_objects WHERE id = " . $type;
        $db->setQuery($sql);
        $product                = $db->loadObject();
        $user                   = JFactory::getUser();
        $name                   = $product->name;
        $description            = $product->description;
        $level                  = $product->level;
        $man_time               = $product->man_time;
        $metal_1                = $product->metal_1;
        $quantity_1             = $quantity * $product->quantity_1;
        $metal_2                = $product->metal_2;
        $quantity_2             = $quantity * $product->quantity_2;

        $query                  = "SELECT id FROM #__jigs_inventory WHERE item_id = $type AND player_id = " . $user->id ;
        $db->setQuery($query);

        $player_items           = $db->loadAssocList();
        $player_items_count     = count($player_items);

        $model                  = JModel::getInstance('jigs','BattleModel');

        $energy_required        = $quantity * 1;

        if (!$model->use_battery($building_id, $energy_required))
        {
            $system_status['energy']    = 0;
            $system_status['success']   = 0;
            $message                    = "Not enough Energy";
            $system_status['message']   = Json_encode($message);
            return $system_status;


        }
        else{

            $system_status['energy']    = 1;
            $system_status['success']   = 1;
        }

        if ($player_items_count >  $quantity)
        {
            //$finished         = $now + ($quantity * $man_time * 60 );
            $finished           = $now + (1 * 1 * 160);
            $sql                = "INSERT INTO #__jigs_reprocessors (building, type_name, type_quantity, line, metal1, metal2, quantity_1, quantity_2, timestamp, finished)
                                VALUES ($building_id, '$name',$quantity, $line, $metal_1,$metal_2, $quantity_1,$quantity_2, $now, $finished )
                                ON DUPLICATE KEY UPDATE metal1 = $metal_1, metal2 = $metal_2, quantity_1 =$quantity_1, quantity_2 = $quantity_1 ,timestamp = $now, finished = $finished";
            $db->setQuery($sql);
            $db->query();

            $sql2               = "DELETE FROM #__jigs_inventory
                                WHERE item_id = $type
                                AND player_id = $user->id
                                LIMIT $quantity";
            $db->setQuery($sql2);
            $db->query();

            $system_status['count']     = 1;
            $system_status['success']   = 1;

            //$message                  = $sql;
            $message                    = "Reprocessing system executed";
            $system_status['message']   = Json_encode($message);


        }
        else
        {
            $system_status['count']     = 0;
            $system_status['success']   = 0;
            $message                    = "Not enough items in stock";
            $system_status['message']   = Json_encode($message);

        }

            return $system_status;
    }
        function check_reprocessor()
    {
        $building_id        = JRequest::getvar('building');
        $line_id            = JRequest::getvar('line');
        //$user =& JFactory::getUser();
        $now                = time();
        $db                 = JFactory::getDBO();
        $query              = "SELECT timestamp,finished FROM #__jigs_reprocessors WHERE building = $building_id AND line = $line_id";
        $db->setQuery($query);
        $result             = $db->loadAssoc();
        $result['now']      = date('l jS \of F Y h:i:s A',$now);
        $result['since']    = date('l jS \of F Y h:i:s A',$result['timestamp']);
        $result['elapsed']  = (int)(($now-$result['timestamp']));
        $result['remaining']= (int)($result['finished'] - $now );
        return $result;
    }

/////////////////////////////////////////////////////////////////////////
    function work_field()
    {
        $db                  = JFactory::getDBO();
        $user                = JFactory::getUser();
        $field               = JRequest::getvar('field');
        $building_id         = JRequest::getvar('building_id');
        $workforce           = JRequest::getvar('wf');
        $crop                = JRequest::getvar('crop');
        $now                 = time();


        $model2             = JModel::getInstance('jigs','BattleModel');
        $model3             = JModel::getInstance('hobbits','BattleModel');
        $building_hobbit_stats  = $model3->get_hobbit_stats($building_id,'B');

        $quantity           = 1;
        $energy_required    = $quantity * 1;
        //$message_result = Jview::loadHelper('messages'); //got an error without this
        if(!$model3->use_hobbits($user->id, $building_hobbit_stats->total,$workforce))
        {
        //	MessagesHelper::sendFeedback($id, "Not Enough Hobbits");
            return false;
        }
        if (!$model2->use_battery($building_id, $energy_required))
        {
        //	MessagesHelper::sendFeedback($id, "Not Enough Energy");
            return false;
        }

            $query = "SELECT status, crop, finished, transfer_rate, quality_rate, amount
                                        FROM #__jigs_farms
                                        LEFT JOIN #__jigs_buildings
                                        ON building = id
                                        WHERE building = $building_id AND field =" . $field;
            $db->setQuery($query);
            $result     = $db->loadAssoc();

            if (isset ($result['status']))
            {
                $status     = $result['status'];
            }
            else
            {
                $status         = 0;
            }

            if (isset ($result['crop']))
            {
                $crop = $result['crop'];

            }
            else
            {
                $crop = 0;
            }

           if (isset ($result['transfer_rate']))
            {
                $transfer_rate			= $result['transfer_rate'];

            }
            else
            {
                $transfer_rate = 33;
            }


            if (isset ($result['quality_rate']))
            {
                $quality_rate  = $result['quality_rate'];

            }
            else
            {
                $quality_rate  = 33;
            }

            if (isset ($result['amount']))
            {
                $amount= $result['amount'];

            }
            else
            {
                $amount= 1000;
            }


            if ($result['finished']==0)
            {
                $status++;
            }

            if ($status>=6)
            {
                $status=5;
            }

            if ($status==1){
              $crop           = JRequest::getvar('crop');
            }

            $eta_index		= (($result['transfer_rate'] * 3)/100) * .05 ;
            $eta            = (int) 60 * 1 * (1 - ($workforce * $eta_index ));
            $finished		= $now + $eta;

            $new_amount			= $amount - (1000 - ($result['quality_rate'] * 3)/100) * .05 ;

            $query			= "INSERT INTO #__jigs_farms (building,field, status,timestamp, crop,amount, finished )
                                VALUES  ($building_id,$field, $status,$now , $crop, $new_amount, $finished)
                                ON DUPLICATE KEY UPDATE status =  $status ,timestamp = $now,  crop = $crop , finished = $finished ";

            $db->setQuery($query);

            if(!$db->query())
            {
                $message	="error";
                return $query;
            }
            else
            {
                return $this->get_field_status_text($status);
            }
    }
///////////////////////////////////////////////////////

    function get_avatar($resident)
    {
        $db		= JFactory::getDBO();
        $db->setQuery("SELECT #__comprofiler.avatar
            FROM #__comprofiler
            WHERE #__comprofiler.user_id = ". $resident);
        $result		= $db->loadResult();
        return $result;
    }

    function work_flat()
    {
        $db				= JFactory::getDBO();
        $user			= JFactory::getUser();
        $flat			= JRequest::getvar('flat');
        $building_id	= JRequest::getvar('building_id');
        $query			= "SELECT status,resident FROM #__jigs_flats  WHERE building = $building_id AND flat = $flat ";
        $db->setQuery($query);
        $result			= $db->loadAssoc();
        $status			= $result['status'];
        $resident		= $result['resident'];
        $now			= time();
        $date			= date('jS-m-y :  h:i',$now);

        //////////// if place is currently occupied
        if ($resident == 0)
        {
            $query		= "SELECT bank FROM #__jigs_players WHERE id = ". $user->id;
            $db->setQuery($query);
            $bank       = $db->loadResult();
            if ($bank >= 1000)
            {
                $bank			= $bank - 1000;
                $resident		= $user->id;
                $status			= 1; // occupied

                $avatar			= $this->get_avatar($user->id);
                $query			= "UPDATE #__jigs_players set bank = $bank WHERE id = " . $user->id;
                $db->setQuery($query);
                $db->query();
            }
            else
            {
                $result[0]= 'broke';
                return $result;
            }

        }
        elseif ($resident == $user->id)// if user click they are releasing contract
        {
            $resident	= 0;
            $now		= 0;
            $status		= 0 ; //empty
            $avatar		= 'gallery/black.gif';
        }

        $x = "INSERT INTO #__jigs_flats (building,flat, status, resident,timestamp) values ($building_id, $flat, $status, $resident, $now)
            ON DUPLICATE KEY UPDATE status = $status , resident = $resident , timestamp = $now ;" ;
        $db->setQuery($x);

        if(!$db->query())
        {
            return $x ;
        }
        else
        {
            $pre_result = "<img src='" .  JURI::base()  . "images/comprofiler/" . $avatar . "' height='20px' width='20px' >" ;
            $result[0]	= 'message_' . $flat;
            $result[1]	= $this->get_message($resident,$flat,$building_id);
            $result[2]	= 'avatar_' . $flat;
            $result[3]	= $pre_result ;
            $result[4]	= $flat;

            // Lisa
            if($status == "0")
            {
                $status_word		= "Vacant";
                $status_tooltip		= "Rent";
            }
            else
            {
                $status_word		= "Occupied";
                $status_tooltip		= "Vacate";
            }

            $result[5]	= "<h4><a href='#' title='Click Here to " . $status_tooltip . "'>" . $status_word . "</a></h4>" ;
            $result[6]	= 'timer_' . $flat;
            $result[7]	=  $date;

            //  echo Json_encode ($y);
            return $result;
        }
    }


    function work_mine()
    {
        $db			= JFactory::getDBO();
        $user			= JFactory::getUser();
        $type			= JRequest::getvar('type');
        $building_id	= JRequest::getvar('building_id');
        $now			= time();
        $query			= "INSERT INTO #__jigs_mines (building, type, timestamp ) values  ($building_id,$type,$now) ON DUPLICATE KEY	UPDATE type =  $type , timestamp = " . $now;
        $db->setQuery($query);
        $db->query();
        $result[0]		= $type;
        //$result[1]	= $now;
        $result[1]		= $query;
        return $result;
    }



/////////////////////////////////////////////////////////////////////////////////////////////////////


//    Check Methods


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function check_mine()
    {
        $now					= time();
        $building_id			= JRequest::getvar('building_id');
        $user					= JFactory::getUser();
        $db						= JFactory::getDBO();
        $query					= "SELECT timestamp FROM #__jigs_mines WHERE building = $building_id";
        $db->setQuery($query);
        $result['timestamp']	= $db->loadResult();
        $result['now']			= date('l jS \of F Y h:i:s A',$now);
        $result['since']		= date('l jS \of F Y h:i:s A',$result['timestamp']);
        $result['elapsed']		= (int)(($now-$result['timestamp']));
        $result['remaining']	= (int)(50-((($now-$result['timestamp']))));
        return $result;
    }

    function check_farm()
    {
        $building_id			= JRequest::getvar('building');
        $field_id				= JRequest::getvar('field');
        $now					= time();
        $db						= JFactory::getDBO();
        $query					= "SELECT status,timestamp,finished
                                    FROM #__jigs_farms
                                    WHERE building = $building_id
                                    AND field = $field_id";
        $db->setQuery($query);
        $result					    = $db->loadAssoc();
        $result['now']			    = date('l jS \of F Y h:i:s A',$now);
        $result['since']		    = date('l jS \of F Y h:i:s A',$result['timestamp']);
        $result['elapsed']		    = (int)(($now-$result['timestamp']));
        $result['remaining']	    = (int)(($result['finished'] - $now )/60);
        $result['status']		    = (int)($result['status']);
        $result['status_message']   = $this->get_field_status_text($result['status']);


        $result['field']		= $field_id;

        return $result;
    }

    function get_field_status_text($status=0)
    {
    
    
            if ($status==0) 
            {
                $status_message = "Status: Field is Barren. Click to begin Tilling.";
            }
            elseif ($status==1)
            {
                $status_message = "Status: Field is being tilled.";
            }
            elseif ($status==2)
            {
                $status_message = "Status: Field is tilled. Click to begin sowing.";
            }

            elseif ($status==3)
            {
                $status_message = "Status: Field is being sowed.";
            }
            elseif ($status==4)
            {
                $status_message = "Status: Field is sowed. Click to begin harvesting.";
            }

            elseif ($status==5)
            {
                $status_message = "Status: Field is being harvested.";
            }
            
            else
            {
                $status_message = "Status: You done fucked up.";
            }


            return $status_message;
    
    }



    function check_factory()
    {
        $building_id			= JRequest::getvar('building');
        $line_id				= JRequest::getvar('line');
        //$user =& JFactory::getUser();
        $now					= time();
        $db						= JFactory::getDBO();
        $query					= "SELECT timestamp,finished FROM #__jigs_factories WHERE building = $building_id AND line = $line_id";
        $db->setQuery($query);
        $result					= $db->loadAssoc();
        $result['now']			= date('l jS \of F Y h:i:s A',$now);
        $result['since']		= date('l jS \of F Y h:i:s A',$result['timestamp']);
        $result['elapsed']		= (int)(($now-$result['timestamp']));
        $result['remaining']	= (int)($result['finished'] - $now );
        return $result;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////




//Get Methods




///////////////////////////////////////////////////////////////////////////////////////////////

    function get_drills($building_id)
    {
        $user		= JFactory::getUser();
        //	$result = array() ;
        $now		= time();
        $db			= JFactory::getDBO();
        $query		="SELECT * FROM #__jigs_mines WHERE building =" . $building_id;
        $db->setQuery($query);
        $result		= $db->loadAssoc();
        $payment	= 100;
        $type		= $result['type'];
        $name		= $user->id;
        if (($result['timestamp'] > 0) && ($now-$result['timestamp'] > 50))
        {
            $query	= "UPDATE #__jigs_mines SET timestamp = 0 WHERE building = " . $building_id;
            $db->setQuery($query);
            $db->query();
            $result[timestamp] = 0;
            if ($type==1)
            {
                $type_crystal	= rand( 1 , 30 ) ;
                $query		= "INSERT INTO #__jigs_crystals (player_id , item_id, quantity )
                    VALUES($name ,$type_crystal, 1)
                    ON DUPLICATE KEY
                    UPDATE quantity = quantity + 1";
                $db->setQuery($query);
                $db->query();
            }
            if ($type==2)
            {
                $type_metal	= rand( 1 , 60 ) ; //30 limit see next line
                if ($type_metal >30)
                {
                    $type_metal 	= 1; // this is to increase the chances that carbon will be excavated.
                };
                $query		= "INSERT INTO #__jigs_metals (player_id , item_id, quantity )
                    VALUES( $name ,$type_metal, 1)
                    ON DUPLICATE KEY
                    UPDATE quantity = quantity + 1";
                $db->setQuery($query);
                $db->query();
            }
            else
            {
                $query_1		= "SELECT money FROM #__jigs_players WHERE id = '$user->id'";
                $db->setQuery($query_1);
                $money_saved	= $db->loadResult();
                $money			= $money_saved + $payment;
                $x				=	"Update #__jigs_players SET money = $money WHERE id= " . $user->id;
                $db->setQuery($x);
                $db->query();
            }
        }
        //exit();
        $result['now']		= date('l jS \of F Y h:i:s A',$now);
        $result['since']	= date('l jS \of F Y h:i:s A',$result['timestamp']);
        $result['elapsed']	= (int)(($now-$result['timestamp']));
        $result['remaining']= (int)(50-((($now-$result['timestamp']))));
        return $result;
    }


    //////////////////////////////////////////////////////////////////////////////////////
    function get_cropstats($id)
        {

            $db			= JFactory::getDBO();
            $query		= "SELECT amount,name FROM #__jigs_crops LEFT JOIN #__jigs_crop_names ON #__jigs_crops.type = #__jigs_crop_names.id WHERE #__jigs_crops.owner = $id";
            $db->setQuery($query);
            $result		= $db->loadObjectList();

            return $result;


    }



    function get_crops()
    {
        $total_crop	= 0;
        $db			= JFactory::getDBO();
        $user		= JFactory::getUser();
        $query		= "SELECT total FROM #__jigs_farms LEFT JOIN #__jigs_buildings ON #__jigs_farms.building = #__jigs_buildings.id	WHERE #__jigs_buildings.owner = $user->id;";
        $db->setQuery($query);
        $result		= $db->loadResultArray();
        foreach($result as $row)
        {
            $total_crop = $total_crop + $row;
        }
        return ($total_crop);
    }

    function get_fields($building_id)
    {
        $total_crop	= 0;
        $db			= JFactory::getDBO();
        $user		= JFactory::getUser();

        for ($i=0 ;$i<=7;$i++)
        {
            $fields->status_field[$i] = 0 ;
        }

        $query		= "SELECT * FROM #__jigs_farms WHERE building = $building_id";
        $db->setQuery($query);
        $result		= $db->loadObjectList();
        $i			= 1;

        foreach($result as $row)
        {
            $fields->status_field[$i] = $row->status;
            $i++	;
        }

        return ($fields);
    }








    function old_sell_crops()
    {
        $crops		= $this->get_crops();
        $payment	= $crops * 1000 ;
        $db		= JFactory::getDBO();
        $user		= JFactory::getUser();
        $query_1	="SELECT money FROM #__jigs_players WHERE id = '$user->id'";
        $db->setQuery($query_1);
        $money_saved	= $db->loadResult();
        $money		= $money_saved + $payment;
        $x		= "UPDATE #__jigs_players SET money = $money WHERE id= " . $user->id;
        $db->setQuery($x);
        $db->query();
        $x		= "UPDATE #__jigs_farms
            LEFT JOIN #__jigs_buildings on #__jigs_farms.building = #__jigs_buildings.id
            SET crops = 0 WHERE #__jigs_buildings.owner = $user->id";
        $db->setQuery($x);
        $db->query();
        return($money_saved);
    }



    function get_flats($building_id)
    {
        $db	=& JFactory::getDBO();
        $query	= "SELECT * FROM #__jigs_flats WHERE building=" . $building_id;
        $db->setQuery($query);
        $result	= $db->loadAssocList();
        $i	= 0;

        foreach ($result as $row)
        {
            if ($result[$i]['timestamp'] !=0)
            {
                $now				= time();
                $leasetime			= 1 * 60 * 60 * 24 * 7; // one week
                $result[$i]['remaining']	= ($result[$i]['timestamp'] + $leasetime - $now)/(60*60*24);
                $result[$i]['remaining_days']	= intval(($result[$i]['timestamp']+$leasetime-$now)/(60*60*24));
                $result[$i]['remaining_hours']	= intval(($result[$i]['remaining'] - $result[$i]['remaining_days'])*24);
            }
            else
            {
                $leasetime			= 0;
                $result[$i]['remaining']	= 0;
                $result[$i]['remaining_days']	= 0;
                $result[$i]['remaining_hours']	= 0;
            }
            $i++;
        }
        return $result;
    }



    function get_message($resident,$flat,$building_id)
    {
        $player         = JFactory::getUser($resident);
        $flatlink       = "index.php?option=com_battle&view=room&room=$flat&building=$building_id";
        $message        = null;
        $message_1      = "Apartment is vacant Click to Rent";
        $message_2      = "Apartment is Owned by " . $player->username;
        $message_3      = "Apartment is Owned by you. Click to <a href ='". $flatlink ."'>HERE</a> to Enter ";
        $user           = JFactory::getUser();
        if ($resident== 0)
        {
            $message=$message_1;
        }
        elseif($resident != $user->id)
        {
            $message=$message_2;
        }
        else
        {
            $message = $message_3;
        }
        return $message;
    }


    function get_blueprint() {
        $db		= JFactory::getDBO();
        $user		= JFactory::getUser();
        $db->setQuery("SELECT #__jigs_blueprints.id, #__jigs_objects.name " .
            "FROM #__jigs_blueprints " .
            "LEFT JOIN #__jigs_objects " .
            "ON #__jigs_blueprints.object = #__jigs_objects.id " .
            "WHERE #__jigs_blueprints.user_id =".$user->id);
        $result		= $db->loadAssocList();
        return $result;

    }

    function get_crop_types() {
        $db		    = JFactory::getDBO();
        $user		= JFactory::getUser();
        $db->setQuery("SELECT #__jigs_crops.id,
                #__jigs_crops.name
                FROM #__jigs_crops
                WHERE #__jigs_crops.user_id =".$user->id);
        $result		= $db->loadAssocList();
        return $result;

    }

    function get_seeds() {
        $db		    = JFactory::getDBO();
        $user		= JFactory::getUser();
        $db->setQuery("	SELECT seed_list FROM #__jigs_crop_seeds WHERE owner =".$user->id);

        $result		= $db->loadResult();

        $seedlist = explode(',',$result);

        foreach ($seedlist as $seed)
        {
            $query = "SELECT name FROM #__jigs_crop_names WHERE id =" . $seed;

            $db->setQuery($query);

            $name = $db->loadResult();

            $result2[$seed] = $name;
            $result2[7] = "tobbacco";
        }
        return $result2;
    }

    function get_crop_index(){
        $db		= JFactory::getDBO();
        $user	= JFactory::getUser();
        $id		= JRequest::getvar('crop');
        $building_id	= JRequest::getvar(building_id);
        $section	= JRequest::getvar(section);
        $db->setQuery("SELECT #__jigs_crops.index FROM #__jigs_crops WHERE #__jigs_crops.id =".$id);
        $result[0]	= $db->loadResult();
        $result[1]	= $this->get_subsection_hobbit_names($building_id, $section);
        return $result;

    }

    function get_subsection_hobbit_names($building_id, $section)
    {
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();

        $db->setQuery("SELECT #__jigs_hobbits.name
        FROM #__jigs_hobbits
        WHERE #__jigs_hobbits.section = $section AND owner = $building_id ");
        $result = $db->loadAssocList();
        return $result;

    }



    function get_blueprints()
    {
        return;
        $user		= JFactory::getUser();
        $db			= JFactory::getDBO();

        $query		= "SELECT * FROM #__jigs_blueprints
            LEFT JOIN #__jigs_objects
            ON #__jigs_blueprints.object = #__jigs_objects.id
            WHERE #__jigs_blueprints.user_id = $user->id ";
        $db->setQuery($query);
        $blueprints	= $db->loadObjectList();

        foreach($blueprints as $blueprint)
        {
            $user	= JFactory::getUser();
            $query	= "SELECT name FROM #__jigs_metal_names WHERE #__jigs_metal_names.id = $blueprint->metal_1 ";
            $db->setQuery($query);
            $blueprint->metal_1_name = $db->loadResult();
            $query 	= "SELECT name FROM #__jigs_metal_names WHERE #__jigs_metal_names.id = $blueprint->metal_2 ";
            $db->setQuery($query);
            $blueprint->metal_2_name = $db->loadResult();
        }
        foreach($blueprints as $blueprint)
        {
            $query 	= "SELECT quantity FROM #__jigs_metals
                WHERE #__jigs_metals.player_id = $user->id
                AND #__jigs_metals.item_id = $blueprint->metal_1 ";
            $db->setQuery($query);
            $blueprint->metal_1_stock = $db->loadResult();

            $query	= "SELECT quantity FROM #__jigs_metals
                WHERE #__jigs_metals.player_id = $user->id
                AND #__jigs_metals.item_id = $blueprint->metal_2 ";
            $db->setQuery($query);
            $blueprint->metal_2_stock = $db->loadResult();

        }
        foreach($blueprints as $blueprint)
        {
            $query 	= "SELECT id FROM #__jigs_inventory WHERE player_id = $user->id AND item_id = $blueprint->id ";

            $db->setQuery($query);
            $array	= $db->loadAssocList();

            $blueprint->current_object_quantity = count($array);
        }
        return $blueprints ;
    }

    function get_objects_required($blueprints)
    {

        $db	= JFactory::getDBO();
        $user	= JFactory::getUser();

        if(isset($blueprints))
        {
            foreach($blueprints as $blueprint)
            {
                $query	= "SELECT id FROM #__jigs_inventory
                    WHERE #__jigs_inventory.player_id = $user->id
                    AND #__jigs_inventory.item_id = $blueprint->object ";
                $db->setQuery($query);
                $blueprint->object_total = count($db->loadObjectlist());
            }
        }

        return $blueprints ;
    }




    function get_gen_type($building){

        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $now    = time();
        $factor = 10;
        $query	= "SELECT * FROM    #__jigs_generators WHERE   building = $building";

        $db->setQuery($query);
        $result = $db->loadAssoc();

        return $result;

        }

    function get_board_messages($id,$type)
    {

        $db = JFactory::getDBO();
        $query = "SELECT messages FROM #__jigs_buildings WHERE id =" . $id;
        $db->setQuery($query);
        $string = $db->loadResult();
        $result = array();
        $numbers = array();
        $numbers = explode(',', $string);

        if (count($numbers)>2){
        foreach ($numbers as $message_id) {
            $db = JFactory::getDBO();
            $query = "SELECT string FROM #__jigs_messages WHERE id = $message_id ";
            $db->setQuery($query);
            if ($db->loadResult()) {
                $result[] = $db->loadResult();
            }
        }
    }
        //	print_r($result);
        //	exit();
        return $result;
    }

    function get_battery_slots()
    {
        $db     	= JFactory::getDBO();
        $building	= JRequest::getvar('building_id');
        $now    	= time();
        $factor		= 10;
        $query		= "	SELECT * FROM #__jigs_batteries	WHERE user = $building";

        $db->setQuery($query);
        $batteries = $db->loadAssocList();

        return $batteries;
    }

    function get_battery()
    {
        $db		= JFactory::getDBO();
        $building_id	= JRequest::getvar('building_id');
        $battery_id	= JRequest::getvar('item');
        $user		= JFactory::getUser();
        $query		= "Update #__jigs_batteries SET user = $user->id  WHERE #__jigs_batteries.id = $battery_id";
        $db->setQuery($query);
        $db->query();
        return $battery_id;
    }

    function collect_empties()
    {
        $db		= JFactory::getDBO();
        $building_id	= JRequest::getvar('building_id');

        $user		= JFactory::getUser();
        $query		= "Update #__jigs_batteries SET user = $user->id  WHERE #__jigs_batteries.units = 0 AND user= $building_id";
        $db->setQuery($query);
        $db->query();
        return $query;
    }

    function put_battery()
    {
        $db		= JFactory::getDBO();
        $building_id	= JRequest::getvar('building_id');
        $battery_id	= JRequest::getvar('item');
        $query		= "Update #__jigs_batteries SET user = $building_id WHERE #__jigs_batteries.id = $battery_id";
        $db->setQuery($query);
        $db->query();
        return $battery_id;
    }

    function get_hobbit()
    {
        $db		= JFactory::getDBO();
        $building_id	= JRequest::getvar('building_id');
        $item_id        = JRequest::getvar('itemid');
        $owner_type     = "P";
        $user		= JFactory::getUser();

        if ($item_id =='remove_primary')
        {
            $status         = 2;
        }
        if ($item_id =='remove_defence')
        {
            $status         = 3;
        }
        if ($item_id =='remove_distribution')
        {
            $status         = 4;
        }

        $query		= "Update #__jigs_hobbits SET owner = $user->id, status = 0, owner_type = 'P' WHERE #__jigs_hobbits.owner = $building_id AND status = $status LIMIT 1";
        $db->setQuery($query);
        $db->query();


        $sub_total	= $this->update_building_hobbits($building_id,$status,'B' );

        return $sub_total;
    }

    function put_hobbit()
    {
        $db		= JFactory::getDBO();
        $building_id	= JRequest::getvar('building_id');
        $item_id    	= JRequest::getvar('itemid');

        $user			= JFactory::getUser();
        $owner_type     = "B";

        if ($item_id =='assign_primary')
        {
            $status         = 2;
        }
        if ($item_id =='assign_defence')
        {
            $status         = 3;
        }
        if ($item_id =='assign_distribution')
        {
            $status         = 4;
        }

        $query		= "Update #__jigs_hobbits SET owner = $building_id ,status = $status, owner_type = '$owner_type' WHERE #__jigs_hobbits.owner = $user->id LIMIT 1";
        $db->setQuery($query);
        $db->query();

        $sub_total = $this->update_building_hobbits($building_id,$status,$owner_type,'B' );

        return $sub_total;
    }


    function update_building_hobbits($building_id, $status, $owner_type)
    {
        $db		= JFactory::getDBO();
        $query		= "SELECT id FROM #__jigs_hobbits WHERE owner = $building_id AND status = $status AND owner_type = '$owner_type'";
        $sub_total	= $db->setQuery($query);
        $db->query();
        $sub_total = $db->getNumRows();


        return $sub_total;
    }



    function get_papers() {

        $db		= JFactory::getDBO();
        $user		= JFactory::getUser();
        $db->setQuery("SELECT #__jigs_papers.item_id, #__jigs_paper_names.name, #__jigs_papers.buy_price " .
            "FROM #__jigs_papers " .
            "LEFT JOIN #__jigs_paper_names " .
            "ON #__jigs_papers.item_id = #__jigs_paper_names.id " .
            "WHERE #__jigs_papers.player_id =".$user->id);
        $result		= $db->loadAssocList();
        return $result;

    }


    function get_shop_papers() {

        $db		= JFactory::getDBO();
        $user		= JFactory::getUser();
        $building_id	= JRequest::getvar('building_id');
        $db->setQuery("SELECT #__jigs_papers.item_id, #__jigs_papers.sell_price, #__jigs_paper_names.name
                FROM #__jigs_papers
                LEFT JOIN  #__jigs_paper_names
                ON #__jigs_papers.item_id = #__jigs_paper_names.id
                WHERE #__jigs_papers.player_id =" . $building_id);
        $result		= $db->loadAssocList();
        return $result;

    }


        function get_my_blueprints_list() {
        $db		= JFactory::getDBO();
        $user		= JFactory::getUser();
        $db->setQuery("SELECT #__jigs_blueprints.id, #__jigs_objects.name
                FROM #__jigs_blueprints
                LEFT JOIN #__jigs_objects
                ON #__jigs_blueprints.object = #__jigs_objects.id
                WHERE #__jigs_blueprints.user_id = ".$user->id);
        $result		= $db->loadAssocList();
        return $result;

    }


}// end of class
