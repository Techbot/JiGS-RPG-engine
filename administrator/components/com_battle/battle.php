<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once JPATH_COMPONENT.'/helpers/battle.php';
JTable::addIncludePath(JPATH_COMPONENT.'/tables');
$controller = JRequest::getCmd('controller','main');
BattleHelper::addSubmenu(JRequest::getCmd('view', $controller));
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once( JPATH_COMPONENT.'/controllers/'.$controller.'.php' );

$controllerName = 'BattleController'.$controller;
$controller = new $controllerName();
$controller->execute( JRequest::getCmd ('task') );
$controller->redirect();
