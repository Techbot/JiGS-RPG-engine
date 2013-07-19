<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewComputer extends JView
{	
	function display($tpl = null)
	{
		
		$model = & JModel::getInstance('jigs','BattleModel');
		$player= $model->get_stats();
		// print_r($player[0]);
		$this->assignRef('player', $player);
		$computer_action = JRequest::getCmd('action');
		
		if ($computer_action !='')
			{
				$model=$this->getmodel();
				$model->$computer_action($player);
			}
			$flags = $player[0]['flags'];
			$flags = explode(',', $flags );
			if (!in_array(2,$flags))
			{
				
			}
			elseif (in_array(2,$flags))
			{
				if (!in_array(3,$flags)){
				//update flags to 3 so we never have to login again
				$model		= & JModel::getInstance('jigs','BattleModel');
				$flags[]	=3;
				$model->update_flags($flags);
				$tpl="computer_page_1"; // first time view
			}
			else {
				$tpl="computer_page_2";
		}
}
		parent::display($tpl);
	}
}
