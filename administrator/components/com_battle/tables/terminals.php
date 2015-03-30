<?php

defined('_JEXEC') or die('Restricted access');

class TablePages extends JTable
{
    var $id         = null;
    var $comment    = null;
 /*   var $posy       = null;
    var $posx       = null;
    var $image      = null;
    var $type       = null;
    var $level      = null;
    var $grid       = null;
    var $published	= null;
*/

    function __construct(&$db)
    {
        parent::__construct( '#__jigs_terminals', 'id', $db );
    }
}
