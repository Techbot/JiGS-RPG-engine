<?php

defined('_JEXEC') or die('Restricted access');

class Tablepeople extends JTable
{
	var $id = null;
	var $name = null;
    var $image = null;
	var $money = null;
	var $comment = null;
	var $health = null;
	var $humeur = null;
	var $posx = null;
	var $posy = null;
	var $map = null;
	var $grid = null;
	var $strength = null;
	var $intelligence = null;
	var $active = null;
	var $id_weapons = null;
	var $id_car = null;
	var $xp = null;
	var $discuter = null;
	var $taxi = null;
	var $reserve = null;
	var $munition = null;


	function __construct(&$db)
	{
		parent::__construct( 'jos_jigs_characters', 'id', $db );
	}
}
