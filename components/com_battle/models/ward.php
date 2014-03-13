<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelWard extends JModel
{
	
	function enter_ward(){
	$db =& JFactory::getDBO();
	$user =& JFactory::getUser();
	$query = "Update #__jigs_players SET active=3 WHERE id = ". $user->id;
	$db->setQuery($query);
	$db->query();
	return ;
	}


	
}






