<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.modellist');
class battleModelBuildings extends JModellist
{
	var $_data = null;
	public function __constuct($config = array())
	{ 
		$this->db =& JFactory::getDBO();
		$user = JFactory::getUser();
		$this->idJoomlaUser = $user->id;
		$app = JFactory::getApplication();
		
		// Get pagination request variables
		$limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		// In case limit has been changed, adjust it
		$grid = JRequest::getVar('filter_grid', 1, '', 'int');		
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		
		parent::__constuct($config);
		
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		$this->setState('filter.search', $search);
		$this->setState('filter.grid', $grid);	
	}
	/**
	 */
	protected function populateState ($ordering = null, $direction = null){
		// Initiilise variables
		$app = Jfactory::getApplication ('administrator');
		//load the filter state
		$search			=		$this->getUserStateFromRequest($this->context. '.filter.search','filter_search');
		$this->setstate('filter.search',$search);
		$accessId		=		$this->getUserStateFromRequest ($this->context.'.filter.access', 'filter_access', null, 'int');
		$this->setstate('filter.access' , $accessId);
		$published		=		$this->getUserStateFromRequest ($this->context.'.filter.state', 'filter_published','', 'string');
		$this->setstate('filter.state' , $published);
		$categoryId		=		$this->getUserStateFromRequest ($this->context.'.filter.category_id','filter_category_id','');
		$this->setstate('filter.category_id' , $categoryId);
		//Load the parameters
		$params = JComponentHelper::getParams('com_battle');
		$this->setState('params',$params);
		//List state information
		//	parent::populateState ('a.name','asc');
	}
	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.access');
		$id.= ':' . $this->getState('filter.state');
		$id.= ':' . $this->getState('filter.category_id');
		return parent::getStoreId($id);
	}
	
	
	
	
	
	function getPagination()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}
	
	
	function getTotal()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_total)) {
			 
			 
			// $query = $this->_buildQuery();
	
	
			$query = "SELECT * FROM #__jigs_buildings";
	
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}
	
	function getData()
	{
		// if data hasn't already been obtained, load it
		if (empty($this->_data))
		{
			$db				= $this->getDbo();
			$query			= $db->getQuery(true);
			 
			$query->select('*');
			$query->from($db->quoteName('#__jigs_buildings'));
	
			$search			= $this->getState('filter.search');
	    	$grid = JRequest::getVar('filter_grid', 1, '', 'int');			
	//		 print_r($this->state);
				
				
	
			// echo $search ;
	
			//   exit();
	
	
			if (!empty($search))
			{
				$search = $db->Quote('%' . $db->getEscaped($search, true) . '%');
				$query->where('name LIKE ' . $search );
			
			}
		
			if (!empty($grid))
			{
				$query->where('grid = ' . $grid );
					
			}		
		
			$db->setQuery($query, $this->getState('limitstart'), $this->getState('limit'));
			
			echo $query;
			
			
		
			$this->_data = $db->loadObjectList();
			 
			 
		}
	
		return $this->_data;
	}

	
	function get_flats($id)
	{
		$query = "SELECT * FROM #__jigs_flats WHERE building =" . $id . " ORDER BY flat ASC" ;
		$this->_data2 = $this->_getList($query);		
		return $this->_data2;
	}
	
	function save_flats($x)
	{
		$db =& JFactory::getDBO();
		for( $i=0; $i<=7 ; $i++)
		{
			$building  = $x['building_' . $i];
			$flat      = $x['flat_'     . $i];
			$resident  = $x['resident_' . $i];
			$status    = $x['status_'   . $i];
			$timestamp = $x['timestamp_'. $i];		

			$query = "INSERT INTO #__jigs_flats (building,flat,resident,status,timestamp)
				VALUES ($building, $flat,$resident,$status,$timestamp)
				ON DUPLICATE KEY UPDATE resident = $resident,status = $status, timestamp = $timestamp ";
			$db->setQuery($query);
			$db->query();		
		}
		return $query ;
	}	
	
	function save_fields($array)
	{
	$db =& JFactory::getDBO();
		
		
	$building 		= $array['building'];
	$status_field_1	= $array['status_field_1'];
	$status_field_2	= $array['status_field_2'];
	$status_field_3	= $array['status_field_3'];
	$status_field_4	= $array['status_field_4'];
	$status_field_5	= $array['status_field_5'];
	$status_field_6	= $array['status_field_6'];
	$status_field_7	= $array['status_field_7'];
	$status_field_8	= $array['status_field_8'];
	//	global $option;
	$row =& JTable::getInstance('Fields', 'Table');
	$sql= "INSERT INTO #__jigs_fields (
	building,
	status_field_1,status_field_2,status_field_3,status_field_4,
	status_field_5,status_field_6,status_field_7,status_field_8
	) VALUES 
	(
	$building,
	$status_field_1,$status_field_2,$status_field_3,$status_field_4,
	$status_field_5,$status_field_6,$status_field_7,$status_field_8
	) 
	ON DUPLICATE KEY UPDATE 
	status_field_1 = $status_field_1,
	status_field_2 = $status_field_2,
	status_field_3 = $status_field_3,
	status_field_4 = $status_field_4,
	status_field_5 = $status_field_5,
	status_field_6 = $status_field_6,
	status_field_7 = $status_field_7,
	status_field_8 = $status_field_8
	";
	$db->setQuery($sql);
	$db->query();
	
	
	return " Fields saved Successfully";
		
	}	
	
	
	
	
	
	
	
	
	
	
	
	
}
