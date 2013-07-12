<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class BattleViewBuilding extends JView
{
	function display($tpl = null)
	{
		$row	= JTable::getInstance('Buildings', 'Table');
		$cid	= JRequest::getVar( 'cid', array(0), '', 'array' );
		$id	= $cid[0];
		$row->load($id);

		$this->assignRef('row', $row);
		$editor	= JFactory::getEditor();
		$this->assignRef('editor', $editor);

		if ($row->type=='apartment')
		{
			$model		= JModel::getInstance('buildings','BattleModel');
			$flats		= $model->get_flats($id);
			$this->assignRef('flats', $flats);
		}

		if($row->type=='mine'){

			$model		= JModel::getInstance('buildings','BattleModel');
			$this->mines	= $model->get_mines($id);

		}		

		if($row->type=='farm'){

			$model		= JModel::getInstance('buildings','BattleModel');
			$this->fields	= $model->get_fields($id);

		}		

		parent::display($tpl);
	}
}
