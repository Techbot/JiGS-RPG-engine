<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class battleViewSingle extends JViewLegacy
{	
	function display($tpl = null)
	{
		
                 $tpl='test';


		$model = &$this->getModel();
	//	$backlink = JRoute::_('index.php?option=com_battle');
	//	$this->assignRef('backlink', $backlink);
	//	$model->savecoord();
	//	$this->assignRef('player_pos',$model->getcoord());
	//	$this->assignRef('grid',$model->getgrid());
	//	$this->assignRef('characters',$model->getchars());
		//$map =& JTable::getInstance('maps', 'Table');
		//$map->load($this->player_pos[2]);
	//	$this->assignRef('row', $map);
	//	$this->assignRef('players',$model->getplayers());
	//	$this->assignRef('buildings',$model->getbuildings());	
	//	$this->assignRef('twines',$model->getpages());
	
	// print_r($model->getplayers());


         //      $this->assignRef('heartbeat',$model->getplayers());


		parent::display($tpl);
	}
}
