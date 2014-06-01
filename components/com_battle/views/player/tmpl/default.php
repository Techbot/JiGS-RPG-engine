<!--<script type="text/javascript" src="<?php echo $this->baseurl ?>/media/system/js/mootools-core.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/media/system/js/mootools-more_.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/clientcide.2.2.0.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/_class.noobSlide.packed.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.js"></script>
-->
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' );

?>

<?php
/*
echo '<pre>';
 print_r($this);
echo '</pre>'; 
*/ 
  ?>


<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/views/person/tmpl/style.css.php" />

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.css" type="text/css" />

<div id="profile" class="clearfix">

<div class="name"><?php echo $this->player->username ; ?></div>
  
<div class="desc">

<img src="<?php echo $this->baseurl; ?>/images/comprofiler/<?php echo $this->player->avatar ?>" class="thumbnail" alt="<?php $this->player->username ; ?>" title="<?php $this->player->username ; ?>" width="100" height="100" id="character_image" />

<div class="stats">
<table class="stats" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="row">ID</th>
    <td><?php echo $this->player->id ; ?></td>
  </tr>
  <tr>
    <th scope="row">Name</th>
    <td><?php echo $this->player->username ; ?></td>
  </tr>
  <tr>
    <th scope="row">Money</th>
    <td><?php echo $this->player->money ; ?></td>
  </tr>
  <tr>
    <th scope="row">Stuff</th>
    <td></td>
  </tr>
</table>
</div><!-- end stats -->


<p class="desc"><?php echo $this->player->commentaire ; ?></p>
        
</div><!-- end desc -->


<div class="vitals">

<div class="label">Experience:</div>
<div class="gauge"><div class='xp'><span><?php echo $this->player->xp ; ?></span></div></div>
<div class="label">Intelligence:</div>
<div class="gauge"><div class='intel'><span><?php echo $this->player->intelligence ; ?></span></div></div>
<div class="label">Strength:</div>
<div class="gauge"><div class='strength'><span><?php echo $this->player->strength ; ?></span></div></div>
<div class="label">Health:</div>
<div class="gauge"><div class='health'><span><?php echo $this->player->health ; ?></span></div></div>
</div><!-- end vitals -->


</div><!-- end profile -->

<div id="inventory" class="clearfix">
<div class="name">Inventory</div>

<?php
/////foreach ($this->inv as $inv_object)
//{
//echo '<br>' . $inv_object['name'] ;
//}
?>

</div><!-- end inventory -->


<div id="action" class="clearfix">
<!--   <div class="recruit"><a class="recruit" href="#">Recruit</a></div>  -->


<div class="attack"><a onclick="attack_playa(<?php echo $this->player->id ; ?>)" id="attack">Attack</a></div>
 <!--  <div class="kick"><a class="kick" href="#">Kick</a></div>
  <div class="punch"><a class="punch" href="#">Punch</a></div>
  <div class="shoot"><a class="shoot" href="#">Shoot</a></div>
  <div class="bribe"><a class="bribe" href="#">Bribe</a></div>
  <div class="rob"><a class="rob" href="#">Rob</a></div>
  <div class="talk"><a class="talk" href="#">Talk</a></div>-->

  
  </div><!-- end action -->


<script type="text/javascript">
///////////////////////////////////////////////////////////////////////

//Fighting functions

///////////////////////////////////////////
function attack_playa(player_id){
	var d = document.getElementById('attack');

		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=attack_playa&player=" + player_id,
			onSuccess: function(result){
			
			if (result[1] > 0 ) {
				
				alert(result[2] + 'me: ' + result[0] + '   Him: ' + result[1]);
			}
			
			else {
				alert(result[2] + 'me: ' + result[0] + '   Him: ' + result[1]);	
		close();
				jump();
				
				}
				}
			}).get();
		
}

function kick_playa(player_id){
	var d = document.getElementById('attack');

		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=kick_playa&player=" + player_id,
			onSuccess: function(result){
			
			if (result[1] > 0 ) {
				
				alert(result[2] + '  me: ' + result[0] + '   Him: ' + result[1]);
			}
			
			else {
				alert(result[2] + '  me: ' + result[0] + '   Him: ' + result[1]);	
		close();
				jump();
				
				}
				}
			}).get();
		
}

</script>


