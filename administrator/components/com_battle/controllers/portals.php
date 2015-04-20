<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
class BattleControllerPortals extends JController
{
    function __construct ($config = array())
    {
        parent::__construct($config);
        $this->registerTask('unpublish','publish');
        $this->registerTask('apply','save');
    }
    function edit()
    {
        JRequest::setVar('view', 'portal');
        $this->display();
    }
    function add()
    {
        JRequest::setVar('view', 'portal');
        $this->display();
    }
    function save()
    {
        JRequest::checkToken() or jexit( 'Invalid Token' );
        global $option;
        $row =& JTable::getInstance('portals', 'Table');
        if (!$row->bind(JRequest::get('post')))
        {
            JError::raiseError(500, $row->getError() );
        }
        if (!$row->store())
        {
            JError::raiseError(500, $row->getError() );
        }
        $this->setRedirect('index.php?option=com_battle&view=portals', 'Portal Saved');
    }
    function remove()
    {
        //JRequest::checkToken() or jexit( 'Invalid Token' );
        $cid = JRequest::getVar('cid', array(0));
        $row =& JTable::getInstance('portals', 'Table');
        foreach ($cid as $id)
        {
            $id = (int) $id;
            if (!$row->delete($id))
            {
                JError::raiseError(500, $row->getError() );
            }
        }
        $s = '';
        if (count($cid) > 1)
        {
            $s = 's';
        }
        $this->setRedirect('index.php?option=com_battle&view=portals' ,
            'Portal' . $s . ' deleted.');
    }
    function display()
    {
        $view = JRequest::getVar('view');
        if (!$view)
        {
            switch ($this->getTask())
            {
            case 'edit':
                JRequest::setVar('view', 'portals');
                break;
            default:
                JRequest::setVar('view', 'portals');
                break;
            }
        }
        parent::display();
    }
}
