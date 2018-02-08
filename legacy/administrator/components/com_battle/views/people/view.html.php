<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class battleViewPeople extends JViewLegacy
{

	protected $items;
	protected $pagination;
	protected $state;
	
/*
 * Display the View
 * 
 * 
 *  */	
	
	
	public function display($tpl = null)
	{
		$this->state = $this->get('State');
	//	$this->items = $this->get('Items');
	//	$this->pagination = $this->get('Pagination');
		
		//Check for errors
		if(count($errors= $this->get('errors)'))){
			JError::raiseError(500,implode('\n',$errors));
			return false;
		}
				
		
		$rows =$this->get('data');
		

		
		$this->assignRef('rows', $rows);
		

	//	$this->addToolbar();
    	parent::display($tpl);
	}
}