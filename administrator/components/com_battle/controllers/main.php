<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleControllerMain extends JController
{
    function __construct ($config = array())
    {
        parent::__construct($config);

    }
    function factionalise()
    {
        $model			=	$this->getModel('main');
        $factionalise	=	$model->factionalise();
        JRequest::setVar('view', 'main');
        $this->display();

    }

    function delete_players_orphaned()
    {
        $model		=	$this->getModel('main');
        $this->del	=	$model->delete_players_orphaned();
        JRequest::setVar('view', 'main');
        $this->display();
    }


    function sync_players()
    {
        $model		=	$this->getModel('main');
        $sync		=	$model->sync_players();
        JRequest::setVar('view', 'main');
        $this->display();
    }
    function sync_players_health()
    {
        $model		=	$this->getModel('main');
        $sync		=	$model->sync_players_health();
        JRequest::setVar('view', 'main');
        $this->display();
    }
    function sync_players_batteries()
    {
        $model		= $this->getModel('main');
        $sync		= $model->sync_players_batteries();
        JRequest::setVar('view', 'main');
        $this->display();
    }
    function sync_players_message()
    {
        $model		= $this->getModel('main');
        $sync		= $model->sync_players_message();
        JRequest::setVar('view', 'main');
        $this->display();
    }
    function sync_players_leases()
    {
        $model		= $this->getModel('main');
        $sync		= $model->sync_players_leases();
        JRequest::setVar('view', 'main');
        $this->display();
    }
        function sync_players_skills()
    {
        $model		= $this->getModel('main');
        $sync		= $model->sync_players_skills();
        JRequest::setVar('view', 'main');
        $this->display();
    }
    function edit()
    {
        JRequest::setVar('view', 'twine');
        $this->display();
    }
    function add()
    {
        JRequest::setVar('view', 'main');
        $this->display();
    }
    function save()
    {
        JRequest::checkToken() or jexit( 'Invalid Token' );
        global $option;
        $table =& JTable::getInstance('#__extensions', 'Table');
        $sbid = JRequest::getVar('sbid');
        $post['option'] = 'com_battle';
        $post['params']['sbid']=$sbid;

        if (!$table->bind('post'))
        {
            JError::raiseError(500, $row->getError() );
        }
        if (!$table->store())
        {
            JError::raiseError(500, $row->getError() );
        }
        $this->setRedirect('index.php?option=' . $option.'&controller=main', 'Config Saved');
    }
    function get_message()
    {
        $model		=	$this->getModel('main');
        $message	=	$model->get_message();
        echo Json_encode($message);

    }

    function add_hacking()
    {
        $model		=	$this->getModel('main');
        $message	=	$model->add_hacking();
        echo Json_encode($message);

    }


    function display()
    {
        $view		= JRequest::getVar('view');
        if (!$view) {
            switch ($this->getTask()) {
            case 'edit':
                JRequest::setVar('view', 'main');
                break;
            default:
                JRequest::setVar('view', 'main');
                break;
            }
        }
        parent::display();
    }
}
