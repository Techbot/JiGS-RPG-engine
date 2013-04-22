<?php
	$user =& JFactory::getUser();	
?>
<form action= 'index.php' id = 'adminform'>
<?php
echo " <p> " . $user->username .  " <p> ";
echo " <pre>";
echo "=======================================================================<br />";
echo "=                             Top Secret                             ==<br />";
echo "=======================================================================<br />";
echo "= Are you ready to discover the true secrets of the illuminati       ==<br />";
echo "= Are you ready to beat the CIA secret codes                         ==<br />";
echo "= Are you brave enough to confront the secret order of the           ==<br />";
echo "= knitting needle grannies                                           ==<br />";
echo "= A re you clever enough to find the SECRET OF TIM THER NINJA        ==<br />";
echo "=                                                                    ==<br />";
echo "=  Help me ooobi doobi your my only hope                             ==<br />";
echo "=======================================================================<br />";
echo "</pre>";
 ?>
  <div class=""><a onclick="shoot(<?php echo $this->people->id ; ?>)" id="shoot" >List</a>LIST ALL FILES </div> 
  <div class=""><a onclick="kick(<?php echo $this->people->id ; ?>)" id="kick" >Erase</a> Erase Batabanks</div> 
  <div class=""><a onclick="punch(<?php echo $this->people->id ; ?>)" id="punch">Transfer</a> Transfer Funds</div>
<script type="text/javascript">       

 function shoot(character_id){
	var d = document.getElementById('shoot');

		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=attack&type=shoot&character=" + character_id,
			onSuccess: function(result){

				alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);

				if (result[0].health <= 0 )  {
					close();
					jump();			
					}
				if (result[1].health <= 0 ) {
					close();
					jump();
					}		
				}
			}).get();
	}

function kick(character_id){
	var d = document.getElementById('kick');
	
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=attack&type=kick&character=" + character_id,
			onSuccess: function(result){
			
				alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);

				if (result[0].health <= 0 )  {
					close();
					jump();			
					}
				if (result[1].health <= 0 ) {
					close();
					jump();
					}		
				}
			}).get();
		
}

function punch(character_id){
	var d = document.getElementById('punch');
	
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=attack&type=punch&character=" + character_id,
			onSuccess: function(result){
			
				alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);

				if (result[0].health <= 0 )  {
					close();
					jump();			
					}
				if (result[1].health <= 0 ) {
					close();
					jump();
					}		
				}
			}).get();
		
}


</script>