<?php

defined('_JEXEC') or die('Restricted access');

class Tableportals extends JTable
{
	var $id		= null;
	var $from_x	= null;
        var $from_y	= null;
	var $from_grid	= null;
	var $from_map	= null;
	var $to_x	= null;
        var $to_y	= null;
	var $to_grid	= null;
	var $to_map	= null;	

	function __construct(&$db)
	{
		parent::__construct( 'jos_jigs_portals', 'id', $db );
	}
}
