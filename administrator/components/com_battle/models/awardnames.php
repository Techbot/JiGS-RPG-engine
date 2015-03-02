<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');

class BattleModelAwardNames extends JModel
{
	function getAwardName($id)
	{
		$db	= JFactory::getDBO();
		$query	= "
			SELECT name, published
			FROM   #__jigs_award_names
			WHERE  id = $id
			";

		$db->setQuery($query);
		$result	= $db->loadAssoc();

		return $result;
	}

	function deleteAwardName($id)
	{
		$db	= JFactory::getDBO();

		$query	= "
			DELETE FROM #__jigs_award_names
			WHERE id = $id
			AND NOT EXISTS (
				SELECT *
				FROM #__jigs_awards
				WHERE  name_id = $id
			)";

		$db->setQuery($query);
		$db->query();
	}
}
