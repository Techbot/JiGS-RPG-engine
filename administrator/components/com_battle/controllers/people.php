<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleControllerPeople extends JController
{
    function __construct ($config = array())
    {
        parent::__construct($config);
        $this->registerTask('unpublish','publish');
        $this->registerTask('apply','save');
    }
    function edit()
    {
        JRequest::setVar('view', 'person');
        $this->display();
    }
    function add()
    {
        JRequest::setVar('view', 'person');
        $this->display();
    }
    function save()
    {
        JRequest::checkToken() or jexit( 'Invalid Token' );
        global $option;
        $row =& JTable::getInstance('people', 'Table');
        if (!$row->bind(JRequest::get('post')))
        {
            JError::raiseError(500, $row->getError() );
        }
        if (!$row->store())
        {
            JError::raiseError(500, $row->getError() );
        }

        if(JRequest::getVar('task')=='apply'){

            $this->setRedirect('index.php?option=com_battle&controller=people&task=edit&cid='.$row->id, 'people Saved');
        }
        else{

        $this->setRedirect('index.php?option=com_battle&view=people', 'people Saved');
        }


    }
    function display()
    {
        $view = JRequest::getVar('view');
        if (!$view) {
            switch ($this->getTask()) {
            case 'edit':
                JRequest::setVar('view', 'person');
                break;
            default:
                JRequest::setVar('view', 'people');
                break;
            }
        }
        parent::display();
    }
}
