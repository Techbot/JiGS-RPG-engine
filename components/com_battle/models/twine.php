<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');

class BattleModelTwine extends JModel
{

	function get_status()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$query		= "SELECT * FROM #__jigs_players WHERE id = $user->id";
		$db->setQuery($query);
		$result		= $db->loadAssoc();
		return $result; 
	}
	
	function add_slack()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$query		= "Update #__jigs_players SET slack = slack + 1 WHERE id = $user->id";
		$db->setQuery($query);
		$db->query();
		$query		= "SELECT slack FROM #__jigs_players WHERE id = $user->id";
		$db->setQuery($query);
		$result		= $db->loadAssoc();
		return $result; 
	}
	
	function remove_slack()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$query		= "Update #__jigs_players SET slack  = slack + 1 WHERE id = $user->id";
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
		$result		= $db->loadResult();
		$pieces		= explode(",", $result);

		if (in_array($flag,$pieces))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	function tick_flag()
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$flag		= JRequest::getvar('flag');
		$query		= "SELECT flags FROM #__jigs_players WHERE id = $user->id";
		$db->setQuery($query);
		$result		= $db->loadResult();
		$pieces		= explode(",", $result);
		$pieces[]	= $flag;
		$flags		= implode(",", $pieces);
		$query		= "Update #__jigs_players SET flags = '$flags' WHERE id = $user->id";
		$db->setQuery($query);
		$db->query();
		return $query;
	}

}
