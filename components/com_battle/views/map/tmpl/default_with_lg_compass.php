<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
// jimport( 'joomla.methods' );

JHTML::_('behavior.modal'); 

$posx = $this->player_pos[0];
$posy = $this->player_pos[1];
 $map = $this->player_pos[2];
$grid = $this->player_pos[3];
$avatar = $this->player_pos[4];
$grid_index = $this->grid;

// echo '<pre>';
// print_r($this->grid);
// echo '</pre>';

//exit();

?>
<script type="text/javascript" >
grid_index = parseInt(<?php echo $grid_index;?>);

</script>
<script type="text/javascript" src="<?php echo $this->baseurl; ?>/components/com_battle/includes/jigs.js"></script>

<style type="text/css">
  #demo { 
  background-color:#fa0000; 
  color:#fff; 
  padding:0px; 
  border:1px solid #000;
  width:48px;
  height:48px;
position:absolute;
 top:<?php echo $posy *50?>px;
 left:<?php echo $posx *50?>px;
z-index:999;
}
.character { 
  background:#fa0000; 
  color:#fff; 
  padding:0px; 
  border:1px solid #000;
  width:48px;
  height:48px;
position:absolute;
z-index:111;

}
 .buildings_class { 
  color:#fff; 
  padding:0px; 
  border:0px solid #000;
  width:37px;
  height:37px;
position:absolute;
z-index:999;
}

 .pages_class { 
  background:#fa0000; 
  color:#fff; 
  padding:0px; 
  border:1px solid #000;
  width:37px;
  height:37px;
position:absolute;

z-index:1;
}

#world a { /*right,left,up,down*/
font-weigth:400;
color:#fff;
text-transform: uppercase;
font-size: 0.85em;
}



</style>


<div id="world" style=
"
margin: 0 auto; 
text-align:center;
position:relative;
width: 500px;">

<div id="north" style="background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/compass_top.png) transparent 50% 0% no-repeat;
width: 516px;height:50px;">
<div id="up" style="background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/up.png) transparent 50% 90% no-repeat;padding-top:12px;height:38px;">  
<a  id="move_demo" onclick="MoveUp(PosX,PosY)" style="margin-bottom:18px;">Up</a>
</div></div>

<div id="map_middle" style="width:500px;background:#555;">

<div id="west" style="width: 50px;height:400px;float:left;margin: 0 auto; background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/compass_left.png) transparent 0% 50% no-repeat;
">

<div id="left_joy" style= "background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/left.png) transparent 90% 50% no-repeat; position:relative; top:188px; text-align:left;" > 
<a  id="move_demo" onclick="MoveLeft(PosX,PosY)">Left</a></div></div>


<div id="screen_grid" style="
width:400px; 
height:400px;
margin: 0 auto; 
text-align:center;
background:#000;
float:left;
position:relative;
left:0px;
top:0px;" 
>

<?php
/************************
 * 
 * 
 * 
 * 
 * 
 * Player
 * 
 * 
 * 
 * 
 * 
 *****************************/
 
// print_r($this->player_pos);

if ($this->player_pos[5]==1){

 ?>

 <div id="demo" style="
 background-size:cover;
 background-position:50% 50%;background-size:cover; background-image:url(<?php echo $this->baseurl; ?>/images/comprofiler/<?php echo $avatar ?>);"></div> 

<?php

}

/***********************
 * 
 * 
 * 
 * 
 * 
 * Characters
 * 
 * 
 * 
 * 
 * 
 *****************************/
foreach ($this->characters as $character){ 
$char=$character->id;
$char_name=$character->name;
$image=$character->image;
$charposx=$character->posx;
$charposy=$character->posy;
?>
<div id="<?php echo $char ?>" 

class="character" style="
 top:<?php echo $charposy *50?>px;
 left:<?php echo $charposx *50?>px;

">
<!--<a href="index.php?option=com_battle&view=person&tmpl=component&id=<?php echo $char?>" class="modal" rel="{handler:'iframe', size: {x: 500, y: 400}}" title="<?php echo $char_name?>" >

<!-- rel="{handler: 'iframe', size: {x: 640, y: 480}}"> -->



<img class="npc" id = "<?php echo $char; ?>" src="<?php echo $this->baseurl; ?>/components/com_battle/images/ennemis/miniatures/<?php echo $image ?>">
<!--
</a>

-->

</div>
<?php
} // end of foreach





/************************
 * 
 * 
 * 
 * 
 * 
 * 
 * Buildings
 * 
 * 
 * 
 * 
 *****************************/


 
 
foreach ($this->buildings as $building){ 
$building_id		= $building->id;
$building_name		= $building->name;
$building_image		= $building->image;
$buildingposx		= $building->posx;
$buildingposy		= $building->posy;
$buildingOwner		= $building->ownername;




if ($building->owner == 0){
 	$buildingOwner = 'Nobody';
 } 






?>
<div id="<?php echo $building_id ?>" 

class="buildings_class" style="
 top:<?php echo $buildingposy *50?>px;
 left:<?php echo $buildingposx *50?>px;

">
<a href="index.php?option=com_battle&view=building&tmpl=component&id=<?php echo $building_id?>" title="<?php echo $buildingOwner ?> owns <?php echo $building_name?>" rel="{handler: 'iframe', size: {x: 640, y: 600}}" class="modal" >
<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/buildings/miniatures/<?php echo $building_image ?>" >
</a>
</div>
<?php
} // end of foreach


/************************
 * 
 * 
 * 
 * 
 * 
 * 
 * Pages
 * 
 * 
 * 
 * 
 *****************************/
  
foreach ($this->pages as $page){ 

?>
<div id="page_<?php echo $page->id ?>" 

class="pages_class" style="
 top:<?php echo $page->posy *50?>px;
 left:<?php echo $page->posx *50?>px;

">

<?php if ($page->type=='url'){

	$link='http://'.$page->details;
	$rel='{handler: "iframe", size: {x: 640, y: 600}}';
	$class='modal';
}
 if ($page->type=='article'){

	$page_article = $page->details;
	$link= 'index.php?option=com_content&view=article&tmpl=component&id=' . $page_article;

	$rel='{handler: "iframe", size: {x: 640, y: 600}}';
	$class='modal';
}
	?>


<a href= '<?php echo $link?>' title='<?php echo $page->name; ?>' rel='<?php echo $rel; ?>' class='<?php echo $class; ?>'>
<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/pages/miniatures/<?php echo $page->image; ?>" >
</a>
</div>
<?php
} // end of foreach

/************************
 * 
 * 
 * 
 * 
 * 
 * 
 * Players
 * 
 * 
 * 
 * 
 *****************************/
foreach ($this->players as $player){ 
$player_id=$player->id;
$p_image=$player->avatar;
$charposx=$player->posx;
$charposy=$player->posy;

 
//$player_username=$player->username;

?>

 
<a class="modal" href ="index.php?option=com_battle&view=player&tmpl=component&id=<?php echo $player_id; ?>" rel='{handler: "iframe", size: {x: 640, y: 600}}' title="<?php echo $player_username ?>">

<div id="char_<?php echo $player_id; ?>" 
class= "character"
style="
 top:<?php echo $charposy *50?>px;
 left:<?php echo $charposx *50?>px;
 width:48px;
 height:48px;
 background-size:cover;
 background-position:50% 50%;
 background-image:url(<?php echo $this->baseurl; ?>/images/comprofiler/<?php echo $player->avatar ?>);
 ">
 </div> 


</a>
<?php
} 
// end of foreach




/************************
 * 
 * 
 * 
 * 
 * 
 * 
 * Grid
 * 
 * 
 * 
 * 
 *****************************/


	for ($y=0;  $y <= 7 ; $y++) {
		$name='row'.$y;
		$arr[$y] = explode(",",($this->row->$name));
		$x = 0;
		foreach ($arr[$y] as $row){
			?>
<div class="squares" style="
background:url(<?php echo $this->baseurl; ?>/components/com_battle/images/map/<?php echo $row ?>.jpg);
display:inline; 
position:absolute; 
width:40px; 
height:40px; 
padding:5px;
margin:0px;
text-align:center;
top:<?php echo ($y*50)+0?>px; 
left: <?php echo $x*50?>px;
"> 
<?php // echo $row ?></div>
<?php	
$x= $x+1;
	}
}
?>
</div> 
<!--  end of grid -->


<div id ="east" style= "width: 50px;
height:400px; float:right ; margin: 0 auto;
background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/compass_right.png) transparent 100% 50% no-repeat;"><div id="right_joy" style= "background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/right.png) transparent 10% 50% no-repeat; position:relative; top:188px; text-align:right;"> 
<a  id="move_demo" onclick="MoveRight(PosX,PosY)" style="margin-left:18px;">Right</a></div></div>
</div> <!-- div middle-->

<div id="south" style="clear:both;
background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/compass_bottom.png) transparent 50% 100% no-repeat;width: 516px;
height:50px;"><div id="down" style="background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/down.png) transparent 50% 10%no-repeat;padding-top:12px;height:38px;">
<a  id="move_demo" onclick="MoveDown(PosX,PosY)" style="margin-top:18px;">Down</a></div>       </div>


</div><!-- div world -->







<script>


$$('.character').addEvent('click', function(){

var itemID = this.get('id');
					





	var a = new Request.JSON({
		
		
		
		
		
		//url: "index.php?option=com_battle&format=raw&tmpl=component&view=person", 
 			 url:"index.php?option=com_battle&format=raw&task=action&action=get_character_view&id="+itemID,
   
   
    onSuccess: function(result){
  	    	
 								
 
								mything = new Element ('div',{'id':"NPC",
            					html:result,
            					'style':'border 1px solid #F00; '});
		
								mything.replaces($('screen_grid'));
		
		}
	}).get();





            					
         });
         </script>   					
            					
            					
