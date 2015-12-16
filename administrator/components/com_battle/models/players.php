<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.modellist');
class battleModelPlayers extends JModellist
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

    function getData2()
    {
        // if data hasn't already been obtained, load it
        if (empty($this->_data))
        {
            $db				= $this->getDbo();
            $query			= $db->getQuery(true);
            $query->select('*');
            $query->from($db->quoteName('#__jigs_players'));
            $search			= $this->getState('filter.search');
            $grid = JRequest::getVar('filter_grid', 1, '', 'int');
    //		 print_r($this->state);

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
    function getData()
    {
        if (empty($this->_data))
        {
            $query = "SELECT a.*, b.avatar,c.*  FROM #__users AS a";
            $query .= " LEFT JOIN #__comprofiler AS b ON a.id = b.user_id";
            $query .= " LEFT JOIN #__jigs_players AS c ON c.id = a.id";
            $data  = $this->_getList($query);
            $list = $this->getFactions($data);

        }
        return $list;
    }
    function getFactions($list)	{
        foreach ($list as &$row)
        {
            $db				= JFactory::getDBO();
            $query			= "SELECT group_id FROM #__user_usergroup_map WHERE user_id =$row->id";
            $db->setQuery($query);
            $groups	= $db->loadResultArray();
            if($groups)
            {
                $row->title = $this->get_group_names($groups);
            }
        }
        return $list;
    }

    function get_group_names($groups){
        $db				= JFactory::getDBO();
        foreach($groups as $group)
        {
            $query		= "SELECT title FROM #__usergroups WHERE id = $group";
            $db->setQuery($query);
            $name[]		= $db->loadResult();
        }
        return $name;
    }
}

