<?php

defined('_JEXEC') or die('Restricted access');

class TablePages extends JTable
{
	var $id = null;
	var $name = null;	
	var $details = null;	
	var $posy = null;	
	var $posx = null;	
	var $image = null;	
	var $type = null;
	var $xp = null;	
	var $grid = null;
	var $map = null;

	function __construct(&$db)
	{
		parent::__construct( '#__jigs_pages', 'id', $db );
	}
}
