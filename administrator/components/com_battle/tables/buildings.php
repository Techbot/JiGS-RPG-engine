<?php

defined('_JEXEC') or die('Restricted access');

class TableBuildings extends JTable
{
	var $id = null;
	var $name = null;	
	var $comment = null;	
	var $posy = null;	
	var $posx = null;	
	var $protection = null;	
	var $image = null;	
	var $coffre = null;	
	var $type = null;
	var $public = null;
	var $couleur = null;
	var $xp = null;	
	var $owner = null;
	var $owner_team = null;
	var $price = null;	
	var $timestamp = null;
	var $grid = null;
	var $map = null;
	var $published = null;


	function __construct(&$db)
	{
		parent::__construct( 'jos_jigs_buildings', 'id', $db );
	}
}
