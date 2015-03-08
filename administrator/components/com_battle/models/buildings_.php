<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class battleModelBuildings extends JModel
{	var $_data = null;
	
	function &getData(){
		if (empty($this->_data)) {
			$query = "SELECT * FROM #__jigs_buildings";
			$this->_data = $this->_getList($query);
		}
		return $this->_data;
	}
		
	function get_factories($building_id){
		if (empty($this->_data)) {
			$query = "SELECT * FROM jos_jigs_factories WHERE building = " . $building_id;
			$this->_data = $this->_getList($query);
		}
		//print_r($query);
		//print_r($this->data);
		return $this->_data;
	}
	
	function save_factories($_data){
		$db =& JFactory::getDBO();
		for($i=0;$i <= 7;$i++){
			$line = (int)$_data['line_' . $i];
			$type = (int) $_data['type_' . $i];
			$timestamp = (int)$_data['timestamp_' . $i];
			$quantity =  (int)$_data['quantity_' . $i];
			$building_id = (int) $_data['id'];
			$query = "INSERT INTO jos_jigs_factories (building,line,type,timestamp,quantity) VALUES ($building_id,  $line , $type , $timestamp ,$quantity  ) ON DUPLICATE KEY UPDATE type = $type, timestamp = $timestamp,quantity = $quantity ";
			$db->setQuery($query);
			$db->query();
		}
		return;
	}
	

////////////////////////////////////// Temporary Backend function mimicing same frontend function	
	
	
	function get_shop_inventory($building_id) {
	
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		
		$db->setQuery("SELECT jos_jigs_shop_prices.item_id, " .
					"jos_jigs_objects.name, " .
					"jos_jigs_shop_prices.sell_price " .
					"FROM jos_jigs_shop_prices " .
					"LEFT JOIN jos_jigs_objects " .
					"ON jos_jigs_shop_prices.item_id = jos_jigs_objects.id " .
					"WHERE jos_jigs_shop_prices.shop_id =" . $building_id);
		$result = $db->loadAssocList();
		return $result;
	}
	
	
	

	
	function getflats(){
		$query = "SELECT * FROM jos_jigs_flats";
		$this->_data2 = $this->_getList($query);		
	    //	echo $query;
		//	print_r($this->_data2);
		return $this->_data2;
	}
	
	function saveflat($building){
		//	echo $building ;
		$db =& JFactory::getDBO();
		$query = "INSERT INTO jos_jigs_flats (building) VALUES ($building)  ON DUPLICATE KEY UPDATE unused =0 ";
		$db->setQuery($query);
		return  $db->query();
			
	}
	
}