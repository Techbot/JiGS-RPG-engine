<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class BattleControllerAwardNames extends JController
{
    function __construct ($config = array())
    {
        parent::__construct($config);
        $this->registerTask('unpublish','publish');
        $this->registerTask('apply','save');
    }
    function edit()
    {
        JRequest::setVar('view', 'awardname');
        $this->display();
    }
    function add()
    {
        JRequest::setVar('view', 'awardname');
        $this->display();
    }
    function save()
    {
        $row =& JTable::getInstance('awardnames', 'Table');
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
            $this->setRedirect('index.php?option=com_battle&controller=awardnames&task=edit&cid='.$row->id, 'Award Saved');
        }
        else
        {
            $this->setRedirect('index.php?option=com_battle&view=awardnames', 'Award Saved');
        }
    }
    function remove()
    {
        $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        $model = $this->getModel('Awards');

        $count = $model->deleteAwardNames($cid);
        $msg = JText::_("$count Award Names deleted");

        $this->setRedirect('index.php?option=com_battle&view=awardnames', $msg);
    }

    function display()
    {
        $view = JRequest::getVar('view');
        if (!$view)
        {
            switch ($this->getTask())
            {
            case 'edit':
                JRequest::setVar('view', 'awardname');
                break;
            default:
                JRequest::setVar('view', 'awardnames');
                break;
            }
        }
        parent::display();
    }
}
