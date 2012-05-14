<?php

defined('_JEXEC') or die('Restricted access');

class TableDrugs extends JTable
{
	var $id = null;
	var $iduser = null;	
	var $quantite1 = null;	
	var $prix1 = null ;
	var $quantite2 = null;	
	var $prix2 = null ;	
	var $quantite3 = null;	
	var $prix3 = null ;
	var $quantite4 = null;	
	var $prix4 = null ;
	var $quantite5 = null;	
	var $prix5 = null ;
	var $quantite6 = null;	
	var $prix6 = null ;	
	var $quantite7 = null;	
	var $prix7 = null ;	
	var $timer = null ;	

	function __construct(&$db)
	{
		parent::__construct( '#___wub_drogues', 'id', $db );
	}
}
