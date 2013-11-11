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
	
	
	
	function onUserAfterDelete($user, $success, $msg)
        {
                if (!$success) {
                        return false;
                }
 
                $userId = JArrayHelper::getValue($user, 'id', 0, 'int');
 
                if ($userId)
                {
                        try
                        {
                                $db = JFactory::getDbo();
                                $db->setQuery(
                                        'DELETE FROM #__jigs_players WHERE iduser = '.$userId 
                                                                       );
 
                                if (!$db->query()) {
                                        throw new Exception($db->getErrorMsg());
                                }
                        }
                        catch (JException $e)
                        {
                                $this->_subject->setError($e->getMessage());
                                return false;
                        }
                }
 
                return true;
        }
	
	
	
	
	
	
	
	
	
	
	
	
	
}
