<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelmetals extends JModel
{
	var $_data = null;

	function &getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT * FROM #__jigs_metals";
			$this->_data = $this->_getList($query);
		}
		return $this->_data;
	}

	function get_metals(){
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();

		if (empty($this->_data)) {
			$query = "SELECT * FROM #__jigs_metals WHERE player_id = ". $user->id;
			$db->setQuery($query);
			$this->_data =  $db->loadObjectlist();
		}

		//	print_r($this->_data);

		$i=0;
		foreach( $this->_data as $row ){

			$query2 ="SELECT name FROM jos_jigs_metal_names WHERE jos_jigs_metal_names.id = " . $row->item_id;
			//echo $query2;
			$db->setQuery($query2);
			$this->_data[$i]->name = $db->loadresult();
			$i++;
		}


		return $this->_data;
	}
}
