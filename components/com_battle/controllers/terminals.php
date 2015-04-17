<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleControllerterminals extends JController
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

        $this->setRedirect('index.php?option=com_battle&view=terminals', 'Terminal Saved');
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
    function remove()
    {
        $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        $model = $this->getModel('terminals');

        if(!$model->deletepage($cid))
        {
            $msg = JText::_("One or more twines could not be deleted");
        }
        else
        {
            $msg = JText::_("twines deleted");
        }

        $this->setRedirect('index.php?option=com_battle&view=terminals', $msg);
    }


    function publish()
    {
//        global $option;
        $cid = JRequest::getVar('cid', array());
        $row =& JTable::getInstance('terminals', 'Table');
        $publish = 1;
        if($this->getTask() == 'unpublish')
        {
            $publish = 0;
        }
        if(!$row->publish($cid, $publish))
        {
            JError::raiseError(500, $row->getError() );
        }
        $s = '';
        if (count($cid) > 1)
        {
            $s = 's';
        }
        $msg = 'Page' . $s;
        if ($this->getTask() == 'unpublish')

        {
            $msg .= ' unpublished';
        }
        else
        {
            $msg .= ' published';
        }
        // $this->setRedirect('index.php?option=' . $option, $msg);
        $this->setRedirect('index.php?option=com_battle&view=twines', $msg);
    }

}
