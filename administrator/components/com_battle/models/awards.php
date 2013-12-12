<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');

class BattleModelAwards extends JModel
{
	function getAwards()
	{
		$db	= JFactory::getDBO();
		$query	= "
			SELECT   a.id , a.iduser, n.name as award_name,
			n.published as published,
			         u.name, u.username
			FROM     #__jigs_awards a ,
			         #__jigs_award_names n ,
			         #__users u
			WHERE    a.name_id = n.id
			AND      a.iduser  = u.id
			ORDER BY a.id
			";

		$db->setQuery($query);
		$result	= $db->loadObjectList();

		return $result;
	}
	
	function getAward($id)
	{
		$db     = JFactory::getDBO();
		$query  = "
			SELECT	a.id ,
				a.iduser as iduser,
				a.name_id as name_id,
				n.name as award_name,
				u.name, u.username
			FROM	#__jigs_awards a,
				#__jigs_award_names n,
				#__users u
			WHERE	a.name_id = n.id
			AND	a.iduser  = u.id
			AND	a.id      = $id
			";
		
		$db->setQuery($query);
		$result = $db->loadObject();
		return $result;
	}

	function getUserAwards()
	{
		$db	= JFactory::getDBO();
		$user	= JFactory::getUser();

		$query	= "
			SELECT   a.id , a.iduser, n.name as award_name
			FROM     #__jigs_awards a ,
			         #__jigs_award_names n
			WHERE    a.name_id = n.id
			AND      a.iduser  = $user->id
			ORDER BY a.id
			";

		$db->setQuery($query);
		$result	= $db->loadObjectList();

		return $result;
	}

	function deleteAwards($cid)
	{
		$db     = JFactory::getDBO();

		if(count($cid))
		{
			$cids = implode(',',$cid);
			$query = "
				DELETE FROM #__jigs_awards
				WHERE id IN ($cids)
				";
			$db->setQuery($query);
			if($db->query())
			{
				return true;
			}
		}
		return false;
	}

	function getAwardName($id)
	{
		$db	= JFactory::getDBO();
		$query	= "
			SELECT   name
			FROM     #__jigs_award_names
			WHERE    id = $id
			";

		$db->setQuery($query);
		$result	= $db->loadObject();

		return $result;
	}

	function getAwardNames()
	{
		$db	= JFactory::getDBO();
		$query	= "
			SELECT   id , name ,published
			FROM     #__jigs_award_names
			ORDER BY id
			";

		$db->setQuery($query);
		$result	= $db->loadObjectList();

		return $result;
	}

	function deleteAwardNames($cid)
	{
		$db     = JFactory::getDBO();
		$count  = 0;

		foreach($cid as $c)
		{
			$query = "
				DELETE FROM #__jigs_award_names
				WHERE id = $c
				AND NOT EXISTS (
					SELECT *
					FROM #__jigs_awards
					WHERE  name_id = $c
				)";

			$db->setQuery($query);
			$res = $db->query();

			if($res)
			{
				$count += $db->getAffectedRows($res);
			}
		}
		return $count;
	}

	function getAwardUsers()
	{
		$db	= JFactory::getDBO();
		$query	= "
			SELECT    iduser, username
			FROM      #__jigs_players
			ORDER BY  username
			";

		$db->setQuery($query);
		$result	= $db->loadObjectList();

		return $result;
	}
}
