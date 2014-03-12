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

<div id="world">




<div class="compass">
<a id="move_demo" class="up" title="Move North" onclick="MoveUp(PosX,PosY)"></a>
<a id="move_demo" class="left" title="Move West" onclick="MoveLeft(PosX,PosY)"></a>
<a class="mid" href="index.php?option=com_battle&view=single&Itemid=115"></a>
<a id="move_demo" class="right" title="Move East" onclick="MoveRight(PosX,PosY)"></a>
<br style="clear:both;" />
<a id="move_demo" class="down" title="Move South" onclick="MoveDown(PosX,PosY)"></a> 
<br style="clear:both;" />
</div>





<div id="screen_grid">

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
 
//print_r($this->player_pos);

//if ($this->player_pos[5]==1){

 ?>

 <div id="demo" style="
 
  top:<?php echo $posy * 50 ?>px;
 left:<?php echo $posx * 50 ?>px;

 
 background-image:url(<?php echo $this->baseurl; ?>/images/comprofiler/<?php echo $avatar ?>);"></div> 

<?php

//}

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

    $char       = $character->id;
    $char_name  = $character->name;
    $image      = $character->avatar;
    $charposx   = $character->posx;
    $charposy   = $character->posy;
?>
<div id="<?php echo $char ?>" 

class="character" style="
 top:<?php echo $charposy *50?>px;
 left:<?php echo $charposx *50?>px;

">
<!--<a href="index.php?option=com_battle&view=person&tmpl=component&id=<?php echo $char?>" class="modal" rel="{handler:'iframe', size: {x: 500, y: 400}}" title="<?php echo $char_name?>" >

<!-- rel="{handler: 'iframe', size: {x: 640, y: 480}}"> -->



<img class="npc" id = "<?php echo $char; ?>" title="<?php echo $char_name?>"  src="<?php echo $this->baseurl; ?>/components/com_battle/images/ennemis/miniatures/<?php echo $image ?>">
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
<!--a href="index.php?option=com_battle&view=building&tmpl=component&id=<?php echo $building_id?>" title="<?php echo $buildingOwner ?> owns <?php echo $building_name?>" rel="{handler: 'iframe', size: {x: 640, y: 600}}" class="modal" -->

<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/buildings/miniatures/<?php echo $building_image ?>" title="<?php echo $buildingOwner ?> owns <?php echo $building_name?>" >
<!--/a-->
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

	$link   = 'http://'.$page->details;
	$rel    = '{handler: "iframe", size: {x: 640, y: 600}}';
	$class  = 'modal';
	
}
 if ($page->type=='article'){

	$page_article = $page->details;
	$link= 'index.php?option=com_content&view=article&tmpl=component&id=' . $page_article;

	$rel='{handler: "iframe", size: {x: 640, y: 600}}';
	$class='modal';
}

if ($page->type=='canvas'){

	$canvas_number  = $page->details;
	$link           = 'index.php?option=com_battle&view=canvas&id=' . $canvas_number;
	$class          = "page_class";
  }
	?>
<!--a href= '<?php echo $link?>' title='<?php echo $page->name; ?>' rel='<?php echo $rel; ?>' class='<?php echo $class; ?>'-->
<img src='<?php echo $this->baseurl; ?>/components/com_battle/images/pages/miniatures/<?php echo $page->image; ?>' id = '<?php echo $canvas_number ?>'class='<?php echo $class; ?>' >
<!--/a-->
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

    $player_username	= $player->name;
    $player_id			= $player->id;
    $p_image			= $player->avatar;
    $charposx			= $player->posx;
    $charposy			= $player->posy;

     
//$player_username=$player->username;

?>

 <!--
<a class="modal" href ="index.php?option=com_battle&view=player&tmpl=component&iduser=<?php echo $player_id; ?>" rel='{handler: "iframe", size: {x: 640, y: 600}}' title="<?php echo $player_username ?>"> -->

<div id = "char_<?php echo $player_id; ?>" 
title = "<?php echo $player_username ?>"
class = "players" 
style = "
top:<?php echo $charposy *50?>px;
left:<?php echo $charposx *50?>px;
background-image:url(<?php echo $this->baseurl; ?>/images/comprofiler/<?php echo $player->avatar ?>);
 ">
 </div> 

<!--
</a> -->
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
		$name       ='row'.$y;
		$arr[$y]    = explode(",",($this->row->$name));
		$x          = 0;
		foreach ($arr[$y] as $row){
			?>
<div class="squares" style="
	background:url(<?php echo $this->baseurl; ?>/components/com_battle/images/map/<?php echo $row ?>.jpg);
	top:<?php echo ($y * 50)+0 ?>px; 
	left: <?php echo $x * 50 ?>px;
	"> 
	<?php // echo $row ?></div>
	<?php
$x= $x+1;
	}
}
?>
</div> 
<!--  end of grid -->

</div><!-- div world -->

<script type="text/javascript">
	$$('.buildings_class').addEvent('click', function(){
		var itemID = this.get('id');
		var a = new Request.JSON({
			url:"index.php?option=com_battle&format=json&view=building&id="+itemID,
			onSuccess: function(result)
			{
				mything = new Element ('div',{'id':"building",html:result,'style':'border 1px solid #F00; '});			
 			    document.getElementById('loadarea_0').src= '/components/com_battle/includes/building.js';
				mything.replaces(document.id('world'));
			}
		}).get();
	});
	
		
	$$('.page_class').addEvent('click', function(){
		var itemID = this.get('id');
		var a = new Request.JSON({
			url:"index.php?option=com_battle&format=json&view=canvas&id="+itemID,
			onSuccess: function(result)
			{
				alert(itemID);
				
				mything = new Element ('div',{'id':"container",html:result,'style':'border 1px solid #F00; '});	
		 			 
				 document.getElementById('loadarea_0').src= '/components/com_battle/includes/raphael-min.js';
				  document.getElementById('loadarea_1').src= '/components/com_battle/includes/canvas_' + itemID + '.js';
				
				mything.replaces($('world'));
			}
		}).get();
	});

	
	$$('.character').addEvent('click', function(){
		var itemID = this.get('id');
		var a = new Request.JSON({
			url:"index.php?option=com_battle&format=json&view=character&id="+itemID,
			onSuccess: function(result){
				mything = new Element ('div',{'id':"NPC",
				html:result,
				'style':'border 1px solid #F00; '});
				mything.replaces(document.id('screen_grid'));
				var head = document.getElementsByTagName('head')[0] ;
				var script = document.createElement('script');
				script.type = "text/javascript";
				script.src = '<?php echo $this->baseurl; ?>/components/com_battle/includes/character.js';  
				head.appendChild(script);
			}
		}).get();
	});

	$$('.players').addEvent('click', function(){
		var itemID = this.get('id');
		var a = new Request.JSON({
			//url: "index.php?option=com_battle&format=raw&tmpl=component&view=person", 
			url:"index.php?option=com_battle&format=json&view=player&id="+itemID,
			onSuccess: function(result){
				mything = new Element ('div',{'id':"PLAYERS",
				html:result,
				'style':'border 1px solid #F00; '});
				mything.replaces(document.id('screen_grid'));
				var head = document.getElementsByTagName('head')[0];
				script = document.createElement('script');
				script.type = "text/javascript";
				script.src = '<?php echo $this->baseurl; ?>/components/com_battle/includes/players.js';  
				head.appendChild(script);
			}
		}).get();
	});
	
</script>	
	
