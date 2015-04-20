<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class BattleControllerAwards extends JController
{
    function __construct ($config = array())
    {
        parent::__construct($config);
        $this->registerTask('unpublish','publish');
        $this->registerTask('apply','save');
    }
    function edit()
    {
        JRequest::setVar('view', 'award');
        $this->display();
    }
    function add()
    {
        JRequest::setVar('view', 'award');
        $this->display();
    }
    function save()
    {
        $row =& JTable::getInstance('awards', 'Table');
        $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        $row->id = $cid[0];
        if (!$row->bind(JRequest::get('get')))
        {
            JError::raiseError(500, $row->getError() );
        }
        if (!$row->store())
        {
            JError::raiseError(500, $row->getError() );
        }

        if(JRequest::getVar('task')=='apply')
        {
            $this->setRedirect('index.php?option=com_battle&controller=awards&task=edit&cid='.$row->id, 'Award Saved');
        }
        else
        {
            $this->setRedirect('index.php?option=com_battle&view=awards', 'Award Saved');
        }
    }
    function remove()
    {
        $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        $model = $this->getModel('Awards');

        if(!$model->deleteAwards($cid))
        {
            $msg = JText::_("One or more awards could not be deleted");
        }
        else
        {
            $msg = JText::_("Awards deleted");
        }

        $this->setRedirect('index.php?option=com_battle&view=awards', $msg);
    }

    function display()
    {
        $view = JRequest::getVar('view');
        if (!$view)
        {
            switch ($this->getTask())
            {
            case 'edit':
                JRequest::setVar('view', 'award');
                break;
            default:
                JRequest::setVar('view', 'awards');
                break;
            }
        }
        parent::display();
    }
}
