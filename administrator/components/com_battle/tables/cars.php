<?php

defined('_JEXEC') or die('Restricted access');

class Tablecars extends JTable
{
    var $id = null;
    var $reservoir = null;
    var $temps = null;
    var $name = null;
    var $commentaire = null;
    var $defense = null;
    var $consommation = null;
    var $tenue_route = null;
    var $puissance = null;
    var $prix_plein = null;
    var $prix_achat = null;
    var $rapidite = null;
    var $idmagasin = null;
    var $nombre = null;
    var $xp = null;
    var $special = null;
    var $grid = null;

    function __construct(&$db)
    {
        parent::__construct( '#__jigs_cars', 'id', $db );
    }
}
