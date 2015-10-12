<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelRoom extends JModelLegacy
{
	
	function enter_room()
	{
		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$query		= "Update #__jigs_players SET active = 2 WHERE id = ". $user->id;
		$db->setQuery($query);
		$db->query();
		return true ; 
	}


	
}






