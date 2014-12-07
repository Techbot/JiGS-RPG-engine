<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

jimport( 'joomla.filesystem.folder' );

require_once JPATH_COMPONENT.'/helpers/messages.php';

class BattleModelBank extends JModel
{
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //      Methods

    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///// CREATE NEW GENERATOR FROM A BUILDING /////
    function get_account_list()
    {
        $building_id		= JRequest::getvar('bank_id');
        $now				= time();
        $db					= JFactory::getDBO();
        $query              = " SELECT j17_jigs_players.level,
                                j17_jigs_players.name
                                FROM j17_jigs_bank_accounts

                                LEFT JOIN j17_jigs_players
                                ON j17_jigs_players.id = j17_jigs_bank_accounts.player_id
                                WHERE j17_jigs_bank_accounts.bank_id = $building_id";
        $db->setQuery($query);
        $result			    = $db->loadAssocList();

        return $result;
    }

}// end of class
