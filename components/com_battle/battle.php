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
		//$heartbeat		= $model->heartbeat();
		echo Json_encode($result);
	}

	function computer_action()
	{	
		$model			= $this->getModel('jigs');
		//$heartbeat		= $model->heartbeat();
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
	
	function hobbit_action()
	{	
		$model			= $this->getModel('hobbits');
		$action			= JRequest::getVar('action');
		$result			= $model->$action();
		echo Json_encode($result);
	}
	
		function twine_action()
	{	
		$model			= $this->getModel('twine');
		$action			= JRequest::getVar('action');
		$result			= $model->$action();
		echo Json_encode($result);
	}
	
	
	
	

    function display()
	{

		$db			= JFactory::getDBO();
		$user		= JFactory::getUser();
		$view		= JRequest::getVar('view');

		
		if ($view=='factions'||$view=='group'||$view=='canvas'||$view=='hobbits'||$view=='hobbit')
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
			$url ="index.php?option=com_content&view=article&id=12";
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
		    $db->setQuery("Select active FROM #__jigs_players WHERE id =".$user->id);
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
		    
		    if ($player_status == 4)
		    {
		        $view = $this->getView('canvas', 'html') ;
		      // $test=  $this->getModel( 'ascii_art',true);
		        
		  //      $test=  $this->getModel( 'ascii_art');
		      //  $view->setModel( $test ) ;
			    
			    JRequest::setVar('view', 'canvas');
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
