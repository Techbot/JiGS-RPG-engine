<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.modellist');
class battleModelBuildings extends JModellist
{
	var $_data = null;
	public function __constuct($config = array())
	{ 
	/*	if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'id', 'a.id' ,
					'title', 'a.name',
					'alias', 'a.comment'
					);
		}
		parent::__constuct($config);
	 */
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
		$params = JComponentHelper::getParams('com_Battle');
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
	function &getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT * FROM `#__jigs_buildings`";
			$this->_data = $this->_getList($query);
		}
		return $this->_data;
	}
	function get_flats($id)
	{
		$query = "SELECT * FROM `#__jigs_flats` WHERE `building` =" . $id . " ORDER BY `flat` ASC" ;
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

			$query = "INSERT INTO `#__jigs_flats` (`building`,`flat`,`resident`,`status`,`timestamp`)
				VALUES ($building, $flat,$resident,$status,$timestamp)
				ON DUPLICATE KEY UPDATE `resident` = $resident,`status` = $status, `timestamp` = $timestamp ";
			$db->setQuery($query);
			$db->query();		
		}
		return $query ;
	}	
}
