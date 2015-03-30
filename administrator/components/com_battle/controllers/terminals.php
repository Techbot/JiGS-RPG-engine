<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleControllerTerminals extends JController
{
	function __construct ($config = array())
	{
		parent::__construct($config);
		$this->registerTask('unpublish','publish');
		$this->registerTask('apply','save');
	}
	function edit()
	{
		JRequest::setVar('view', 'terminal');
		$this->display();
	}
	function add()
	{
		JRequest::setVar('view', 'terminal');
		$this->display();
	}
	function save()
	{
		//JRequest::checkToken() or jexit( 'Invalid Token' );
	//	global $option;
		$row =& JTable::getInstance('terminals', 'Table');
					$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
$row->id = $cid[0];
		if (!$row->bind(JRequest::get('get'))) 
		{
			JError::raiseError(500, $row->getError() );
		}
		if (!$row->store()) 
		{
			JError::raiseError(500, $row->getError() );
			
			print_r($row->getError());
			exit();
			
		}
		
		if(JRequest::getVar('task')=='apply'){

			$this->setRedirect('index.php?option=com_battle&controller=terminals&task=edit&cid='.$row->id, 'Building Saved');
		}
		
		else{
		
		$this->setRedirect('index.php?option=com_battle&view=terminals', 'Building Saved');
		}
	}
	function display()
	{
		$view = JRequest::getVar('view');
		if (!$view)
		{
			switch ($this->getTask())
			{
			case 'edit':
				JRequest::setVar('view', 'terminal');
				break;
			default:
				JRequest::setVar('view', 'terminals');
				break;
			}
		}
		parent::display();
	}
	function save_flats()
	{
		$model		= $this->getModel('terminals');
		$x			= JRequest::get('get');
		$building	= $x['building_0'];

		$message	= $model->save_flats($x);
		$this->setRedirect('index.php?option=com_battle&controller=terminals&task=edit&cid[]=' . $building . '', $message);
		$this->display();
	}
	function save_fields()
	{
		$model = $this->getModel('buildings');
		$array = JRequest::get('get');
		
		$building = $array['building'];
		$message = $model->save_fields($array);
		$this->setRedirect('index.php?option=com_battle&controller=terminals&task=edit&cid[]=' . $building . '', $message);
		$this->display();
	}
}
