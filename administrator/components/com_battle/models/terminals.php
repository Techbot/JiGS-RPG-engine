<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.modellist');
class battleModelTerminals extends JModellist
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
	
	
			$query = "SELECT * FROM #__jigs_terminals";
	
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
			$query->from($db->quoteName('#__jigs_terminals'));
	
			$search			= $this->getState('filter.search');
	    	$grid = JRequest::getVar('filter_grid', 1, '', 'int');			
	        $type = JRequest::getVar('filter_type',0, '', 'var');
			
			
			
			
			
			if (!empty($search))
			{
				$search = $db->Quote('%' . $db->getEscaped($search, true) . '%');
				$query->where('name LIKE ' . $search );
			}
			
			
			if (!empty($grid))
			{
				$query->where('grid = ' . $grid );
			}
			
			if (!empty($type))
			{
				$query->where('type = "' . $type . '"' );
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
	  $db = JFactory::getDBO();
      $building  = $array['building'];

   	  $status_array[1]     = $array['status_field_0'];
   	  $status_array[2]     = $array['status_field_1'];
   	  $status_array[3]     = $array['status_field_2'];
   	  $status_array[4]     = $array['status_field_3'];
   	  $status_array[5]     = $array['status_field_4'];
   	  $status_array[6]     = $array['status_field_5'];
   	  $status_array[7]     = $array['status_field_6'];
   	  $status_array[8]     = $array['status_field_7'];
	
	$i=1;
	foreach ($status_array as $status)
	{
			
		$query = "INSERT INTO j17_jigs_farms (building,field,status)
			VALUES ($building, $i,$status)
			ON DUPLICATE KEY UPDATE status = $status ";
       	$db->setQuery($query);
	    $db->query();
	    $i++;
    }
   
  //return $query ;
   	return " Fields saved Successfully";
	}	
	
	function get_fields($id)
	{
	    $db = JFactory::getDBO();
		$query = "SELECT * FROM #__jigs_farms WHERE building =" . $id ;
		$db->setQuery($query);
		$fields = $db->loadObjectList();
		return $fields;
		
		
		
	}
	
	
	function get_my_blueprints_list()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT #__jigs_blueprints.id, #__jigs_objects.name  
		FROM #__jigs_blueprints  LEFT JOIN #__jigs_objects  
		ON #__jigs_blueprints.object = #__jigs_objects.id  
		WHERE #__jigs_blueprints.user_id =".$user->id);
		
		$result		= $db->loadAssocList();
		return $result;

	}
	
	
	function get_mines($id)
	{
		
		$query = "SELECT * FROM #__jigs_mines WHERE building =" . $id . " ORDER BY mine ASC" ;
		$this->_data2 = $this->_getList($query);	
		
		return $this->_data2;
		
	}
	
	
	
	
	
	
	
	
	
	
	
}
