<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class battleModelDrugs extends JModel
{
	var $_data = null;
	
	function &getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT * FROM #__wub_drogues";
			$this->_data = $this->_getList($query);
		}
		
		return $this->_data;
	}
}