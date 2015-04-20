<?php

defined('_JEXEC') or die('Restricted access');

class TableBuildings extends JTable
{
    var $id         = null;
    var $name       = null;
    var $level      = null;
    var $comment    = null;
    var $posy       = null;
    var $posx       = null;
    var $protection = null;
    var $image      = null;
    var $cash       = null;
    var $type       = null;
    var $public     = null;
    var $xp         = null;
    var $owner      = null;
    var $owners_team= null;
    var $price      = null;
    var $timestamp  = null;
    var $grid       = null;
    var $map        = null;
    var $messages   = null;
    var $published  = null;

    function __construct(&$db)
    {
        parent::__construct( '#__jigs_buildings', 'id', $db );
    }
}
