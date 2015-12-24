<?php
error_reporting(E_ALL);
//ini_set('display_errors', 1);
//defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleController extends JControllerLegacy
{
    function action()
    {
        $model          = $this->getModel('jigs');
        $action         = JRequest::getVar('action');
        $result         = $model->$action();
        //$heartbeat        = $model->heartbeat();
        echo json_encode($result);
    }

    function specialaction()
    {
        $model          = $this->getModel('jigs');
        $action         = JRequest::getVar('action');
        $result         = $model->$action();
        //$heartbeat        = $model->heartbeat();
        JRequest::setVar('view', 'phaser');
        parent::display();
    }

    function computer_action()
    {
        $model              = $this->getModel('jigs');
        //$heartbeat        = $model->heartbeat();
        $player             = $model->get_stats();
        $model              = $this->getModel ('computer');
        $action             = JRequest::getVar('action');
        $result             = $model->$action($player);
        echo json_encode($result);
    }

    function building_action()
    {
        $model          = $this->getModel('building');
        $action         = JRequest::getVar('action');
        $result         = $model->$action();
        echo json_encode($result);
    }

    function bank_action()
    {
        $model          = $this->getModel('bank');
        $action         = JRequest::getVar('action');
        $result         = $model->$action();
        echo json_encode($result);
    }

    function hobbit_action()
    {
        $model          = $this->getModel('hobbits');
        $action         = JRequest::getVar('action');
        $result         = $model->$action();
        echo json_encode($result);
    }

    function glitch_action()
    {
        $model          = $this->getModel('glitch');



        $action         = JRequest::getVar('action');
        $result         = $model->$action();
        echo json_encode($result);



    }

    function twine_action()
    {
        $model          = $this->getModel('twine');
        $action         = JRequest::getVar('action');
        $result         = $model->$action();
        echo json_encode($result);
    }

    function skills_action()
    {
        $model          = $this->getModel('skills');
        $action         = JRequest::getVar('action');
        $result         = $model->$action();
        echo json_encode($result);
        exit();
    }

    function map_action()
    {

        $model          = $this->getModel('map');
        $action         = JRequest::getVar('action');
        $result         = $model->$action();
     //   echo new JResponseJson($result);
        // Set view

     //   exit();
    //    JRequest::setVar('view', 'Abc');
    //    parent::display();

        echo json_encode($result);
        exit();
    //    exit();
    }

    function terminal_action()
    {
        $model          = $this->getModel('terminal');
        $action         = JRequest::getVar('action');
        $result         = $model->$action();
        echo json_encode($result);
    }

    function display()
    {
        $db         = JFactory::getDBO();
        $user       = JFactory::getUser();
        $view       = JRequest::getVar('view');
        if (!$view)
        {
        }
        if ($user->id!=0)
        {
         //   $this->getActive($db, $user);
        }
        parent::display();
    }

    /**
     * @param $view
     * @param $user
     */
    protected function defaultViews($view, $user)
    {
        if ($view == 'factions' || $view == 'group' || $view == 'canvas' || $view == 'hobbits' || $view == 'hobbit' || $view == 'phaser' || $view == 'twine') {
       //     JRequest::setVar('view', $view);
            //$view = $this->getView($view, 'html') ;
            //$view->setModel( $this->getModel( 'factions' )) ;
            //$view->setModel( $this->getModel( 'computer'),true ) ;
            //parent::display();
        } elseif ($user->id == 0) {
            //JRequest::setVar('view', 'loggedout');
          //  $url = "index.php?option=com_content&view=article&id=12";
       //     $this->setRedirect($url);
        }
    }
    /**
     * @param $db
     * @param $user
     */
    protected function getActive($db, $user)
    {
        $db->setQuery("Select active FROM #__jigs_players WHERE id =" . $user->id);
        $db->query();
        $player_status = $db->loadResult();
        if ($player_status == 2) {
            JRequest::setVar('view', 'room');
        }
        if ($player_status == 3) {
            JRequest::setVar('view', 'ward');
        }
        if ($player_status == 4) {
            $view = $this->getView('canvas', 'html');
            // $test=  $this->getModel( 'ascii_art',true);
            //      $test=  $this->getModel( 'ascii_art');
            //  $view->setModel( $test ) ;
            JRequest::setVar('view', 'canvas');
        }
    }
}

// Set view
//JRequest::setVar('view', 'Abc');

// Get an instance of the controller prefixed by
$controller = JControllerLegacy::getInstance('Battle');
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
// Redirect if set by the controller
$controller->redirect();

