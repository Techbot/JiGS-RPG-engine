<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewAward extends JViewLegacy
{
	function getUsersList($selected)
	{
		$model = JModel::getInstance('awards', 'BattleModel');
		$users = $model->getAwardUsers();
		$options = array();

		foreach($users as $user)
		{
			$options[] = JHTML::_('select.option', $user->iduser, $user->username);
		}

		$html = JHTML::_('select.genericlist',$options,'iduser','class="inputbox"','value','text',$selected);

		return $html;
	}

	function getAwardNamesList($selected)
	{
		$model      = JModel::getInstance('awards', 'BattleModel');
		$awardNames = $model->getAwardNames();
		$options    = array();

		foreach($awardNames as $awardName)
		{
			$options[] = JHTML::_('select.option', $awardName->id, $awardName->name);
		}

		$html = JHTML::_('select.genericlist',$options,'name_id','class="inputbox"','value','text',$selected);

		return $html;
	}

	function display($tpl = null)
	{
		$model  = JModel::getInstance('awards', 'BattleModel');
		$cid	= JRequest::getVar( 'cid', array(0), '', 'array' );
		$id	= $cid[0];

		$award       = $model->getAward($id);
		$users       = $this->getUsersList($award->iduser);
		$awardNames  = $this->getAwardNamesList($award->name_id);

		$this->assignRef('id'         , $id);
		$this->assignRef('users'      , $users);
		$this->assignRef('awardNames' , $awardNames);

		parent::display($tpl);
	}
}
