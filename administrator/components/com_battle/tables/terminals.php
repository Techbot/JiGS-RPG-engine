<?php

defined('_JEXEC') or die('Restricted access');

class TablePages extends JTable
{
    var $id         = null;
    var $grid       = null;
    var $posx       = null;
    var $posy       = null;
    var $image      = null;
    var $comment    = null;
    var $type       = null;
    var $level      = null;
    var $ip         = null;
    var $domiain    = null;
    var $bandwidth  = null;
    var $capacity   = null;
    var $version    = null;
    var $status     = null;
    var $faction    = null;
    var $battery    = null;
    var $published	= null;


    function __construct(&$db)
    {
        parent::__construct( '#__jigs_terminals', 'id', $db );
    }
}
