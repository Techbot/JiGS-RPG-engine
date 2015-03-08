<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.modellist');

class BattleModelCars extends JModellist
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
		$grid = JRequest::getVar('filter_grid', 0, '', 'int');		
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
	
	
			$query = "SELECT * FROM #__jigs_cars";
	
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
			$query->from($db->quoteName('#__jigs_cars'));
	
			$search			= $this->getState('filter.search');
	    	$grid = JRequest::getVar('filter_grid', 0, '', 'int');			
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
	
	
}
