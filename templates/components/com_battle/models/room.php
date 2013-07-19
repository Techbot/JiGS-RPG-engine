<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelRoom extends JModel
{
	
	function enter_room(){
	$db =& JFactory::getDBO();
	$user =& JFactory::getUser();
	$query = "Update #__jigs_players SET active = 2 WHERE iduser = ". $user->id;
	$db->setQuery($query);
	$result = $db->loadResult();
	return true ; 
}


	
}






