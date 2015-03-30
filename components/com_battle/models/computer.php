<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

/**
 * This models supports retrieving lists of contact categories.
 *
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @since		1.6
 */
class BattleModelComputer extends JModel
{
    /**
     * Model context string.
     *
     * @var		string
     */
    public $_context = 'com_dojogames.computer';

    /**
     * The category context (allows other extensions to derived from this model).
     *
     * @var		string
     */
    protected $_extension = 'com_battle';

    private $_parent = null;

    private $_items = null;

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    function unlock($player)

    {




        $user =& JFactory::getUser();
        $app = JFactory::getApplication();
    //	$this->setState('filter.extension', $this->_extension);
        $db =& JFactory::getDBO();

        $digit_one		= JRequest::getInt('digit1');
        $digit_two		= JRequest::getInt('digit2');
        $digit_three	= JRequest::getInt('digit3');
        $digit_four		= JRequest::getInt('digit4');


        if ($digit_one == 46 && $digit_two == 19 && $digit_three == 37 && $digit_four == 66){

            $flags_array = $player[0]['flags'];
            $flags_array = explode(',', $flags_array );
            $flags_array[] = 2; // first mission complete



        $flags = implode( ',', $flags_array);
        $sql="UPDATE #__jigs_players SET flags =('$flags') WHERE id =". $user->id;
        $db->setQuery($sql);
        $db->query();



        return $player;

        }

        // Get the parent id if defined.
    //	$parentId = JRequest::getInt('id');
    //	$this->setState('filter.parentId', $parentId);

    //	$params = $app->getParams();
    //	$this->setState('params', $params);

    //	$this->setState('filter.published',	1);
    //	$this->setState('filter.access',	true);


    }


    public function display_terminal()
    {


    $cyber			= JRequest::getVar('id');


        if ($cyber=='cyber1')
        {

            return "<img class = 'fluid' src = 'http://eclecticmeme.com/components/com_battle/images/terminal/002a.png'>";

        }
        if ($cyber=='cyber2')
        {

            return "<img class = 'fluid' src = 'http://eclecticmeme.com/components/com_battle/images/terminal/002b.png'>";

        }

        if ($cyber=='cyber3')
        {

            return "<img class = 'fluid' src = 'http://eclecticmeme.com/components/com_battle/images/terminal/001a.png'>";

        }

        if ($cyber=='cyber4')
        {

            return "<img class = 'fluid' src = 'http://eclecticmeme.com/components/com_battle/images/terminal/001b.png'>";

        }








    }

    /**
     * redefine the function an add some properties to make the styling more easy
     *
     * @return mixed An array of data items on success, false on failure.
     */
    public function getItems()
    {

        return $this->_items;
    }


}
