<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class BattleControllerCars extends JController
{
    function __construct ($config = array())
    {
        parent::__construct($config);
        $this->registerTask('unpublish','publish');
        $this->registerTask('apply','save');
    }
    function edit()
    {
        JRequest::setVar('view', 'car');
        $this->display();
    }
    function add()
    {
        JRequest::setVar('view', 'car');
        $this->display();
    }
    function save()
    {
        //global $option;
        $option = 'com_battle';
        JRequest::checkToken() or jexit( 'Invalid Token' );
        $row =& JTable::getInstance('cars', 'Table');
        if (!$row->bind(JRequest::get('post')))
        {
            JError::raiseError(500, $row->getError() );
        }
        if (!$row->store())
        {
            JError::raiseError(500, $row->getError() );
        }
        $this->setRedirect('index.php?option=' . $option.'&controller=cars', "Car Saved");
    }
    function display()
    {
        $view = JRequest::getVar('view');
        if (!$view)
        {
            switch ($this->getTask())
            {
            case 'edit':
                JRequest::setVar('view', 'car');
                break;
            default:
                JRequest::setVar('view', 'cars');
                break;
            }
        }
        parent::display();
    }
}
