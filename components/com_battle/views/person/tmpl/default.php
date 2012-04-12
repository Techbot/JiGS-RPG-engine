
<script type="text/javascript" src="<?php echo $this->baseurl ?>/media/system/js/mootools-core.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/media/system/js/mootools-more_.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/clientcide.2.2.0.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.js"></script>
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' );
?>


<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/views/person/tmpl/style.css.php" />

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.css" type="text/css" />

<div id="profile" class="clearfix">
<div class="name"><?php echo $this->people->name ; ?></div>
<div class="desc">
<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/ennemis/<?php echo $this->people->image;?>" class="thumbnail" alt="<?php $this->people->name ; ?>" title="<?php $this->people->name ; ?>" width="100" height="100" id="character_image" />
<div class="stats">
<table class="stats" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="row">ID</th>
    <td><?php echo $this->people->id ; ?></td>
  </tr>
  <tr>
    <th scope="row">Name</th>
    <td><?php echo $this->people->name ; ?></td>
  </tr>
  <tr>
    <th scope="row">Money</th>
    <td><?php echo $this->people->money ; ?></td>
  </tr>
</table>
</div><!-- end stats -->
<p class="desc"><?php echo $this->people->comment ; ?></p>
</div><!-- end desc -->
<div class="vitals">
<div class="label">Experience:</div>
<div class="gauge"><div class='xp'><span><?php echo $this->people->xp ; ?></span></div></div>
<div class="label">Intelligence:</div>
<div class="gauge"><div class='intel'><span><?php echo $this->people->intelligence ; ?></span></div></div>
<div class="label">Strength:</div>
<div class="gauge"><div class='strength'><span><?php echo $this->people->strength ; ?></span></div></div>
<div class="label">Health:</div>
<div class="gauge"><div class='health'><span><?php echo $this->people->health ; ?></span></div></div>
</div><!-- end vitals -->
</div><!-- end profile -->
<div id="inventory" class="clearfix">
<div class="name">Inventory</div>
<?php
foreach ($this->inv as $inv_object)
{
echo '<br>' . $inv_object[name] ;
}
?>
</div><!-- end inventory -->

<div id="action" class="clearfix">
 <!-- <div class="recruit"><a class="recruit" href="#">Recruit</a></div> --> 
  
  
  
  <div class="shoot"><a onclick="shoot(<?php echo $this->people->id ; ?>)" id="shoot" >Shoot</a></div>
  <div class="kick"><a onclick="kick(<?php echo $this->people->id ; ?>)" id="kick" >Kick</a> </div>
  <div class="punch"><a onclick="punch(<?php echo $this->people->id ; ?>)" id="punch">Punch</a> </div>
<!--   <div class="bribe"><a class="bribe" href="#">Bribe</a></div>
  <div class="rob"><a class="rob" href="#">Rob</a></div>
  <div class="talk"><a class="talk" href="#">Talk</a></div>--> 
</div><!-- end action -->



<script type="text/javascript">

function shoot(character_id){
	var d = document.getElementById('shoot');

		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=attack&type=shoot&character=" + character_id,
			onSuccess: function(result){
			
			if (result[1] > 0 ) {
				
				alert('me: ' + result[0] + '   Him: ' + result[1]);
			}
			
			else {
				alert('me: ' + result[0] + '   Him: ' + result[1]);	
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
			
			if (result[1] > 0 ) {
				
				alert('me: ' + result[0] + '   Him: ' + result[1]);
			}
			
			else {
				alert('me: ' + result[0] + '   Him: ' + result[1]);	
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
			
			if (result[1] > 0 ) {
				
				alert('me: ' + result[0] + '   Him: ' + result[1]);
			}
			
			else {
				alert('me: ' + result[0] + '   Him: ' + result[1]);	
		close();
				jump();
				
				}
				}
			}).get();
		
}


</script>