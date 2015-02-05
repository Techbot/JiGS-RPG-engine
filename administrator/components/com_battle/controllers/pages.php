<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleControllerPages extends JController
{
	function __construct ($config = array())
	{
		parent::__construct($config);
		$this->registerTask('unpublish','publish');
		$this->registerTask('apply','save');
	}
	function edit()
	{
		JRequest::setVar('view', 'page');
		$this->display();
	}
	function add()
	{
		JRequest::setVar('view', 'page');
		$this->display();
	}
	function save()
	{
		//JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$row =& JTable::getInstance('pages', 'Table');
		if (!$row->bind(JRequest::get('post'))) 
		{
			JError::raiseError(500, $row->getError() );
		}
		if (!$row->store()) 
		{
			JError::raiseError(500, $row->getError() );
		}
		
		
			if(JRequest::getVar('task')=='apply'){

			$this->setRedirect('index.php?option=com_battle&controller=pages&task=edit&cid='.$row->id, 'Page Saved');
		}
		
		else{
		
		$this->setRedirect('index.php?option=com_battle&view=pages', 'Page Saved');
	
	
		}
			$this->display();
	
	}
	
	
	
	
	
	function display()
	{
		$view = JRequest::getVar('view');
		if (!$view) {
			switch ($this->getTask()) {
			case 'edit':
				JRequest::setVar('view', 'page');
				break;
			default:
				JRequest::setVar('view', 'pages');
				break;
			}
		}
		parent::display();
	}

}