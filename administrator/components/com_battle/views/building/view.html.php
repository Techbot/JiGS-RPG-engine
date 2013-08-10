<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewBuilding extends JView
{
	function display($tpl = null)
	{
		$row		= JTable::getInstance('Buildings', 'Table');
		$cid		= JRequest::getVar( 'cid', array(0), '', 'array' );
		$id			= $cid[0];
		$row->load($id);
	
		//////////////////////////////////////
		$this->assignRef('row', $row);
		$editor			= JFactory::getEditor();
		$this->assignRef('editor', $editor);
		
		
		## A default value -- this will be the selected item in the dropdown ##
		$default = 1;
	
		## An array of $key=>$value pairs ##
		$types = array(1 => 'apartment', 2 => 'papier', 3 => 'mine', 4 => 'factory', 5 => 'farm');
	
		## Initialize array to store dropdown options ##
		$options = array();
	
		foreach($types as $key=>$value) :
			## Create $value ##
			$options[] = JHTML::_('select.option', $key, $value);
		endforeach;
	
		## Create <select name="month" class="inputbox"></select> ##
		$this->dropdown = JHTML::_('select.genericlist', $options, 'type', 'class="inputbox"', 'value', 'text', $default);
	

	/////////////////////////////////////////	
		if ($row->type=='apartment')
		{
			$model			= JModel::getInstance('buildings','BattleModel');
			$flats			= $model->get_flats($id);
			$this->assignRef('flats', $flats);
		}

		
	////////////////////////////////////////
			if($row->type=='mine'){
		
		$model			= JModel::getInstance('buildings','BattleModel');
		$this->mines	= $model->get_mines($id);

		}		
		
		
	////////////////////////////////////////
			if($row->type=='farm'){
		
		$model			= JModel::getInstance('buildings','BattleModel');
		$this->fields	= $model->get_fields($id);

		}		
		
		
		
		parent::display($tpl);
	}
}
