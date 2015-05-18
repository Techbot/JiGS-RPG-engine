<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleControllerTwines extends JController
{
    function __construct ($config = array())
    {
        parent::__construct($config);
        $this->registerTask('unpublish','publish');
        $this->registerTask('apply','save');
    }
    function edit()
    {
        JRequest::setVar('view', 'twine');
        $this->display();
    }
    function add()
    {
        JRequest::setVar('view', 'twine');
        $this->display();
    }
    function save()
    {
        //JRequest::checkToken() or jexit( 'Invalid Token' );
        $row =& JTable::getInstance('twines', 'Table');
        if (!$row->bind(JRequest::get('post')))
        {
            JError::raiseError(500, $row->getError() );
        }
        if (!$row->store())
        {
            JError::raiseError(500, $row->getError() );
        }
        if(JRequest::getVar('task')=='apply'){
            $this->setRedirect('index.php?option=com_battle&controller=twines&task=edit&cid='.$row->id, 'Twine Saved');
        }
        else{
        $this->setRedirect('index.php?option=com_battle&view=twines', 'Twine Saved');
        }
        $this->display();
    }
















    function remove()
    {
        $cid        = JRequest::getVar( 'cid', array(0), '', 'array' );
        $model      = $this->getModel('twines');
        if(!$model->deletepage($cid))
        {
            $msg = JText::_("One or more twines could not be deleted");
        }
        else
        {
            $msg = JText::_("twines deleted");
        }

        $this->setRedirect('index.php?option=com_battle&view=twines', $msg);
    }






    function publish()
    {
//      global $option;
        $cid        = JRequest::getVar('cid', array());
        $row        = JTable::getInstance('twines', 'Table');
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
    function display()
    {
        $view = JRequest::getVar('view');
        if (!$view) {
            switch ($this->getTask()) {
            case 'edit':
                JRequest::setVar('view', 'twine');
                break;
            default:
                JRequest::setVar('view', 'twines');
                break;
            }
        }
        parent::display();
    }
}
