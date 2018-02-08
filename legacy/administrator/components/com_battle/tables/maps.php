<?php

defined('_JEXEC') or die('Restricted access');

class TableMaps extends JTable
{
    var $id = null;
    var $grid = null;
    var $grid_index = null;
    var $row0 = null;
    var $row1 = null;
    var $row2 = null;
    var $row3 = null;
    var $row4 = null;
    var $row5 = null;
    var $row6 = null;
    var $row7 = null;

    function __construct(&$db)
    {
        parent::__construct( '#__jigs_maps', 'id', $db );
    }
}
