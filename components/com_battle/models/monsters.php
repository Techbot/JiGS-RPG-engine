<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modellist');

jimport( 'joomla.filesystem.folder' );

require_once JPATH_COMPONENT.'/helpers/messages.php';
require_once JPATH_COMPONENT.'/helpers/energy.php';
//require_once JPATH_COMPONENT.'/helpers/jigs.php';

class BattleModelMonsters extends JModellegacy
{

     function attack()

    {

        $db                 = JFactory::getDBO();
        $user               = JFactory::getUser();
        $id                 = JRequest::getvar('id');

        $monster            = $this->getMonster($id, $db);
        $player             = $this->getPlayer($user, $db);

        $attackRoundMonster = $monster->defence + rand(0,6);
        $attackRoundPlayer  = $monster->attack + rand(0,6);

        if ( $attackRoundPlayer >  $attackRoundMonster){
            $query          = "UPDATE #__jigs_monsters SET health = health -10 WHERE id= $id";
            $db->setQuery($query);
            $db->query();
            $message        = 'You caused 10 hit points of damage';
            MessagesHelper::sendFeedback($user->id,$message);
        }

        $query              = "SELECT health FROM  #__jigs_monsters WHERE id= $id";
        $db->setQuery($query);
        $result['id']       = $id;
        $result['health']   = $db->loadResult();
        $entryData          = array(
                                'category' => 'monsterHealthCategory',
                                'title' => 'title',
                                'article' => $result,
                                'when' => time());
        $context            = new ZMQContext();
        $socket             = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
        if ($socket->connect("tcp://localhost:5555")) {
                //   echo 'connected';
        };
        if ($socket->send(json_encode($entryData))) {
                //  echo 'delivered';
        };

        return true;
    }

    /**
     * @param $user
     * @param $db
     * @return string
     */
    public function getPlayer($user, $db)
    {
        $query = "SELECT * FROM #__jigs_players WHERE id= " . $user->id;
        $db->setQuery($query);
        $player = $db->loadResultArray();
        return $player;
    }

    /**
     * @param $id
     * @param $db
     * @return string
     */
    public function getMonster($id, $db)
    {
        $query = "SELECT * FROM #__jigs_monsters WHERE id= $id";
        $db->setQuery($query);
        $monster = $db->loadResultArray();
        return $monster;
    }
}