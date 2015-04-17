<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
class battleModelPlates extends JModel
{
	var $_data = null;
	function &getData()
	{
		if (empty($this->_data))
		{
			$query = "SELECT * FROM `#__jigs_plates`";
			$this->_data = $this->_getList($query);
		}
		return $this->_data;
	}
	function getpage()
	{
		$query = "SELECT * FROM `#__jigs_plates`";
		$this->_data2 = $this->_getList($query);
		//	echo $query;
		//	print_r($this->_data2);
		return $this->_data2;
	}
	function savepage($page)
	{
		//	echo $building ;
		$db =& JFactory::getDBO();
		$query = "INSERT INTO `#__jigs_plates` (`twine`) VALUES ($page)  ON DUPLICATE KEY UPDATE `unused`=0 ";
		$db->setQuery($query);
		return  $db->query();
	}

    function deletepage($cid)
    {
        $db     = JFactory::getDBO();

        if(count($cid))
        {
            $cids = implode(',',$cid);
            $query = "
				DELETE FROM #__jigs_pag__jigs_plateses
				WHERE id IN ($cids)
				";
            $db->setQuery($query);
            if($db->query())
            {
                return true;
            }
        }
        return false;
    }
}
