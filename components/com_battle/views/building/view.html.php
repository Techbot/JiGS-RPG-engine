<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_battle'.DS.'tables');

class BattleViewBuilding extends JView
{	
	function display($tpl = null)
	{
		$id = (int) JRequest::getVar('id', 0);
		
		$buildings =& JTable::getInstance('buildings', 'Table');
		$buildings->load($id);
		$owner = $buildings->owner;
		$players =& JTable::getInstance('players', 'Table');
		$players->load($owner);	
		$this->assignRef('player', $players);	

		$backlink = JRoute::_('index.php?option=com_battle');
		$user =& JFactory::getUser();
		$this->assignRef('user', $user);
		
		$cropper =& JTable::getInstance('players', 'Table');
		$cropper->load($user->id);	
		$this->assignRef('cropper', $cropper);		
		
		$this->assignRef('buildings', $buildings);		
		$now						= time();
		$timestamp					= $this->buildings->timestamp ;
		$this->buildings->elapsed	= $now - $timestamp;
		$this->buildings->now		= $now;
		$this->assignRef('backlink', $backlink);
		
		$model						= &$this->getModel();
		$board_info_1				= $model->get_board_messages($id,$type=2);
		
	
		
		$this->assignRef('board_info_1',$board_info_1);
		
	///////////////////////////////////////////////////////////////////////////////////////////////////	
	// This is where we make an object specific to each building type 	
	///////////////////////////////////////////////////////////////////////////////////////////////////	
		
		if($this->buildings->type=='farm'){
		$fields =& JTable::getInstance('fields', 'Table');
		$fields->load($id);		
		$this->assignRef('fields', $fields);	
		}
		
		if($this->buildings->type=='apartment'){
			$resident	= array();
			$pics		= array();
			$message	= array();
			$model		= &$this->getModel();

			$flats_array		= 		$model->get_flats($id);

		    for($i=0;$i<=7;$i++){
				$pics[$i]= $model->get_avatar( $flats_array[$i]['resident']);
				$message[$i]= $model->get_message($flats_array[$i]['resident']);
				}

			$this->assignRef('message', $message);
			$this->assignRef('flats', $flats_array);
			$this->assignRef('pics', $pics);

		}

		if($this->buildings->type=='food'){
					$model	= &$this->getModel();
					$crops	= $model->get_crops();
					$this->assignRef('crops', $crops);
					}
		
		if($this->buildings->type=='mine'){
			
		//	echo $this->buildings->id;
			
					$model	= &$this->getModel();
					$mines	= $model->get_mines($this->buildings->id);
					$this->assignRef('mines', $mines);
					}	
					
		if($this->buildings->type=='factory'){
		//	echo $this->buildings->id;
					$model		= &$this->getModel();
		 	    	$factories	= $model->get_factories($this->buildings->id);
					$this->assignRef('factories', $factories);
					}	
		
		
		parent::display($tpl);
	}
}
