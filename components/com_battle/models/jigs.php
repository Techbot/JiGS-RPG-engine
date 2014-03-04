<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modellist');

class BattleModelJigs extends JModellist{



	function get_messages(){
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$db->setQuery("SELECT message FROM #__jigs_logs WHERE user_id =".$user->id ." ORDER BY timestamp DESC LIMIT 6");
		$message_list	= $db->loadObjectList();

		return $message_list;
	}



}
