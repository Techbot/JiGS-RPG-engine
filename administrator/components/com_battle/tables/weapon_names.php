<?php

defined('_JEXEC') or die('Restricted access');

class TableWeapon_names extends JTable
{
    var $id                 = null;
    var $image              = null;
    var $ammunition         = null;
    var $attack             = null;
    var $defence            = null;
    var $precision          = null;
    var $detente            = null;
    var $price              = null;
    var $prix_ammunition    = null;
    var $comment            = null;
    var $name               = null;
    var $idmagazine         = null;
    var $nombre             = null;
    var $xp                 = null;
    var $special            = null;

    function __construct(&$db)
    {
        parent::__construct( '#__jigs_weapon_names', 'id', $db );
    }
}
