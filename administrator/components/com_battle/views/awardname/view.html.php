<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewAwardName extends JViewLegacy
{
	function showName($name)
	{
		return JHTML::_('input.text', 'name', $name);
	}

	function display($tpl = null)
	{
		$model  = JModel::getInstance('awards', 'BattleModel');
		$cid	= JRequest::getVar( 'cid', array(0), '', 'array' );
		$id	= $cid[0];
		$award  = $model->getAwardName($id);

		$this->assignRef('id'  , $id);
		$this->assignRef('name', $award->name);

		parent::display($tpl);
	}
}
