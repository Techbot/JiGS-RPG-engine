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
        //$query  = "UPDATE #__jigs_players SET grid = '$grid' WHERE id ='$user->id'";
        $query  = JFactory::getDbo()->getQuery(true);
        $query->update('#__jigs_players');
        $query->set('grid = '. $grid);
        $query->where('id =' .$user->id);
        $db->setQuery($query);
        if ($db->query()) {
            return true;
        }
        $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
        return false;
    }

    function update_pos()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $posx       = JRequest::getVar('posx');
        $posy       = JRequest::getVar('posy');
        //$query      = "UPDATE #__jigs_players SET posx = '$posx',posy = '$posy'  WHERE id ='$user->id'";
        $query  = JFactory::getDbo()->getQuery(true);
        $query->update('#__jigs_players');
        $query->set('posx = ' .$posx);
        $query->set('posy = ' .$posy);
        $query->where('id =' .$user->id);
        $db->setQuery($query);
        if (!$db->query()) {
            $this->setError(JText::_('COM_BATTLE_UPDATE_DATABASE_FAIL'));
            return false;
        }
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
        ///////Same as get Grid /////////////
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $query      = JFactory::getDbo()->getQuery(true);
        $query->select('#__jigs_players.posx,
                #__jigs_players.posy,
                #__jigs_players.map,
                #__jigs_players.grid,
                #__comprofiler.avatar,
                #__jigs_players.active');
        $query->from('#__jigs_players');
        $query->leftJoin('#__comprofiler
                ON #__comprofiler.user_id = #__jigs_players.id');
        $query->where('#__jigs_players.id =' . $user->id);
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadRow();
            return $result;
        }
        $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
        return false;
    }
    function get_grid()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $query      = JFactory::getDbo()->getQuery(true);
        $query->select('#__jigs_players.grid,
                #__jigs_players.posx,
                #__jigs_players.posy,
                #__comprofiler.avatar,
                #__jigs_players.active');
        $query->from('#__jigs_players');
        $query->leftJoin('#__comprofiler
                ON #__comprofiler.user_id = #__jigs_players.id');
        $query->where('#__jigs_players.id =' . $user->id);
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadRow();
            return $result;
        }
            $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
            return false;
    }
    function get_chars()
    {
        $db      = JFactory::getDBO();
        $user    = JFactory::getUser();
        //$query  = "SELECT grid FROM #__jigs_players WHERE id =" . $user->id;
        $query   = JFactory::getDbo()->getQuery(true);
        $grid    = $this->select_grid($user->id);
        $query   = JFactory::getDbo()->getQuery(true);
        //$db->setQuery("SELECT * FROM #__jigs_characters WHERE grid = $grid AND active = 1 ");
        $query->select('*');
        $query->from('#__jigs_characters');
        $query->where('grid = ' . $grid . ' AND active = 1');
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadObjectlist();
            return $result;
        }
        $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
        return false;
    }
    function get_monsters()
    {
        $db       = JFactory::getDBO();
        $user     = JFactory::getUser();
        $query    = JFactory::getDbo()->getQuery(true);

        $grid = $this->select_grid($user->id);
        $query    = JFactory::getDbo()->getQuery(true);
        /*
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
*/
        $query->select('#__jigs_monsters.id,
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
                                #__jigs_monster_types.numberofcells');
        $query->from('#__jigs_monsters');
        $query->leftJoin('#__jigs_monster_types
                ON  #__jigs_monsters.type = #__jigs_monster_types.id');
        $query->where(' grid = '. $grid);
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadObjectlist();
            return $result;
        }
        $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
        return false;
    }

    function get_playersPos($grid=1)
    {
        $db       = JFactory::getDBO();
        $user     = JFactory::getUser();
        $grid     = $this->select_grid($user->id);

        $query    = JFactory::getDbo()->getQuery(true);
        /*$db->setQuery("SELECT #__jigs_players.id,
                      #__jigs_players.grid,
                      #__jigs_players.posx,
                      #__jigs_players.posy,
                      #__jigs_players.health
                      FROM #__jigs_players
                      WHERE grid = $grid
                      AND active = 1 ");
        */
        $query->select('#__jigs_players.id,
                      #__jigs_players.grid,
                      #__jigs_players.posx,
                      #__jigs_players.posy,
                      #__jigs_players.health');
        $query->from('#__jigs_players');

        $query->where(' grid = '. $grid . ' AND active = 1');
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadObjectlist();
            return $result;
        }
        $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
        return false;
    }

    function select_grid($userId){
        $db       = JFactory::getDBO();
        $query    = JFactory::getDbo()->getQuery(true);
        $query->select('grid');
        $query->from('#__jigs_players');
        $query->where('#__jigs_players.id =' . $userId);
        $db->setQuery($query);
        $grid     = $db->loadResult();
        if ($grid<1){
            $grid=1;
        }
        return $grid;
    }

    function get_halflings()
    {
        $db       = JFactory::getDBO();
        $user     = JFactory::getUser();
        $grid     = $this->select_grid($user->id);
        $query    = JFactory::getDbo()->getQuery(true);
        /*
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
        */
        $query->select('#__jigs_hobbits.id,
                                #__jigs_hobbits.grid,
                                #__jigs_hobbits.x,
                                #__jigs_hobbits.y,
                                #__jigs_hobbits.health,
                                #__jigs_hobbit_types.typename,
                                #__jigs_hobbit_types.cellwidth,
                                #__jigs_hobbit_types.cellheight,
                                #__jigs_hobbit_types.numberofcells');
        $query->from('#__jigs_hobbits');
        $query->leftJoin('#__jigs_hobbit_types
                                ON  #__jigs_hobbits.type = #__jigs_hobbit_types.id');
        $query->where(' grid = '. $grid);
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadObjectlist();
            return $result;
        }
        $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
        return false;
    }

    function get_buildings()
    {
        $db      = JFactory::getDBO();
        $user    = JFactory::getUser();
        if($user->id == 0){
            $user->id=0;
        }
        $grid    = $this->select_grid($user->id);
        $query   = JFactory::getDbo()->getQuery(true);
        //$db->setQuery("SELECT * FROM #__jigs_buildings WHERE grid = $grid");
        //$result = $db->loadObjectlist();
        $query->select('*');
        $query->from('#__jigs_buildings');
        $query->where(' grid = '. $grid );
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadObjectlist();
            //add owner name to the result array
            foreach ($result as $building){
                $query   = JFactory::getDbo()->getQuery(true);
                //$query = "SELECT name FROM #__jigs_players WHERE id = $building->owner";
                $query->select('name');
                $query->from('#__jigs_players');
                $query->where('id = ' . $building->owner);
                $db->setQuery($query);
                if ($db->query()) {
                    $building->ownername = $db->loadResult();
                }else{
                    $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
                    return false;
                }
            }
            $this->save_coord();
            return $result;
        }
            $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
            return false;
    }

    function get_twines()
    {
        $db = JFactory::getDBO();
        $user = JFactory::getUser();
        $grid   = $this->select_grid($user->id);
        $query = JFactory::getDbo()->getQuery(true);
        $query->select('*');
        $query->from('#__jigs_twines');
        $query->where(' grid =' . $grid . ' AND published =1');
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadObjectlist();
            return $result;
        }
        $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
        return false;
    }

    function get_plates()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $grid   = $this->select_grid($user->id);
        //$db->setQuery("SELECT * FROM #__jigs_plates WHERE grid ='$grid' AND published ='1'");
        $query = JFactory::getDbo()->getQuery(true);
        $query->select('*');
        $query->from('#__jigs_plates');
        $query->where(' grid =' . $grid . ' AND published =1');
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadObjectlist();
            return $result;
        }
        $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
        return false;
    }
    function get_terminals()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $grid   = $this->select_grid($user->id);
        //$db->setQuery("SELECT * FROM #__jigs_terminals WHERE grid ='".$grid."' AND published ='1'");
        $query = JFactory::getDbo()->getQuery(true);
        $query->select('*');
        $query->from('#__jigs_terminals');

        $query->where(' grid = '. $grid . ' AND published = 1');
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadObjectlist();
            return $result;
        }
        $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
        return false;
    }
    function get_players()
    {
        $db     = JFactory::getDBO();
        $user   = JFactory::getUser();
        $grid   = $this->select_grid($user->id);
        $map=0;
        if ($map<1){
            $map=1;
        }
        /*
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
        */
        $query = JFactory::getDbo()->getQuery(true);
        $query->select('#__jigs_players.id,
                #__jigs_players.name,
                #__jigs_players.posx,
                #__jigs_players.posy,
                #__comprofiler.avatar');
        $query->from('#__jigs_players');
        $query->leftJoin('#__comprofiler ON #__jigs_players.id = #__comprofiler.user_id');
        $query->where('#__jigs_players.active = 1' .
               ' AND #__jigs_players.grid = '.$grid .
               ' AND #__jigs_players.map = ' . $map .
               ' AND #__jigs_players.id != ' .  $user->id);
        $db->setQuery($query);
        if ($db->query()) {
            $result = $db->loadObjectlist();
            return $result;
        }
        $this->setError(JText::_('COM_BATTLE_READ_DATABASE_FAIL'));
        return false;
    }
    function sing_song(){
        echo 'test';
    }
}