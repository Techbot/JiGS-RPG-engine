<?php
defined('_JEXEC') or die('Restricted access');
class Tablepeople extends JTable
{
	var $id				= null;
	var $name			= null;
	var $gid			= null;
	var $type			= null;
	var $avatar			= null;
	var $money			= null;
	var $comment		= null;
	var $attack			= null;
	var $defence		= null;
	var $nbr_attacks	= null;
	var $nbr_kills		= null;	
	var $health			= null;
	var $humeur			= null;
	var $posx			= null;
	var $posy			= null;
	var $map			= null;
	var $grid			= null;
	var $strength		= null;
	var $intelligence	= null;
	var $active			= null;
	var $id_weapons		= null;
	var $id_car			= null;
	var $xp				= null;
	var $discuter		= null;
	var $taxi			= null;
	var $reserve		= null;
	var $munition		= null;
	var $published		= null;

	function __construct(&$db)
	{
		parent::__construct( '#__jigs_characters', 'id', $db );
	}
}
