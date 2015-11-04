<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewBuilding extends JViewLegacy
{
	function display($tpl = null)
	{
		$row		= JTable::getInstance('Buildings', 'Table');
		$now = time();
		$cid		= JRequest::getVar( 'cid', array(0), '', 'array' );
		$id			= $cid[0];
		$row->load($id);
	
		//////////////////////////////////////
		$this->assignRef('row', $row);
		$editor			= JFactory::getEditor();
		$this->assignRef('editor', $editor);
		
		
		## A default value -- this will be the selected item in the dropdown ##
		$default = $row->type;
	
		## An array of $key=>$value pairs ##
		$types = array('apartment' => 'apartment',
            'papier' => 'papier',
            'mine' => 'mine',
            'factory' => 'factory',
            'farm' => 'farm',
            'stand'=>'stand',
            'batteryshop'=>'batteryshop',
            'reprocessor' => 'reprocessor',
            'scrapyard' => 'scrapyard',
            'generator' => 'generator',
            'tunnell'=>'tunnell',
            'diner'=>'diner',
            'bank'=>'bank'
        );
	
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
		if($row->type=='mine')
		{
		
		$model			= JModel::getInstance('buildings','BattleModel');
		$this->mines		= $model->get_mines($id);

		}		
		
	////////////////////////////////////////
		if($row->type=='farm')
		{
		    $model			= JModel::getInstance('buildings','BattleModel');
		    $this->fields	= $model->get_fields($id);
            
            //print_r ($this->fields);
            //echo ($this->fields[0]->status);
            for ($i=0;$i<=8;$i++)
            {
                if (!isset($this->fields[$i]->status))
                {
                  $this->fields[$i]->status= 0;
                  $this->fields[$i]->timestamp = $now;
                }
		    }	
		}   
		
		
		
		
		
		 	
		parent::display($tpl);
	}
}
