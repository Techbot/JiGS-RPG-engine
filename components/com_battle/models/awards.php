<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');

class BattleModelAwards extends JModel
{
	function get_awards()
	{
		$db	= JFactory::getDBO();
		$user	= JFactory::getUser();

		$query	= "
			SELECT   a.id , a.iduser, n.name as award_name,
			         u.name, u.username
			FROM     #__jigs_awards a ,
			         #__jigs_award_names n ,
			         #__users u
			WHERE    a.name_id = n.id
			AND      a.iduser  = u.id
			ORDER BY a.id
			";

		$db->setQuery($query);
		$result	= $db->loadAssoc();

		return $result;
	}

	function get_award_names()
	{
		$db	= JFactory::getDBO();
		$user	= JFactory::getUser();

		$query	= "
			SELECT   id , name
			FROM     #__jigs_award_names
			ORDER BY id
			";

		$db->setQuery($query);
		$result	= $db->loadAssoc();

		return $result;
	}

}
