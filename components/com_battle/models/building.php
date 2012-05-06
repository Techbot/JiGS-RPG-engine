<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class BattleModelBuilding extends JModel {
	
	function get_crops(){
		
		$total_crop = 0;
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$query = "SELECT crops FROM jos_jigs_fields LEFT JOIN jos_jigs_buildings 
		ON jos_jigs_fields.building = jos_jigs_buildings.id 
		WHERE jos_jigs_buildings.owner = $user->id; ";
		$db->setQuery($query);
		$result = $db->loadResultArray();
		
		foreach($result as $row){
			$total_crop = $total_crop + $row;
		}
		return ($total_crop);
	}
	
	function sell_crops() {
		$crops= $this->get_crops();
		$payment = $crops * 1000 ;
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$query_1 ="SELECT money FROM jos_jigs_players WHERE iduser = '$user->id'";
		$db->setQuery($query_1);
		$money_saved = $db->loadResult();
		$money= $money_saved + $payment;
		$x=	"Update jos_jigs_players SET money = $money WHERE iduser= " . $user->id;
		$db->setQuery($x);
		$db->query();
		$x=	"Update jos_jigs_fields 
		LEFT JOIN jos_jigs_buildings on jos_jigs_fields.building = jos_jigs_buildings.id 
		SET crops = 0 WHERE jos_jigs_buildings.owner = $user->id";
		$db->setQuery($x);
		$db->query();
		return($money_saved);
	}

function eat() {
	
	$db =& JFactory::getDBO();
	$user =& JFactory::getUser();
	$query ="SELECT health,money FROM jos_jigs_players WHERE iduser = '$user->id'";
	$db->setQuery($query);
	$result = $db->loadAssoc();
	echo $result;
	$health = $result['health'];
	$money  = $result['money'];
	$money = $money - 10; 
	$health = $health + 10; 	
	$x=	"Update jos_jigs_players SET money = $money, health = $health WHERE iduser= " . $user->id;
	$db->setQuery($x);
    $db->query();
    return ;
        
}

function get_avatar($resident)
	{
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT 
				jos_comprofiler.avatar
				FROM jos_comprofiler  
				WHERE jos_comprofiler.user_id = ". $resident);
		$result = $db->loadResult();
		return $result;
	}


function work_conveyer($building_id,$line,$type,$quantity){

	    $now=time();
	    $db =& JFactory::getDBO();
	    $q="INSERT INTO jos_jigs_factories (building,line,type, quantity,timestamp) VALUES
	     ($building_id,$line, $type,$quantity,$now ) ON DUPLICATE KEY UPDATE type  =  $type , quantity = $quantity , timestamp= $now";
		$db->setQuery($q);
		$result = $db->query();
	    return $result;

}

function work_turbine($building_id,$line,$type,$quantity){

	    $now=time();
	    $db =& JFactory::getDBO();
	    $q="INSERT INTO jos_jigs_generators (building, quantity,timestamp) VALUES
	     ($building_id,$quantity,$now ) ON DUPLICATE KEY UPDATE quantity = $quantity , timestamp= $now";
		$db->setQuery($q);
		$result = $db->query();
	    return $result;


}

function get_flats($building_id){
	    $db =& JFactory::getDBO();
		$query= "SELECT * FROM jos_jigs_flats  WHERE building =" . $building_id;
		$db->setQuery($query);
		$result = $db->loadAssocList();
		
		$i=0;
		
		foreach ($result as $row){
		
		if ($result[$i][timestamp] !=0){
			
			$now=time();
			$leasetime = 1 * 60 * 60 * 24 * 7; // one week
			$result[$i][remaining]	=	( $result[$i][timestamp]  +	$leasetime	 -	$now) / (60*60*24) ;
			$result[$i][remaining_days]		=	intval	(($result[$i][timestamp]	+	$leasetime	 -	$now) / (60*60*24))  ;
			$result[$i][remaining_hours]	=		intval ( ($result[$i][remaining]	-	$result[$i][remaining_days] ) * 24 ) ;
		}
		else{
		
			$result[$i][remaining] 	= 0 ; 
		         
		}
		$i++;
		}
 		return $result;
}

function work_flat(){


		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$flat= JRequest::getvar(flat);
		$building_id= JRequest::getvar(building_id);
		
		$query= "SELECT status,resident  FROM jos_jigs_flats  WHERE building = $building_id AND flat = $flat ";
		
		$db->setQuery($query);
		$result = $db->loadAssoc();		
		$status   = $result[status];
		$resident = $result[resident];

		if ($resident == 0) {

		$query= "SELECT bank FROM jos_jigs_players WHERE iduser = ". $user->id;
		
		$db->setQuery($query);
		$bank = $db->loadResult();

		if ($bank > 1000){		
			$bank = $bank - 1000;
			$resident = $user->id;
			$status = 1; // occupied
		    $now = time();
		    $date = date('jS-m-y :  h:i',$now);
		    $avatar= $this->get_avatar($user->id);
		    $query= "UPDATE jos_jigs_players set bank = $bank WHERE iduser = " . $user->id;
		    $db->setQuery($query);
		    $db->query();
		}
		}
		
		elseif ($resident == $user->id){  

			$resident = 0;
			$now = 0;
			$status = 0 ; //empty
		$avatar= 'gallery/black.gif';
		
		}
		
		else {  

			return false;
		
		
		}	
				
		$x = "INSERT INTO jos_jigs_flats (building,flat, status, resident,timestamp) values ($building_id, $flat, $status, $resident, $now)
		ON DUPLICATE KEY UPDATE status = $status , resident = $resident , timestamp  = $now ;" ;
        $db->setQuery($x);

        if(!$db->query()){ 
        	 	return false ;
       
        }
        
        else {
      	$pre_result = "<img src='" .  $this->baseurl  . "images/comprofiler/" . $avatar . "' height='20px' width='20px' >" ;
 		$result[0]= 'message_' . $flat;
		$result[1]= $this->get_message($resident);
		$result[2]= 'avatar_' . $flat;
		$result[3]= $pre_result ;
        $result[4]= $flat;
		$result[5]= "<img src='" . $this->baseurl . "components/com_battle/images/buttons/flat" . $status  . ".jpg' >" ;
		$result[6]= 'timer_' . $flat;
		$result[7]=  $date;
	 //	return $result;
     //  echo Json_encode ($y);
	return $result;

        }
}


function get_message($resident){
	$player =& JFactory::getUser($resident);
	
	$flatlink="index.php?option=com_battle&view=room";
	$message=null;
  $message_1= "Apartment is vacant Click to Rent";
  $message_2= "Apartment is Owned by " . $player->username;
  $message_3= "Apartment is Owned by you. Click to <a href ='". $flatlink ."'>HERE</a> to Enter "; 	
			$user =& JFactory::getUser();
			
			if ($resident== 0){ 
				$message=$message_1;
			}
				elseif($resident != $user->id){ 
				$message=$message_2;
			}
			else{ 
				$message = $message_3;
			}
	return $message;
	}
	
	
function get_mines($building_id){

	$user =& JFactory::getUser();
//	$result = array() ;
	$now= time();
	$db =& JFactory::getDBO();
	$query="SELECT * FROM jos_jigs_mines WHERE building_id =" . $building_id;
	$db->setQuery($query);
	$result = $db->loadAssoc();	
	
	$payment = 100;

	$type = $result[type];
	$name = $user->id;	
if (($result[timestamp] > 0) && ($now-$result[timestamp] > 50)){
	
	$query="UPDATE jos_jigs_mines SET timestamp = 0 WHERE building_id =" . $building_id;
	$db->setQuery($query);
	$db->query();
	$result[timestamp] = 0;
	
if ($type==1){
	$type_crystal =rand( 1 , 30 ) ;
	$query ="INSERT INTO jos_jigs_crystals (player_id , item_id, quantity )VALUES($name ,$type_crystal, 1)
	 ON DUPLICATE KEY UPDATE quantity = quantity + 1";
	$db->setQuery($query);
	$db->query();
}

if ($type==2){
	$type_metal =rand( 1 , 60 ) ; //30 limit see next line
	
	if ($type_metal >30){
		$type_metal = 1; // this is to increase the chances that carbon will be excavated.
	};
	$query ="INSERT INTO jos_jigs_metals (player_id , item_id, quantity )VALUES( $name ,$type_metal, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1";
	$db->setQuery($query);
	$db->query();
}	
	else{
	$query_1 ="SELECT money FROM jos_jigs_players WHERE iduser = '$user->id'";
	$db->setQuery($query_1);
	$money_saved = $db->loadResult();
	$money= $money_saved + $payment; 	
	$x=	"Update jos_jigs_players SET money = $money WHERE iduser= " . $user->id;
	$db->setQuery($x);
    $db->query();	
	}				

}	
	//exit();
	
$result[now] = date('l jS \of F Y h:i:s A',$now);
$result[since] = date('l jS \of F Y h:i:s A',$result[timestamp]);
$result[elapsed] = (int)(($now-$result[timestamp]));
$result[remaining]=(int)(50-((($now-$result[timestamp]))));

	return $result;

}	
	
function get_factories(){
    $user =& JFactory::getUser();
    $db =& JFactory::getDBO();
	$query ="SELECT *	FROM jos_jigs_blueprints 
	LEFT JOIN jos_jigs_objects ON jos_jigs_blueprints.object = jos_jigs_objects.id 
	WHERE jos_jigs_blueprints.user_id = '$user->id'";
	$db->setQuery($query);
	$result = $db->loadObjectList();

	foreach($result as $blueprint){
	$query ="SELECT name FROM jos_jigs_metal_names 	WHERE jos_jigs_metal_names.id = $blueprint->metal_1 ";
	$db->setQuery($query);
	$blueprint->metal_1_name = $db->loadResult();
	
	$query ="SELECT name FROM jos_jigs_metal_names 	WHERE jos_jigs_metal_names.id = $blueprint->metal_2 ";
	$db->setQuery($query);
	$blueprint->metal_2_name = $db->loadResult();
	
	$query ="SELECT quantity FROM jos_jigs_metals 	WHERE jos_jigs_metals.player_id = $user->id AND jos_jigs_metals.item_id = $blueprint->metal_1 ";
	$db->setQuery($query);
	$blueprint->metal_1_stock = $db->loadResult();

	$query ="SELECT quantity FROM jos_jigs_metals 	WHERE jos_jigs_metals.player_id = $user->id AND jos_jigs_metals.item_id = $blueprint->metal_2 ";
	$db->setQuery($query);
	$blueprint->metal_2_stock = $db->loadResult();
	
	
	}
	
	return $result ;
	
	
}
	
function check_factories($building_id){

	$user =& JFactory::getUser();
	
	$now= time();
	$db =& JFactory::getDBO();
	$query="SELECT * FROM jos_jigs_factories WHERE building =" . $building_id;
	$db->setQuery($query);
	$result = $db->loadAssoc();		
	$type= $result[type];
	$name = $user->id;	
if (($result[timestamp] > 0) && ($now-$result[timestamp] > 50) ){
	
	$query="UPDATE jos_jigs_factories SET timestamp = 0 WHERE building =" . $building_id;
	$db->setQuery($query);
	$db->query();
	$result[timestamp]=0;
	$query ="INSERT INTO jos_jigs_inventory (player_id , item_id )VALUES($name ,$type)";
	$db->setQuery($query);
	$db->query();
}
	return $result[timestamp] ;
	
}	
	
function check_turbines($building_id){

	$user =& JFactory::getUser();
	
	$now= time();
	$db =& JFactory::getDBO();
	$query="SELECT * FROM jos_jigs_generators WHERE building =" . $building_id;
	$db->setQuery($query);
	$result = $db->loadAssoc();		
	$type= $result[type];
	$name = $user->id;	
if (($result[timestamp] > 0) && ($now-$result[timestamp] > 50) ){
	
	$query="UPDATE jos_jigs_generators SET timestamp = 0 WHERE building =" . $building_id;
	$db->setQuery($query);
	$db->query();
	$result[timestamp]=0;
	$query ="INSERT INTO jos_jigs_batteries (user_id , charge_percentage )VALUES($name ,100)";
	$db->setQuery($query);
	$db->query();
}
	return $result[timestamp] ;
	
}




	function get_board_messages($id){
		
		
		
		$db =& JFactory::getDBO();
		$query="SELECT messages FROM jos_jigs_buildings WHERE id =" . $id;
		$db->setQuery($query);
		$string = $db->loadResult();
		$numbers = array();
		$numbers= explode( ',' ,  $string );
		
		
			
		
		foreach ($numbers as $message_id){
			$db =& JFactory::getDBO();
			$query="SELECT string FROM jos_jigs_messages WHERE id =" . $message_id;
			$db->setQuery($query);
			$result[] = $db->loadResult();
					
		}
		
				return $result;
		
	

	}



	
}// end of class