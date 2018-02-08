<?php

defined('_JEXEC') or die('Restricted access');

class Tablemines extends JTable
{
    var $building		= null;
    var $mine			= null;
    var $status			= null;
    var $timestamp		= null;
    var $total			= null;


    function __construct(&$db)
    {
        parent::__construct( '#__jigs_mines', 'building', $db );
    }
}
