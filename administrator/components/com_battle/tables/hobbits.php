<?php
defined('_JEXEC') or die('Restricted access');
class Tablehobbits extends JTable
{
    var $id				= null;
    var $name			= null;
    var $avatar			= null;


    function __construct(&$db)
    {
        parent::__construct( '#__jigs_hobbits', 'id', $db );
    }
}
