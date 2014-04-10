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
            
            $h_stats->total++;
        
        }
        
        return $h_stats;
    
    }

    function use_hobbits($id,$total,$workforce_required)
    {
    
  
        $db             = JFactory::getDBO();
        $user = JFactory::getUser();
        $id = $user->id;
        
        if ($total >= $workforce_required)
		{
		    $query                  = "UPDATE #__jigs_hobbits SET status = 2 
		    WHERE owner = $id 
		    LIMIT $workforce_required 
		    ORDER BY xp ASC";
		    
		    $db->setQuery($query);
		    $db->query;
            // $message_result = Jview::loadHelper('messages'); //got an error without this
            $message_result         = MessagesHelper::sendFeedback($id, "$workforce_required hobbits have begun work");

		    return true;
		}
        
       
       
       $message_result         = MessagesHelper::sendFeedback($id, "no hobbits");
       
        return false;

    }

	function get_charactor_inventory() {

		$db             = JFactory::getDBO();
		$user           = JFactory::getUser();
		$character_id   = JRequest::getvar(character_id);
		
		
		
		$db->setQuery("SELECT #__jigs_inventory.item_id, " .
				"#__jigs_objects.name " .
				"FROM #__jigs_inventory " .
				"LEFT JOIN #__jigs_objects " .
				"ON #__jigs_inventory.item_id = #__jigs_objects.id " .
				"WHERE #__jigs_inventory.player_id =".$character_id);
		$result = $db->loadAssocList();
		return $result;
	}
	
}
