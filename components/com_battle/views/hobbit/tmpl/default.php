<?php

//print_r ($this->people);
?>

	<div class="name"><?php echo $this->people->name ; ?></div>
	<div class="desc">
		
		<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/hobbits/thumbnails/<?php echo $this->people->image;?>" class="thumbnail" alt="<?php $this->people->name ; ?>" title="<?php $this->people->name ; ?>" width="100" height="100" id="character_image" />
	
		<div class="stats">
		<table class="stats" >
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
  <tr>		
    <th scope="row">XP</th>
    <td><?php echo $this->people->xp ; ?></td>
  </tr>
  <tr>		
    <th scope="row">Intel</th>
    <td><?php echo $this->people->intelligence ; ?></td>
  </tr>
  <tr>		
    <th scope="row">Strength</th>
    <td><?php echo $this->people->strength ; ?></td>
  </tr>
</table>
</div><!-- end stats -->

<p class="desc"><?php echo $this->people->comment ; ?></p>
</div><!-- end desc -->
<div class="vitals">
<!--
<div class="label">Experience:</div>
<div class="gauge"><div class='xp'><span><?php echo $this->people->xp ; ?></span></div></div>
<div class="label">Intelligence:</div>
<div class="gauge"><div class='intel'><span><?php echo $this->people->intelligence ; ?></span></div></div>
<div class="label">Strength:</div>
<div class="gauge"><div class='strength'><span><?php echo $this->people->strength ; ?></span></div></div>-->
<div class="label">Health:</div>
<div class="gauge"><div class='health'><span><?php// echo $this->people->health ; ?></span></div></div>
</div><!-- end vitals -->
<!--/div><!-- end profile -->

<!--

<div id="_inventory" class="clearfix">
<div class="name">Inventory</div>
<?php
foreach ($this->inv as $inv_object)
{
	echo '<br>' . $inv_object['name'] ;
}
?>-->




