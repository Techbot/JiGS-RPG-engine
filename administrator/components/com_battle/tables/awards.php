<?php

defined('_JEXEC') or die('Restricted access');

class TableAwards extends JTable
{
    var $id        = null;
    var $name_id   = null;
    var $iduser    = null;
    var $published = null;

    function __construct(&$db)
    {
        parent::__construct( '#__jigs_awards', 'id', $db );
    }
}
