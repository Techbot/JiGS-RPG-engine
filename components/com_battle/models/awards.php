<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');

class BattleModelAwards extends JModel
{
	function getAwards()
	{
		$db	= JFactory::getDBO();

		$query	= "
			SELECT   a.id , a.id, n.name as award_name,
			         u.name, u.username
			FROM     #__jigs_awards a ,
			         #__jigs_award_names n ,
			         #__users u
			WHERE    a.name_id = n.id
			AND      a.id  = u.id
			ORDER BY a.id
			";

		$db->setQuery($query);
		$result	= $db->loadObjectList();

		return $result;
	}

	function getUserAwards()
	{
		$db	= JFactory::getDBO();
		$user	= JFactory::getUser();

		$query	= "
			SELECT   a.id , a.id, n.name as award_name
			FROM     #__jigs_awards a ,
			         #__jigs_award_names n
			WHERE    a.name_id = n.id
			AND      a.id  = $user->id
			ORDER BY a.id
			";

		$db->setQuery($query);
		$result	= $db->loadObjectList();

		return $result;
	}

	function getAwardNames()
	{
		$db	= JFactory::getDBO();
		$user	= JFactory::getUser();

		$query	= "
			SELECT   id , name
			FROM     #__jigs_award_names
			ORDER BY id
			";

		$db->setQuery($query);
		$result	= $db->loadObjectList();

		return $result;
	}
}
