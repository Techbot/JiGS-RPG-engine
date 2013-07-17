<?php

defined('_JEXEC') or die('Restricted access');

class TableAwardNames extends JTable
{
	var $id         = null;
	var $name       = null;	

	function __construct(&$db)
	{
		parent::__construct( '#__jigs_award_names', 'id', $db );
	}
}
