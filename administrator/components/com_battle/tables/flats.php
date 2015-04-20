<?php

defined('_JEXEC') or die('Restricted access');

class TableFlats extends JTable
{
    var $building = null;
    var $flat = null;
    var $status = null;
    var $resident = null;
    var $timestamp = null;
    var $unused = null;

    function __construct(&$db)
    {
        parent::__construct( '#__jigs_flats', 'building', $db );
    }
}
