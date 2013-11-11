<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once JPATH_COMPONENT.'/helpers/battle.php';
JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
$controller = JRequest::getCmd('controller','people');
BattleHelper::addSubmenu(JRequest::getCmd('view', $controller));

require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php' );

$controllerName = 'BattleController'.$controller;
$controller = new $controllerName();
$controller->execute( JRequest::getCmd ('task') );
$controller->redirect();
