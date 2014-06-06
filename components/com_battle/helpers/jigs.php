<?php

abstract class JigsHelper 
{

	var $Name;
	public function saveMessage()
	{
 		$user		= JFactory::getUser();
		$message	= "A little kelp from my friends";
		$this->sendFeedback($user->id,$message);
	}
    
	public function sendFeedback($id,$text)
	{
		$db		= JFactory::getDBO();
		$query		= "INSERT INTO #__jigs_logs (user_id, message) VALUES ($id,'$text')";
		$db->setQuery($query) ;
		$db->query();
		return ;
	}       

     	///// TAKE ENERGY FROM USER'S BATTERIES UNTIL $energy_units_required IS REACHED /////
	public function use_battery_new($id, $energy_units_required)
	{
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		$message	= "Energy Required : " . $energy_units_required;

		MessagesHelper::sendFeedback($user->id,$message);

		$batteries	= $this->get_all_energy($id);
		$total		= $this->get_total_energy($id);
		$message	= "Total Energy available : " . $total;
		MessagesHelper::sendFeedback($user->id,$message);

		if ($total < $energy_units_required)
		{
			$message = "not enough energy";
			MessagesHelper::sendFeedback($user->id,$message);
			return false;
		}

		$i=1;		
		foreach ($batteries as $battery)
		{
			if($energy_units_required > 0)
			{
				if ($energy_units_required < $battery->units)
				{
					$db			= JFactory::getDBO();
					$battery->units 	= $battery->units - $energy_units_required;
					$message		= $energy_units_required . " unit(s) deducted from  battery " . $i ;
					$energy_units_required	= 0;
					MessagesHelper::sendFeedback($user->id,$message);
				}
				else
				{
					$energy_units_required	= $energy_units_required - $battery->units;
					$message 		.= $battery->units . " unit(s) deducted from  battery " . $i . "<br/>";
					$battery->units		= 0;
					$message 		.= "zero units remaining in battery " . $i ."</br>";
					MessagesHelper::sendFeedback($user->id,$message);
				}

				$sql	= "UPDATE #__jigs_batteries SET units = " . $battery->units . " WHERE id = " . $battery->id;
				$db->setQuery($sql);
				$result	= $db->query();
			}
			else
			{
				$message= "energy transer complete";
				MessagesHelper::sendFeedback($user->id,$message);
				break;
			}
			$i++;
		}

		$total		= $this->get_total_energy($id);
		$message	= $total . " remaining energy units";
		MessagesHelper::sendFeedback($user->id,$message);
		return true;
	}    
          
        //// ADD UP ALL ENERGY FROM ALL BATTERIES FOR ONE USER /////
	public function get_total_energy($id)
	{
		$batteries	= $this->get_all_energy_new($id);
		$total		= 0;
		foreach ($batteries as $battery)
		{
			$total	= $total + $battery->units;
		}
		return $total;
	}

	///// GET ALL BATTERIES FOR ONE USER /////
	public function get_all_energy_new($id)
	{
		$db		= JFactory::getDBO();
		$sql		= "SELECT * FROM #__jigs_batteries WHERE user = " . $id;
		$db->setQuery($sql);
		$_all_energy	= $db->loadObjectList();
		return $_all_energy;
	}

}
