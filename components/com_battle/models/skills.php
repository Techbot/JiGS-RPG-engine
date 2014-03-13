
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelskills extends JModel
{
	var $_data = null;
	
	function &getData()
	{
		if (empty($this->_data)) {
			$query = "SELECT * FROM #__jigs_players";
			$this->_data = $this->_getList($query);
		}
		return $this->_data;
	}

	function get_skills(){
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();

		if (empty($this->_data)) {
			$query = "SELECT * FROM #__jigs_skills WHERE id = ". $user->id;
			$db->setQuery($query);
			$this->_data =  $db->loadObject();
		}
				
		for( $i=1 ; $i<=8 ; $i++ ){
			$name = 'name_'. $i;
			$nm= 'skill_' . $i;
			$query2 ="SELECT name FROM #__jigs_skill_names WHERE #__jigs_skill_names.id = " . $this->_data->$nm;
			//echo $query2;
			$db->setQuery($query2);
			$this->_data->$name = $db->loadresult();
			
		}
		return $this->_data;
	}
}
