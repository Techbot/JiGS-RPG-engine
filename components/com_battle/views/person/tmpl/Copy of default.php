 <!--
<script type="text/javascript" src="/JIGS/plugins/system/mtupgrade/mootools.js"></script>
 <script type="text/javascript" src="clientcide.2.2.0.js"></script> 
 -->


<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' );



?>
<?php 

// include_once ( $mainframe->getCfg( 'absolute_path' ) . '/components/com_battle/includes/JIGS.js.php');

?>

<?php 
include_once ( $mainframe->getCfg( 'absolute_path' ) . '/components/com_battle/views/person/tmpl/style.css.php');



?>


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
<td><div class="gauge">
<div id='xp'><span><?php echo $this->people->xp ; ?></span></div>
</div>
</td>
</tr>

<tr>
<td class="label">Name:</td>
<td><?php echo $this->people->name ; ?></td>
<td class="label">Intelligence:</td>
<td><div class="gauge">
<div id='intel'><span><?php echo $this->people->intelligence ; ?></span></div>
</div>
</td>
</tr>

<tr>


<tr>
<td class="label">Money:</td>
<td><?php echo $this->people->money ; ?></td>
<td class="label">Strength:</td>
<td>
<div class="gauge">
<div id='strength'><span><?php echo $this->people->strenght ; ?></span></div>
</div>
</td>
</tr>

<tr>
<td class="label">Stuff:</td>
<td><?php echo $this->people->comment ; ?></td>
<td class="label">Health:</td>
<td><div class="gauge">
<div id='health'><span><?php echo $this->people->health ; ?></span></div>
</div>


</td>
</tr>

</table >




<p></p><p></p><p></p>


</div><!-- end stats -->



<div id = 'character_inventory_table' style="color:#333; ">
Inventory
<?php

foreach ($this->inv as $inv_object)

{

echo '<br>' . $inv_object[name] ;
 
}
 
  ?>





</div>
<p style="text-align:center;"> Recruit
<a href="#" id="attack" onclick= "attack(<?php echo $this->people->id ; ?>)">Attack</a>
Kick Punch Stab Shoot Bribe Rob Talk</p>
