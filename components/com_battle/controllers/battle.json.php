<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
class BattleController extends JController
{

var $_data = null;
var $list  = null;


function check_mines(){
		$building_id = JRequest::getvar(building_id);
		$model = $this->getModel('jigs');

		$result = $model->check_mines($building_id);
	//$result= 'helllo';
	echo Json_encode($result);
}

function action(){
	
	// $model = $this->getModel('jigs');
	// $action = JRequest::getVar('action');
	// $result = $model->$action();


//exit();


// Get the document object.
// $document =& JFactory::getDocument();
 
// Set the MIME type for JSON output.
//$document->setMimeEncoding('application/json');
 
// Change the suggested filename.
//JResponse::setHeader('Content-Disposition','attachment;filename="'.$view->getName().'.json"');

        $result='hello';

//echo '$result';


	echo Json_encode($result);
	
}

function eat(){
	$model = $this->getModel('building');
	$model->eat();
	$result = 100;
	echo Json_encode($result);
}


function energy_time(){
	$building_id = JRequest::getvar(building_id);
	$model = $this->getModel('building');
	$result = $model->check_turbines($building_id);
	echo Json_encode($result);
}


function work_turbine(){

	$building_id = JRequest::getvar(building_id);
	$line = JRequest::getvar(line);
	$type = JRequest::getvar(type);
	$quantity = JRequest::getvar(quantity);
	$model = $this->getModel('building');
	$result = $model->work_turbine($building_id,$line,$type,$quantity);
	echo Json_encode($result);
}

function work_conveyer(){

	$building_id = JRequest::getvar(building_id);
	$line = JRequest::getvar(line);
	$type = JRequest::getvar(type);
	$quantity = JRequest::getvar(quantity);
	$model = $this->getModel('building');
	$result = $model->work_conveyer($building_id,$quantity,$type,$line);
	echo Json_encode($result);
}

function work_flat() {
	$model = $this->getModel('building');
	$result = $model->work_flat();

	echo Json_encode($result);
}






function display(){
	$db =& JFactory::getDBO();	
	$user =& JFactory::getUser();
	$view = JRequest::getVar('view');

	if (!$view) {
		JRequest::setVar('view', 'single');
		}
        $db->setQuery("Select active FROM jos_jigs_players WHERE iduser =".$user->id);
		$db->query();
		$player_status = $db->loadResult();
		if ($player_status == 2){
			JRequest::setVar('view', 'room');	
		}
			if ($player_status == 3){
			JRequest::setVar('view', 'ward');	
		}
		parent::display();
	}
}

$task  = JRequest::getvar('building_id');

$controller = new BattleController();
$controller->execute( $task );
$controller->redirect(); 
