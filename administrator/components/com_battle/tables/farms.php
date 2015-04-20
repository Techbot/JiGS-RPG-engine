<?php

defined('_JEXEC') or die('Restricted access');

class Tablefarms extends JTable
{
    var $building		= null;
    var $field		    = null;
    var $status	        = null;
    var $crop		    = null;
    var $timestamp		= null;
    var $total		    = null;


    function __construct(&$db)
    {
        parent::__construct( '#__jigs_farms', 'building', $db );
    }
}
