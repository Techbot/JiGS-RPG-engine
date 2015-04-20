<?php
defined('_JEXEC') or die('Restricted access');

class TableWeapons extends JTable
{
    var $id             = null;
    var $image          = null;
    var $ammunition     = null;
    var $attack         = null;
    var $defence        = null;
    var $precision      = null;
    var $detente        = null;
    var $prix_achat     = null;
    var $prix_munition  = null;
    var $commentaire    = null;
    var $nom            = null;
    var $idmagasin      = null;
    var $nombre         = null;
    var $xp             = null;
    var $special        = null;

    function __construct(&$db)
    {
        parent::__construct( '#__jigs_weapons', 'id', $db );
    }
}
