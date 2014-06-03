<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');

class BattleModelTwine extends JModel
{

	function get_status()
	{
		$db	= JFactory::getDBO();
		$user	= JFactory::getUser();
		$query	= "SELECT * FROM #__jigs_players WHERE id = $user->id";
		$db->setQuery($query);
		$result	= $db->loadAssoc();
		return $result; 
	}
	
	function add_slack()
	{
		$db	= JFactory::getDBO();
		$user	= JFactory::getUser();
		$query	= "Update  #__jigs_players SET slack  = slack + 1 WHERE id = $user->id";
		$db->setQuery($query);
		$db->query();
		$query	= "SELECT slack FROM #__jigs_players WHERE id = $user->id";
		$db->setQuery($query);
		$result	= $db->loadAssoc();
		return $result; 
	}
	
	function remove_slack()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$query		= "Update  #__jigs_players SET slack  = slack + 1 WHERE id = $user->id";
		$db->setQuery($query);
		$db->query();
		$query		= "SELECT slack FROM #__jigs_players WHERE id = $user->id";
		$db->setQuery($query);
		$result		= $db->loadAssoc();
		return $result; 
	}
	
	function check_flag()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$flag		= JRequest::getvar('flag');
		$query		= "SELECT flags FROM #__jigs_players WHERE id = $user->id";
		$db->setQuery($query);
		$result		= $db->loadAssoc();
		$pieces		= explode(",", $result[0]);
	
		if (in_array($flag,$pieces))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
