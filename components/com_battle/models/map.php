<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
jimport( 'joomla.filesystem.folder' );
require_once JPATH_COMPONENT.'/helpers/messages.php';
class BattleModelMap extends JModelLegacy
{
    function save_coord()
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $grid   = JRequest::getVar('grid');
        $query  = "UPDATE #__jigs_players SET grid = '$grid' WHERE id ='$user->id'";
        $db->setQuery($query);
        $db->query();
        return;
        //}
    }

    function update_pos()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $posx       = JRequest::getVar('posx');
        $posy       = JRequest::getVar('posy');
        $query      = "UPDATE #__jigs_players SET posx = '$posx',posy = '$posy'  WHERE id ='$user->id'";
        $db->setQuery($query);
        $db->query();
       // $monsters   = $this->get_monsters( $this->get_coord()['grid']);
        $players   = $this->get_playersPos( $this->get_coord()['grid']);
       /*
        $entryData = array(
            'category' => 'kittensCategory',
            'title'    => 'title',
            'article'  => $monsters,
            'when' => time()  );
        */
        $entryData = array(
            'category' => 'playersCategory',
            'title'    => 'title',
            'article'  => $players,
            'when' => time()  );
        $context    = new ZMQContext();
        $socket     = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
        if($socket->connect("tcp://localhost:5555")){
         //   echo 'connected';
        };
        if($socket->send(json_encode($entryData))) {
            echo 'sent';
        };
        $db->setQuery($query);
        $db->query();
        return $query ;
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
                WHERE #__jigs_players.id =" . $user->id);
        $result = $db->loadRow();
        return $result;
    }

    function get_grid()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $db->setQuery("SELECT  #__jigs_players.grid,
                #__jigs_players.posx,
                #__jigs_players.posy,
                #__comprofiler.avatar,
                #__jigs_players.active
                FROM #__jigs_players
                LEFT JOIN #__comprofiler
                ON #__comprofiler.user_id = #__jigs_players.id
                WHERE #__jigs_players.id =" . $user->id);

        $result = $db->loadRow();
        return $result;
    }

    function get_chars()
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $query  = "SELECT grid FROM #__jigs_players WHERE id =" . $user->id;
        $db->setQuery($query);
        $grid   = $db->loadResult();
        if ($grid<1){
            $grid=1;
        }
        $db->setQuery("SELECT * FROM #__jigs_characters WHERE grid = $grid AND active = 1 ");
        $result = $db->loadObjectlist();
        return $result;
    }

    function get_monsters()
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $query  = "SELECT grid FROM #__jigs_players WHERE id =" . $user->id;
        $db->setQuery($query);
        $grid   = $db->loadResult();
        if ($grid<1){
            $grid=1;
        }
        $db->setQuery("SELECT #__jigs_monsters.id,
                                #__jigs_monsters.type,
                                #__jigs_monsters.grid,
                                #__jigs_monsters.x,
                                #__jigs_monsters.y,
                                #__jigs_monsters.health,
                                #__jigs_monster_types.maxhealth,
                                #__jigs_monster_types.name,
                                #__jigs_monster_types.level,
                                #__jigs_monster_types.spritesheet,
                                #__jigs_monster_types.cellwidth,
                                #__jigs_monster_types.cellheight,
                                #__jigs_monster_types.numberofcells

                                FROM #__jigs_monsters
                                LEFT JOIN #__jigs_monster_types
                                ON  #__jigs_monsters.type = #__jigs_monster_types.id
                                WHERE grid = $grid ");
        $result = $db->loadObjectlist();
        return $result;
    }

    function get_playersPos($grid=1)
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $query  = "SELECT grid FROM #__jigs_players WHERE id =" . $user->id;
        $db->setQuery($query);
        $grid   = $db->loadResult();
        if ($grid<1){
            $grid=1;
        }
        $db->setQuery("SELECT #__jigs_players.id,
                      #__jigs_players.grid,
                      #__jigs_players.posx,
                      #__jigs_players.posy,
                      #__jigs_players.health
                      FROM #__jigs_players
                      WHERE grid = $grid
                      AND active = 1 ");
        $result = $db->loadObjectlist();
        return $result;
    }

    function get_halflings()
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $query  = "SELECT grid FROM #__jigs_players WHERE id =" . $user->id;
        $db->setQuery($query);
        $grid   = $db->loadResult();
        if ($grid<1){
            $grid=1;
        }
        $db->setQuery("SELECT #__jigs_hobbits.id,
                                #__jigs_hobbits.grid,
                                #__jigs_hobbits.x,
                                #__jigs_hobbits.y,
                                #__jigs_hobbits.health,
                                #__jigs_hobbit_types.typename,
                                #__jigs_hobbit_types.cellwidth,
                                #__jigs_hobbit_types.cellheight,
                                #__jigs_hobbit_types.numberofcells

                                FROM #__jigs_hobbits
                                LEFT JOIN #__jigs_hobbit_types
                                ON  #__jigs_hobbits.type = #__jigs_hobbit_types.id
                                WHERE grid = $grid ");
        $result = $db->loadObjectlist();
        return $result;
    }

    function get_buildings()
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $db->setQuery("SELECT grid FROM #__jigs_players WHERE id = " . $user->id);
        $grid   = $db->loadResult();
        if ($grid<1){
            $grid=1;
        }
        $db->setQuery("SELECT * FROM #__jigs_buildings WHERE grid = $grid");
        $result = $db->loadObjectlist();

        //add owner name to the result array
        foreach ($result as $building){
            $query = "SELECT name FROM #__jigs_players WHERE id = $building->owner";
            $db->setQuery($query);
            $building->ownername = $db->loadResult();
        }
        $this->save_coord();
        return $result;
    }

    function get_twines()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $db->setQuery("SELECT map,grid FROM #__jigs_players WHERE id =".$user->id);
        $result     = $db->loadRow();
        $map        = $result[0];
        $grid       = $result[1];
        if ($grid<1){
            $grid=1;
        }
        $db->setQuery("SELECT * FROM #__jigs_twines WHERE grid ='".$grid."' AND published ='1'");
        $result     = $db->loadObjectlist();
        return $result;
    }

    function get_plates()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $db->setQuery("SELECT map,grid FROM #__jigs_players WHERE id =".$user->id);
        $result     = $db->loadRow();
        $map        = $result[0];
        $grid       = $result[1];
        if ($grid<1){
            $grid=1;
        }
        $db->setQuery("SELECT * FROM #__jigs_plates WHERE grid ='$grid' AND published ='1'");
        $result     = $db->loadObjectlist();
        return $result;
    }

    function get_terminals()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $db->setQuery("SELECT map,grid FROM #__jigs_players WHERE id =".$user->id);
        $result     = $db->loadRow();
        $map        = $result[0];
        $grid       = $result[1];
        if ($grid<1){
            $grid=1;
        }
        $db->setQuery("SELECT * FROM #__jigs_terminals WHERE grid ='".$grid."' AND published ='1'");
        $result     = $db->loadObjectlist();
        return $result;
    }
    function get_players()
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $db->setQuery("SELECT map,grid FROM #__jigs_players WHERE id =".$user->id);
        $result = $db->loadRow();
        $map    = $result[0];
        $grid   = $result[1];
        if ($grid<1){
            $grid=1;
        }
        if ($map<1){
            $map=1;
        }

        $db->setQuery("SELECT #__jigs_players.id,
                #__jigs_players.name,
                #__jigs_players.posx,
                #__jigs_players.posy,
                #__comprofiler.avatar
                FROM #__jigs_players
                LEFT JOIN #__comprofiler ON #__jigs_players.id = #__comprofiler.user_id
                WHERE #__jigs_players.active = 1
                AND #__jigs_players.grid = $grid
                AND #__jigs_players.map = $map
                AND #__jigs_players.id !=  $user->id
                ");
        $result = $db->loadObjectlist();
        return $result;
    }

    function sing_song(){
        echo 'test';
    }
}
