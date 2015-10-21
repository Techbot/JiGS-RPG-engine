<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_battle/tables');

class battleViewAbc extends JViewLegacy
{	
	function display($tpl = null)
	{
        /*
		$id							= (int) JRequest::getVar('id', 0);
		$model						= $this->getModel();
		$buildings					= JTable::getInstance('buildings', 'Table');
		$buildings->load($id);
		$model2 = JModel::getInstance('jigs','BattleModel');					

		$buildings->energy			= $model2->getTotalEnergy($id);
		$owner						= $buildings->owner;
		$players					= JTable::getInstance('players', 'Table');
		$players->load($owner);	
		$this->assignRef('player', $players);	
		$backlink					= JRoute::_('index.php?option=com_battle');
		$user						= JFactory::getUser();
		$this->assignRef('user', $user);
		
		//$player					= JTable::getInstance('players', 'Table');
		//$player->load($user->id);			
		//$this->assignRef('player', $player);

		
		$cropper					= JTable::getInstance('players', 'Table');
		$cropper->load($user->id);	
		$this->assignRef('cropper', $cropper);		
		$this->assignRef('buildings', $buildings);		
		$now						= time();
		$timestamp					= $this->buildings->timestamp ;
		$this->buildings->elapsed	= $now - $timestamp;
		$this->buildings->now		= $now;
		$this->assignRef('backlink', $backlink);
		//$model					= $this->getModel();
		$board_info_1				= $model->get_board_messages($id,$this->buildings->type);

		$this->assignRef('board_info_1',$board_info_1);

		$model3                     = JModel::getInstance('hobbits','BattleModel');

        $hobbit_stats                = $model->get_hobbit_stats();
        $this->assignRef('hobbits', $hobbit_stats);




		///////////////////////////////////////////////////////////////////////////////////////////////////	
		// This is where we make an object specific to each building type 	
		///////////////////////////////////////////////////////////////////////////////////////////////////	

		if($this->buildings->type=='farm')
		{
			$fields = $model->get_fields($id);
			////////////////////////////////////////////////////////////////////////////////////		
			//print_r($fields);
			//////////////////////////////////////////////////////////////////////////////
			$this->assignRef('fields', $fields);	
		}

		if($this->buildings->type=='apartment')
		{
			$resident				= array();
			$pics		=	 array();
			$message	= array();

			$flats_array	= $model->get_flats($id);

			for($i=0;$i<=7;$i++)
			{
		//		$pics[$i]= $model->get_avatar( $flats_array[$i]['resident']);
		//		$message[$i]= $model->get_message($flats_array[$i]['resident']);
			}

			$this->assignRef('message', $message);
			$this->assignRef('flats', $flats_array);
			$this->assignRef('pics', $pics);
		}

		if($this->buildings->type=='food')
		{
			$model	= &$this->getModel();
			$crops	= $model->get_crops();
			$this->assignRef('crops', $crops);
		}

		if($this->buildings->type=='mine')
		{
			//	echo $this->buildings->id;
			//$model		= $this->getModel('jigs');
				$model	= $this->getModel();
				$mines	= $model->get_drills($this->buildings->id);
				$this->assignRef('mines', $mines);
		}	

		if($this->buildings->type=='factory')
		{
			//	echo $this->buildings->id;
			$model		= $this->getModel();
			$blueprints	= $model->get_blueprints($this->buildings->id);
			$this->assignRef('blueprints', $blueprints);

		}	

		if($this->buildings->type=='reprocessor')
		{
			//	echo $this->buildings->id;
			$model			= $this->getModel();
			$blueprints		= $model->get_blueprints($this->buildings->id);
			$this->blueprints	= $model->get_objects_required($blueprints);
		}					

		if($this->buildings->type=='scrapyard')
		{
			//	echo $this->buildings->id;
			//$model	= &$this->getModel();
			//$blueprints	= $model->get_metals($this->buildings->id);
			//$this->assignRef('metals', $metals);
		}

		if($this->buildings->type=='generator')
		{
			//$model     = $this->getInstance('jigs','BattleModel');
			$this->buildings->gentype 		= $model->get_gen_type($this->buildings->id);
			$this->buildings->battery_slots	= $model->get_battery_slots($this->buildings->id);

		/*	if($generator)
			{
				switch($generator->gentype)
				{
				case 1:
					$type = "wind";
					break;
				case 2:
					$type = "coal";
					break;
				case 3:
					$type = "water";
					break;
				case 4:
					$type = "nuclear";
					break;
				case 5:
					$type = "organic";
					break;
				}
			}
		*/
	/*
		
		}
*/
		parent::display($tpl);
	}
}
