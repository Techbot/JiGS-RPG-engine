<?php
defined('_JEXEC') or die;
jimport('joomla.plugin.plugin');

class plgUserBattle_add_player extends JPlugin
{
  public function onAfterStoreUser( )
  {


			$user_id= $user['id'];
			$user_username= $user['username'];
			$db = JFactory::getDBO();
			$query = "INSERT INTO jos_jigs_players (iduser,username) VALUES ('".$user_id."','".$user_username."')";
		$db->setQuery($query);
		$result = $db->query();
	

      return true;
  }
}
