 <script type="text/javascript" src="/plugins/system/mtupgrade/mootools.js"></script>

<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' );


header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

 include_once ( $mainframe->getCfg( 'absolute_path' ) . '/components/com_battle/includes/JIGS.js.php');

?>
<script type='text/javascript'>
function attack(character_id){
	var d = document.getElementById('attack');
	d.onclick = function() {
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=attack&character=" + character_id,
			onSuccess: function(result){
			
			if (result[1] > 0) {
				
				alert('me: ' + result[0] + '   Him: ' + result[1]);
				
			}
			else {
				
			
				alert('me: ' + result[0] + '   Him: ' + result[1]);	
				jump();
				
				}
				
				
				
				}
			}).get();
		}
}	

</script>


<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/views/person/tmpl/style.css" type="text/css" />


<div id="stats">

<table width='100%'>

<colgroup width="15%">
<colgroup width="35%">
<colgroup width="15%">
<colgroup width="35%">
<tr>
<td ><img src="<?php echo $this->baseurl; ?>/components/com_battle/images/ennemis/<?php echo $this->people->image ; ?>"/></td>
</tr>
<tr>
<td class="label">Id:</td>
<td><?php echo $this->people->id ; ?></td>
<td class="label">Experience:</td>
<td><div class="gage">
<div id='xp'><?php echo $this->people->xp ; ?></div>
</div></td>
</tr>

<tr>
<td class="label">Name:</td>
<td><?php echo $this->people->name ; ?></td>
<td class="label">Intelligence:</td>
<td><div class="gage">
<div id='intel'><?php echo $this->people->intelligence ; ?></div>
</div>
</td>
</tr>

<tr>


<tr>
<td class="label">Money:</td>
<td><?php echo $this->people->money ; ?></td>
<td class="label">Strength:</td>
<td>
<div class="gage">
<div id='strength'><?php echo $this->people->strenght ; ?></div>
</div>
</td>
</tr>

<tr>
<td class="label">Stuff:</td>
<td><?php echo $this->people->comment ; ?></td>
<td class="label">Health:</td>
<td><div class="gage">
<div id='health'><?php echo $this->people->health ; ?></div>
</div></td>
</tr>

</table >




<p></p><p></p><p></p>
<p style="text-align:center;">Attempt to Recruit</p>
<p style="text-align:center;"><a href="#" id="attack" onclick= "attack(<?php echo $this->people->id ; ?>)">Attack</a></p>


</div><!-- end stats -->
Inventory


<div id = 'character_inventory_table'>

<?php

foreach ($this->inv as $inv_object)

{

echo '<br>' . $inv_object[name] ;
 
}
 
  ?>





</div>

