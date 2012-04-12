<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class BattleControllerbuildings extends JController
{
function __construct ($config = array())
	{
	parent::__construct($config);
	$this->registerTask('unpublish','publish');
	$this->registerTask('apply','save');
	}


	function edit()
	{
		JRequest::setVar('view', 'building');

		$this->display();
	}
	
	function add()
	{
		JRequest::setVar('view', 'building');

		$this->display();
	}


	
	
	function save()
	{
			JRequest::checkToken() or jexit( 'Invalid Token' );
		global $option;

		$row =& JTable::getInstance('buildings', 'Table');

		if (!$row->bind(JRequest::get('post'))) 
		{
			JError::raiseError(500, $row->getError() );
		}

	

		if (!$row->store()) 
		{
			JError::raiseError(500, $row->getError() );
		}

		$this->setRedirect('index.php?option=com_battle&controller=buildings', 'Building Saved');
	}
	
	function display()
	{
		$view = JRequest::getVar('view');
		
		if (!$view) {
			switch ($this->getTask()) {
				case 'edit':
					JRequest::setVar('view', 'building');
					break;
				
				default:
					JRequest::setVar('view', 'buildings');
					break;
			}
		}

		parent::display();
	}
	
	
	function save_flats(){
		$model = $this->getModel('buildings');
		$x= JRequest::get('post');
		$building= $x['building_0'];
		$message = $model->save_flats($x);
		$this->setRedirect('index.php?option=com_battle&controller=buildings&task=edit&cid[]=' . $building . '', $message);
		$this->display();
	}
}