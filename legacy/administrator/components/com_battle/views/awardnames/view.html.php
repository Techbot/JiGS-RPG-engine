<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewAwardNames extends JViewLegacy
{
	function display($tpl = null)
	{
		$model = JModellegacy::getInstance('awards', 'BattleModel');
		$rows  = $model->getAwardNames();

		$this->assignRef('rows', $rows);

		parent::display($tpl);
	}
}
