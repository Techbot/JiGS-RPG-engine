<?php

defined('_JEXEC') or die('Restricted access');

class TableFields extends JTable
{
	var $id = null; 	
	var $building = null; 	
	var $status_field_1 = null; 	
	var $status_field_2 = null; 	
	var $status_field_3 = null; 	
	var $status_field_4 = null; 	
	var $status_field_5 = null; 	
	var $status_field_6 = null; 	
	var $status_field_7 = null; 	
	var $status_field_8 = null; 	
	var $crop_1 = null; 	
	var $crop_2 = null; 	
	var $crop_3 = null;	
	var $crop_4 = null; 	
	var $crop_5 = null; 	
	var $crop_6 = null; 	
	var $crop_7 = null; 	
	var $crop_8 = null; 	
	var $timestamp_1 = null; 	
	var $timestamp_2 = null; 	
	var $timestamp_3 = null; 	
	var $timestamp_4 = null; 	
	var $timestamp_5 = null; 	
	var $timestamp_6 = null; 	
	var $timestamp_7 = null; 	
	var $timestamp_8 = null; 


	function __construct(&$db)
	{
		parent::__construct( 'jos_jigs_fields', 'id', $db );
	}
}
