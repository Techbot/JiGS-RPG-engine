<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

/**
 * This models supports retrieving lists of terminal stuff
 *
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @since		1.6
 */
class BattleModelTerminal extends JModelLegacy
{
    /**
     * Model context string.
     *
     * @var		string
     */

    public function getStuff(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id             = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.id =".$id;
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }

    public function scan(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $ip             = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.ip ='$ip'";
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }


    public function decrypt(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id             = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.id ='$id'";
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }


    public function hack(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id             = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.id =".$id;
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }


    public function killtrace(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id             = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.id =".$id;
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }

    public function logout(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id             = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.id =".$id;
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }


    public function login(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id             = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.id =".$id;
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }


    public function execute(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id             = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.id =".$id;
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }


    public function download(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id             = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.id =".$id;
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }


    public function upload(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id             = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.id =".$id;
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }




}
