<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

jimport( 'joomla.filesystem.folder' );

require_once JPATH_COMPONENT.'/helpers/messages.php';

class BattleModelBank extends JModelLegacy
{
    function get_account_list()
    {
        $building_id        = JRequest::getvar('bank_id');
        $db                 = JFactory::getDBO();
        $query              = " SELECT j17_jigs_bank_accounts.bank_sec_level,
                                j17_jigs_players.name,
                                j17_jigs_players.id
                                FROM j17_jigs_bank_accounts

                                LEFT JOIN j17_jigs_players
                                ON j17_jigs_players.id = j17_jigs_bank_accounts.player_id
                                WHERE j17_jigs_bank_accounts.bank_id = $building_id
                                AND
                                timestamp=0";
        $db->setQuery($query);
        $result             = $db->loadAssocList();
        return $result;
    }

    function hack_bank()
    {
        $building_id        = JRequest::getvar('bank_id');
        $now                = time();
        $db                 = JFactory::getDBO();
        $query              = " SELECT j17_jigs_bank_accounts.bank_sec_level,
                                j17_jigs_players.name,
                                j17_jigs_players.id
                                FROM j17_jigs_bank_accounts

                                LEFT JOIN j17_jigs_players
                                ON j17_jigs_players.id = j17_jigs_bank_accounts.player_id
                                WHERE j17_jigs_bank_accounts.bank_id = $building_id";
        $db->setQuery($query);
        $result             = $db->loadAssocList();
        return $result;
    }

    function hack_player_account()
    {
        $building_id        = JRequest::getvar('bank_id');
        $user               = JFactory::getUser();
        $now                = time();
        $db                 = JFactory::getDBO();
        $account_id         = JRequest::getvar('playerid');
        $query              = " SELECT *
                                FROM j17_jigs_bank_accounts
                                WHERE player_id = $user->id AND bank_id =$building_id";
        $db->setQuery($query);
        $player             = $db->loadObject();
        $query              = " SELECT *
                                FROM j17_jigs_bank_accounts
                                WHERE player_id = $account_id AND bank_id = $building_id";
        $db->setQuery($query);
        $account            = $db->loadObject();

        if ($player->bank_sec_level > $account->bank_sec_level){
            $account->amount = $account->amount -100;
            $player->amount = $player->amount + 90;
            $message = " You win";

        }
        elseif ($player->bank_sec_level < $account->bank_sec_level){
            if(in_array(34, $player->skills)){
               $player->level++;
               $message = "You lose";
            }
        }
        else{
            $message = "You draw";
        }

        MessagesHelper::sendFeedback($user->id,$message);
        //$this->sendWavyLines($text);
        $query = "UPDATE j17_jigs_bank_accounts SET amount = $player->amount, timestamp = $now WHERE player_id = $user->id AND bank_id =$building_id";
        $db->setQuery($query);
        $db->query();

        $query = "UPDATE j17_jigs_bank_accounts SET amount = $account->amount, timestamp = $now WHERE player_id = $account->player_id AND bank_id =$building_id";
        $db->setQuery($query);
        $db->query();
        return $this->get_account_list();
  }

    function assist_player_account()
    {
        $building_id        = JRequest::getvar('bank_id');
        $account_id         = JRequest::getvar('id');
        $now                = time();
        $db                 = JFactory::getDBO();
        $query              = " SELECT j17_jigs_players.level,
                                j17_jigs_players.name,
                                j17_jigs_players.id
                                FROM j17_jigs_bank_accounts

                                LEFT JOIN j17_jigs_players
                                ON j17_jigs_players.id = j17_jigs_bank_accounts.player_id
                                WHERE j17_jigs_bank_accounts.bank_id = $building_id";
        $db->setQuery($query);
        $result             = $db->loadAssocList();

        return $result;
    }
}// end of class