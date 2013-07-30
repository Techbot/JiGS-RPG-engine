<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewAwardNames extends JView
{
	function display($tpl = null)
	{
		$model = JModel::getInstance('awards', 'BattleModel');
		$rows  = $model->getAwardNames();

		$this->assignRef('rows', $rows);

		parent::display($tpl);
	}
}
