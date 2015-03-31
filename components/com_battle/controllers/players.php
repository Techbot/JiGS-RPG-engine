<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleControllerPlayers extends JController
{
	function __construct ($config = array())
	{
		parent::__construct($config);
		$this->registerTask('unpublish','publish');
		$this->registerTask('apply','save');
	}
	function edit()
	{
		JRequest::setVar('view', 'player');
		$this->display();
	}
	function add()
	{
		JRequest::setVar('view', 'player');
		$this->display();
	}
	function save()
	{
		JRequest::checkToken() or jexit( 'Invalid Token' );
		//global $option;
		$option = 'com_battle';
		$row =& JTable::getInstance('players', 'Table');
		if (!$row->bind(JRequest::get('post'))) 
		{
			JError::raiseError(500, $row->getError() );
		}
		if (!$row->store()) 
		{
			JError::raiseError(500, $row->getError() );
		}

		if(JRequest::getVar('task')=='apply'){
			$this->setRedirect('index.php?option=' . $option . '&controller=players&task=edit&cid=' . $row->id, 'Player Saved');
		}
		else{
			$this->setRedirect('index.php?option=' . $option . '&controller=players', 'Player Saved');
		}

	}
	function display()
	{
		$view = JRequest::getVar('view');
		if (!$view) {
			switch ($this->getTask()) {
			case 'edit':
				JRequest::setVar('view', 'player');
				break;
			default:
				JRequest::setVar('view', 'players');
				break;
			}
		}
		parent::display();
	}
}
