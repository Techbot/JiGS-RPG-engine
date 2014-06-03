<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

jimport( 'joomla.filesystem.folder' );
require_once JPATH_COMPONENT.'/helpers/messages.php';

class BattleModelHobbits extends JModel
{
	var $_data = null;

	function getData($id=0)
	{
			$query = "SELECT * FROM #__jigs_hobbits";
		
		    if ($id !=0) 
		    {
		
		    $query .= " WHERE owner = $id";
	
		    }
		    
		    else{
		    
		     $query .= " LIMIT 100";
		    
		    
		    }
		    
		    
		    
		    
			$_data = $this->_getList($query);
		
		return $_data;
	}

    function get_hobbit_stats($id_){
    
        $hobbitList = $this->getData($id_);
        
        foreach ($hobbitList as $hobbit)
        {
            if($hobbit->status==1)
            {
                $h_stats->free++;
            }
            elseif($hobbit->status==2){
            
                $h_stats->busy++;
            }
            
            elseif($hobbit->status==3){
            
                $h_stats->def++;
            }
            
            elseif($hobbit->status==4){
            
                $h_stats->distr++;
            }           
            
            
            
            $h_stats->total++;
        
        }
        
        return $h_stats;
    
    }

    function use_hobbits($id,$total,$workforce_required)
    {
  
        $db         = JFactory::getDBO();
        
        if ($total >= $workforce_required)
		{
		    $query                  = "UPDATE #__jigs_hobbits SET status = 2 
		    WHERE owner = $id 
		    ORDER BY xp ASC
		    LIMIT $workforce_required";
		    
		    $db->setQuery($query);
		    $db->query;
            // $message_result = Jview::loadHelper('messages'); //got an error without this
 
            MessagesHelper::sendFeedback($id, "$workforce_required hobbits have begun work");

		    return true;
        }
        $message_result         = MessagesHelper::sendFeedback($id, "no hobbits");
    
        return false;
    }

	function get_charactor_inventory()
	{

		$db             = JFactory::getDBO();
		$user           = JFactory::getUser();
		$character_id   = JRequest::getvar('character_id');
		
		$db->setQuery("SELECT #__jigs_inventory.item_id, #__jigs_objects.name 
		FROM #__jigs_inventory 
		LEFT JOIN #__jigs_objects ON #__jigs_inventory.item_id = #__jigs_objects.id 
		WHERE #__jigs_inventory.player_id =".$character_id);
		$result = $db->loadAssocList();
		return $result;
	}


	function get_subsection_hobbit_names()
	{
		$building_id	= JRequest::getvar('building_id');
		$dir		= JRequest::getvar('dir');
		$section_id	= JRequest::getvar('section');
		$db             = JFactory::getDBO();
		$user           = JFactory::getUser();
		
		if ($dir == 'up')
		{
			$query1		= "Update #__jigs_hobbits SET status = 1 ,section = $section_id  WHERE owner = $building_id AND status = 1 AND section = 0 LIMIT 1";
			$db->setQuery($query1);
			$db->query();
		}
		
		if ($dir == 'down')
		{
			$query1		= "Update #__jigs_hobbits SET status = 0 , section = 0  WHERE owner = $building_id AND status = 1 AND section=$section_id LIMIT 1";
			$db->setQuery($query1);
			$db->query();
		}
		
		
		$query		= "SELECT name FROM #__jigs_hobbits WHERE section = $section_id AND owner = $building_id";		
		$db->setQuery($query);
				
		$result = $db->loadAssocList();
		
		//return $query1;
		return $result;

	}

















	
}
