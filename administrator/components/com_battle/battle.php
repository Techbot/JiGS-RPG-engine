<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once JPATH_COMPONENT.'/helpers/battle.php';

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

$controller = JRequest::getCmd('controller','people');

switch ($controller) {
	default:
		$controller = 'people';

	case 'people';
	case 'cars';
	case 'buildings';
	case 'drugs';
	case 'weapons';	
	case 'players';	
	case 'pages';
	case 'maps';	
	case 'portals';		
	
	
	
		// Load the submenu.
		BattleHelper::addSubmenu(JRequest::getCmd('view', 'people'));
	

	
		require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php' );
		$controllerName = 'BattleController'.$controller;
		$controller = new $controllerName();
		$controller->execute( JRequest::getCmd ('task') );
		$controller->redirect();
		break;
}
