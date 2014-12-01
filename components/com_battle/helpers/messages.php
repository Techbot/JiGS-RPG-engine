<?php



abstract class MessagesHelper 
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
		return;
	}       
      
}
