<?php

defined('_JEXEC') or die('Restricted access');

class TablePlates extends JTable
{
    var $id         = null;
    var $name       = null;
    var $details    = null;
    var $comment    = null;
    var $posy       = null;
    var $posx       = null;
    var $image      = null;
    var $type       = null;
    var $level      = null;
    var $grid       = null;
    var $map        = null;
    var $published  = null;

    function __construct(&$db)
    {
        parent::__construct( '#__jigs_plates', 'id', $db );
    }
}
