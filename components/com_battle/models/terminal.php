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
class BattleModelTerminal extends JModel
{
    /**
     * Model context string.
     *
     * @var		string
     */

    public function getStuff(){
        $db             = JFactory::getDBO();
        $user           = JFactory::getUser();
        $id   = JRequest::getvar('id');
        $query = "SELECT *
           FROM #__jigs_terminals
           WHERE #__jigs_terminals.id =".$id;
        $db->setQuery($query);
        $result         = $db->loadAssoc();
        return $result;
    }
}
