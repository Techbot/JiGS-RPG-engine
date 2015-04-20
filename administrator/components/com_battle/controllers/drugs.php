<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleControllerdrugs extends JController
{
    function __construct ($config = array())
    {
        parent::__construct($config);
        $this->registerTask('unpublish','publish');
        $this->registerTask('apply','save');
    }
    function edit()
    {
        JRequest::setVar('view', 'drug');
        $this->display();
    }
    function add()
    {
        JRequest::setVar('view', 'drug');
        $this->display();
    }
    function save()
    {
        global $option;
        $row =& JTable::getInstance('drugs', 'Table');
        if (!$row->bind(JRequest::get('post')))
        {
            JError::raiseError(500, $row->getError() );
        }
        if (!$row->store())
        {
            JError::raiseError(501, $row->getError() );
        }
        if ($this->getTask() == 'apply') {
            $this->setRedirect('index.php?option=' . $option . '&task=edit&cid[]=' . $row->id, 'Changes Applied');
        } else {
            $this->setRedirect('index.php?option=' . $option, 'Review Saved');
        }
    }
    function display()
    {
        $view = JRequest::getVar('view');
        if (!$view) {
            switch ($this->getTask()) {
            case 'edit':
                JRequest::setVar('view', 'drug');
                break;
            default:
                JRequest::setVar('view', 'drugs');
                break;
            }
        }
        parent::display();
    }
}
