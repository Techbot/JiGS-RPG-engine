<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class battleModelBuildings extends JModel
{
	var $_data = null;
	
	function &getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT * FROM jos_jigs_buildings";
			$this->_data = $this->_getList($query);
		}
		
		return $this->_data;
	}
	
	function get_flats($id){
			$query = "SELECT * FROM jos_jigs_flats WHERE building =" . $id . " ORDER BY flat ASC" ;
			$this->_data2 = $this->_getList($query);		
		    return $this->_data2;
	}

    function save_flats($x){
    	$db =& JFactory::getDBO();
    	for( $i=0; $i<=7 ; $i++){
    		
    $building		=		$x['building_'. $i];
    $flat			=		$x['flat_'. $i];
    $resident		=		$x['resident_'. $i];
    $status			=		$x['status_'. $i];
    $timestamp		=		$x['timestamp_'. $i];		
    		
    $query = "INSERT INTO jos_jigs_flats (building,flat,resident,status,timestamp) VALUES ($building, $flat,$resident,$status,$timestamp)
	ON DUPLICATE KEY UPDATE resident = $resident,status = $status, timestamp = $timestamp ";
	
    $db->setQuery($query);
	$db->query();		
	}
	return $query ;
    }	
	
}