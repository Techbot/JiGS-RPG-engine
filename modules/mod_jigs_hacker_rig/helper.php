<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access
defined('_JEXEC') or die('Restricted access');
class modHackerRigHelper
{
    static function getList()
    {
        $user = JFactory::getUser();
        $db = JFactory::getDbo();


        /*
        $query  = $db->getQuery(true);
        $query->select('level, system, speed, firewall, modem, hack_count, trace_count');
                                                            $query->from('#__jigs_hacking');
        $query->where('player_id = '. $user->id);
        */
        $query = "SELECT * FROM j17_jigs_hacking WHERE player_id = $user->id ";
        //$query = "SELECT * FROM j17_jigs_hacking";


        $db->setQuery($query);
        $rig = $db->loadObjectList();
        //echo $query;
        //print_r($db);
        //print_r($rig);
        return $rig;

    }

}

