<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelCanvas extends JModel
{
	
	function enter_Canvas(){
	$db = JFactory::getDBO();
	$user = JFactory::getUser();
	$query = "Update #__jigs_players SET active=4 WHERE iduser = ". $user->id;
	$db->setQuery($query);
	$db->query();
	return (JRequest::getvar('id'));
	}


	
}






