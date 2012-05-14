<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class battleModelMaps extends JModel
{
	var $_data = null;
	function &getData()
	{
		//	$this->_data = $this->_getList($query);
		$db =& JFactory::getDBO();
		$query = "SELECT * FROM `#__jigs_maps`";
		$db->setQuery($query);
		$result = $db->loadObjectList();
		//	$arr = explode(",", $result);
		//	$this->_data = $arr;
		//	echo "<pre>"	;
		for ($i=0;$i<=1;$i++) 
		{			
			for($x=0;$x<=7;$x++)
			{
				$name='row'.$x;
				$arr[$x] = explode(",",($result[$i]->$name)); 
			}
		}
		//	echo "</pre>"	;
		//	print_r($arr);
		return $result;
	}
}
