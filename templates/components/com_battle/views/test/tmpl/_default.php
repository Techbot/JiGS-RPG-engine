<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' );


/**
 * CB framework
 * @global CBframework $_CB_framework
 */
global $_CB_framework, $_CB_database, $ueConfig, $mainframe, $_SERVER;
if ( defined( 'JPATH_ADMINISTRATOR' ) ) {
	if ( ! file_exists( JPATH_ADMINISTRATOR . '/components/com_comprofiler/plugin.foundation.php' ) ) {
		echo 'CB not installed';
		return;
	}
	include_once( JPATH_ADMINISTRATOR . '/components/com_comprofiler/plugin.foundation.php' );
} else {
	if ( ! file_exists( $mainframe->getCfg( 'absolute_path' ) . '/administrator/components/com_comprofiler/plugin.foundation.php' ) ) {
		echo 'CB not installed';
		return;
	}
	include_once( $mainframe->getCfg( 'absolute_path' ) . '/administrator/components/com_comprofiler/plugin.foundation.php' );
}
cbimport( 'cb.database' );
cbimport( 'language.front' );

$absolute_path		=	$_CB_framework->getCfg( 'absolute_path' );
$cblogin_live_site	=	$_CB_framework->getCfg( 'live_site' );

$len_live_site		=	strlen($cblogin_live_site);		// do not remove: used further down as well

$isHttps			=	(isset($_SERVER['HTTPS']) && ( !empty( $_SERVER['HTTPS'] ) ) && ($_SERVER['HTTPS'] != 'off') );
$return		=	'http' . ( $isHttps ? 's' : '' ) . '://' . $_SERVER['HTTP_HOST'];
if (!empty ($_SERVER['PHP_SELF']) && ! empty ($_SERVER['REQUEST_URI'])) {
	$return	.=	$_SERVER['REQUEST_URI'];	// Apache
} else {
	$return	.=	$_SERVER['SCRIPT_NAME'];	// IIS
	if (isset($_SERVER['QUERY_STRING']) && ! empty($_SERVER['QUERY_STRING'])) {
		$return	.=	'?' . $_SERVER['QUERY_STRING'];
	}
}
$return	=	preg_replace('/[\\\"\\\'][\\s]*javascript:(.*)[\\\"\\\']/', '""', preg_replace('/eval\((.*)\)/', '', htmlspecialchars( urldecode( $return ) ) ) );

$return = cbUnHtmlspecialchars( $return );

$cbUser		=&	CBuser::getInstance( $_CB_framework->myId() );
$oValue		=	$cbUser->avatarFilePath( $show_avatar );


$posx = $this->player_pos[0];
$posy = $this->player_pos[1];
 $map = $this->player_pos[2];
$grid = $this->player_pos[3];
$grid_index = $this->grid;



include_once ( $mainframe->getCfg( 'absolute_path' ) . '/components/com_battle/includes/JIGS.js.php');


?>
<style type="text/css">
  #demo { 
  background:#fa0000; 
  color:#fff; 
  padding:0px; 
  border:1px solid #000;
  width:37px;
  height:37px;
position:absolute;
 top:<?php echo $posy *50?>px;
 left:<?php echo $posx *50?>px;


z-index:1;

}
  .char { 
  background:#fa0000; 
  color:#fff; 
  padding:0px; 
  border:1px solid #000;
  width:37px;
  height:37px;
position:absolute;

z-index:1;
}


#world a {
	font-weigth:bold;
	color:#fff;
	font-size:120%;
}
</style>
<div id = "world" style=
"
margin: 0 auto; 
text-align:center;
position:relative;
width: 500px;">

<div id="north" style="background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/compass.png) transparent 50% 0% no-repeat;
width: 516px;height:50px;">
<div id="up" style="background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/up.png) transparent 50% 100% no-repeat;padding-top:30px;height:20px;">  
<a href="#" id="move_demo" onclick="MoveUp(PosX,PosY)">Up</a>
</div></div>

<div id="map_middle" style="width:500px;background:#555;">

<div id="west" style="
width: 50px;
height:400px;
float:left;
margin: 0 auto;
background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/compass.png) transparent 0% 50% no-repeat;
"
><div id= "left_joy" style= "background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/left.png) transparent 100% 50% no-repeat; "> 
<a href="#" id="move_demo" onclick="MoveLeft(PosX,PosY)">Left</a></div></div>


<div  id = "grid" style="
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
 <div id="demo" style="
 background:url(<?php  echo  htmlspecialchars( $oValue ) ; ?>)
 ">
  
</div> 
<?php
foreach ($this->characters as $character){ 
$char=$character->id;
$char_name=$character->nom;
$image=$character->image;
$charposx=$character->posx;
$charposy=$character->posy;
?>
<div id="char_<?php echo $char ?>" 

class= "char"

style="
 top:<?php echo $charposy *50?>px;
 left:<?php echo $charposx *50?>px;

">


<a rel="SqueezeBox" href="index.php?option=com_battle&view=person&tmpl=component&id=<?php echo $char?>" title="<?php echo $char_name?>" width="50" class="modal">




<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/ennemis/miniatures/<?php echo $image ?>" >;

</a>


</div>
<?php
} 
// end of foreach


foreach ($this->players as $player){ 
$player_id=$player->iduser;
$p_image=$player->avatar;
$charposx=$player->posx;
$charposy=$player->posy;

?>
<div id="char_<?php echo $player_id; ?>" class= "char"

style="
 top:<?php echo $charposy *50?>px;
 left:<?php echo $charposx *50?>px;

"


>
<img src="<?php echo $this->baseurl; ?>/images/comprofiler/<?php echo $player->avatar ?>"width='50' >
</div>
<?php
} 
// end of foreach
?>
<?php
	for ($y=0;  $y <= 7 ; $y++) {
		$name='row'.$y;
		$arr[$y] = explode(",",($this->row->$name));
		$x = 0;
		foreach ($arr[$y] as $row){
			?>
<script type='text/javascript'>
cell[<?php echo $x ;?>][<?php echo $y ;?>]=<?php echo $row ; ?>;
</script>
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
<?php echo $row ?></div>
<?php	
$x= $x+1;
	}
}
?>
</div> 
<!--  end of grid -->


<div id = "east" style= "width: 50px;
height:400px; float:right ; margin: 0 auto;
background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/compass.png) transparent 100% 50% no-repeat;"><div id="right_joy" style= "background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/right.png) transparent 0% 50% no-repeat; "> 
<a href="#" id="move_demo" onclick="MoveRight(PosX,PosY)">Right</a></div></div>
</div> <!-- div middle-->

<div id="south" style="clear:both;
background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/compass.png) transparent 50% 100% no-repeat;width: 516px;
height:50px;"><div id="down" style="background: url(<?php echo $this->baseurl; ?>/components/com_battle/views/single/tmpl/down.png) transparent 50% 0% no-repeat;  ">
<a href="#" id="move_demo" onclick="MoveDown(PosX,PosY)">Down</a></div>       </div>


</div><!-- div world -->

