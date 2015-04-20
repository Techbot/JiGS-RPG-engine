<?php

defined('_JEXEC') or die('Restricted access');

class TablePlayers extends JTable
{
    var $id             = null;
    var $name           = null;
    var $type           = null;
    var $id_weapon      = null;
    var $money          = null;
    var $bank           = null;
    var $attack         = null;
    var $final_attack   = null;
    var $defence        = null;
    var $final_defence  = null;
    var $nbrattacks     = null;
    var $nbrkills       = null;
    var $health         = null;
    var $level          = null;
    var $slack          = null;
    var $energy         = null;
    var $statpoints     = null;
    var $xp             = null;
    var $intelligence   = null;
    var $strength       = null;
    var $dexterity      = null;
    var $speed          = null;
    var $grid           = null;
    var $posx           = null;
    var $posy           = null;
    var $map            = null;
    var $team           = null;
    var $published      = null;
    var $image          = null;
    var $ammunition     = null;
    var $active         = null;
    var $ip             = null;
    var $comment        = null;
    var $narcotics      = null;



    function __construct(&$db)
    {
        parent::__construct( '#__jigs_players', 'id', $db );
    }
}
