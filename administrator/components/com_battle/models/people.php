<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class battleModelPeople extends JModel
{
	var $_data = null;
	
	function &getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT * FROM jos_jigs_characters";
			$this->_data = $this->_getList($query);
		}
		
		return $this->_data;
	}
}