<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class battleModelPlayers extends JModel
{
	var $_data = null;
	function &getData()
	{
		if (empty($this->_data))
		{
			$query = "SELECT *, `#__comprofiler.avatar` FROM `#__jigs_players` ";
			$query .= "LEFT JOIN `#__comprofiler` ON `#__jigs_players.iduser` = `#__comprofiler.user_id` ";
			$this->_data = $this->_getList($query);
		}
		return $this->_data;
	}
}
