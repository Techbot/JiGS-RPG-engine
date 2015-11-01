<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewCars extends JViewLegacy
{	
    protected $items;
    protected $pagination;
    protected $state;


    function display($tpl = null)
    {
    $this->state = $this->get('State');
        $rows =& $this->get('data');
        $pagination =& $this->get('pagination');
        $search =& $this->get('search');
        $this->assignRef('rows', $rows);
        $this->assignRef('pagination', $pagination);
        $this->assign('search', $search);
        parent::display($tpl);
    }
}
