<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelclothing extends JModel
{
	var $_data = null;

	function &getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT * FROM #__jigs_players";
			$this->_data = $this->_getList($query);
		}

		return $this->_data;
	}
	function get_clothing($id)
	{
		$user =& JFactory::getUser();


		if (empty($this->_data)) {
			$query = "SELECT * FROM #__jigs_clothing LEFT JOIN #__jigs_clothing_names ON #__jigs_clothing.item_id = #__jigs_clothing_names.id where player_id = ". $user->id;
			$this->_data = $this->_getList($query);
		}

		return $this->_data;
	}



}
