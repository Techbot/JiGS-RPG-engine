<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewAwards extends JViewLegacy
{
	function display($tpl = null)
	{
		$model = JModel::getInstance('awards', 'BattleModel');
		$rows  = $model->getAwards();

		$this->assignRef('rows', $rows);

		parent::display($tpl);
	}
}
