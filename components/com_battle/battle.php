<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleController extends JController
{
	function action()
	{
		$model			= $this->getModel('jigs');
		$action			= JRequest::getVar('action');
		$result			= $model->$action();
		$heartbeat		= $model->heartbeat();
		echo Json_encode($result);
	}

	function computer_action()
	{	
		$model			= $this->getModel('jigs');
		$heartbeat		= $model->heartbeat();
		$player			= $model->get_stats();
		$model			= $this->getModel ('computer');
		$action			= JRequest::getVar('action');
		$result			= $model->$action($player);
		echo Json_encode($result);
	}

	function building_action()
	{	
		$model			= $this->getModel('building');
		$action			= JRequest::getVar('action');
		$result			= $model->$action();
		echo Json_encode($result);
	}


    function display()
	{

		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$view		= JRequest::getVar('view');

<<<<<<< HEAD
	
	function check_factory()
	{
		$building_id = JRequest::getvar('building_id');
		$line = JRequest::getvar('line');
		$model = $this->getModel('jigs');
		$result = $model->check_factory($building_id,$line);
		//$result= 'helllo';
		echo Json_encode($result);
	}
	
	
	
	function display()
	{
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$view = JRequest::getVar('view');
		if ($user->id==0)
=======
		
		if ($view=='factions'||$view=='group')
>>>>>>> upstream/master
		{
			JRequest::setVar('view', $view);
			//$view = $this->getView($view, 'html') ;
			//$view->setModel( $this->getModel( 'factions' )) ;
			//$view->setModel( $this->getModel( 'computer'),true ) ;
			//parent::display();
					
		}
		
		
		elseif ($user->id==0)
		{
			//JRequest::setVar('view', 'loggedout');
			$url ="/index.php?option=com_comprofiler&task=login";
			$this->setRedirect( $url );
		}

		if (!$view)
		{
			JRequest::setVar('view', 'single');
			$view = $this->getView('single', 'html') ;
			$view->setModel( $this->getModel( 'jigs' )) ;
			$view->setModel( $this->getModel( 'computer'),true ) ;
			$view->display();
		}

		if ($user->id!=0)
		{
		    $db->setQuery("Select active FROM #__jigs_players WHERE iduser =".$user->id);
		    $db->query();
		    $player_status = $db->loadResult();
		    if ($player_status == 2)
		    {
			    JRequest::setVar('view', 'room');
		    }
		    if ($player_status == 3)
		    {
			    JRequest::setVar('view', 'ward');
		    }
		}




		parent::display();
	}
}
// Get an instance of the controller prefixed by HelloWorld
$controller = JController::getInstance('Battle');
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
// Redirect if set by the controller
$controller->redirect();
