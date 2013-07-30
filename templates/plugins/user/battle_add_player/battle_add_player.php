<?php
defined('_JEXEC') or die;
jimport('joomla.plugin.plugin');

class plgUserBattle_add_player extends JPlugin
{

/*
		public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
		//JFormHelper::addFieldPath(dirname(__FILE__) . '/fields');
	}
*/		
		
	public function onUserAfterSave($user, $isnew, $success, $msg )
	{
		$user_id		= $user['id'];
		$user_username	= $user['username'];
		$db				= JFactory::getDBO();
		$query			= "INSERT INTO #__jigs_players (iduser,username) VALUES ($user_id,$user_username)";
		$db->setQuery($query);
		$result			= $db->query();
		return true;
	}
}
