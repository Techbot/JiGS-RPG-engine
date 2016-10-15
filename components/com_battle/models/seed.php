<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modellist');

jimport( 'joomla.filesystem.folder' );

require_once JPATH_COMPONENT.'/helpers/messages.php';
require_once JPATH_COMPONENT.'/helpers/energy.php';

class BattleModelSeed extends JModellegacy
{

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







}
