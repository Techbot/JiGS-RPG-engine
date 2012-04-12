<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class battleModelPlayers extends JModel
{
	var $_data = null;
	
	function &getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT *, jos_comprofiler.avatar FROM jos_jigs_players ";
			$query .= "LEFT JOIN jos_comprofiler ON jos_jigs_players.iduser = jos_comprofiler.user_id ";
			$this->_data = $this->_getList($query);
		}
		
		return $this->_data;
	}
}
