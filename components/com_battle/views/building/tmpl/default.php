<script type="text/javascript" src="<?php echo $this->baseurl ?>/media/system/js/mootools-core.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/media/system/js/mootools-more_.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/clientcide.2.2.0.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/_class.noobSlide.packed.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/g.raphael-min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/g.pie-min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/g.line-min.js"></script>

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/emc23flexiv2.3/css/template.css" type="text/css" /> 
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/emc23flexiv2.3/css/theme.css" type="text/css" />

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/_web.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/style.css" type="text/css" media="screen" />

<!-- 
<link rel="stylesheet" href="< ?php echo $this->baseurl ?>/templates/emc23flexiv2.3/css/jigs.css" type="text/css" /> 
<link rel="stylesheet" href="< ?php echo $this->baseurl ?>/templates/emc23flexiv2.3/css/jigs2.css" type="text/css" />
-->


<!--<style type="text/css">
tr.d0 td {
	background-color: #CC9999; color: black;
}
tr.d1 td {
	background-color: #9999CC; color: black;
}
</style>-->

<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 
if ($this->player->iduser == 0){
	$this->player->username = 'Nobody';
} 
//echo 'test:';
// print_r($this->board_info_1);
// exit();
?>
<div id="building" class="clearfix"><!-- This should replace div#container -->
  <div class="building_left">
    <div id="info" class=" clearfix">
      <div class="name"><?php echo $this->player->username; ?> owns <?php echo $this->buildings->name; ?> 
        <span class="small">[Level 1]</span>
        <span class="red"><a href="#" title="Allocate stats points">-</a></span>
        <span class="small">
          <span class="highlight">3 Stats Pts</span>
          <span class="red"><a href="#" title="Allocate stats points">-</a></span>
        </span>
      </div>
      <div class="desc">
        <img src="components/com_battle/images/buildings/<?php echo $this->buildings->image ; ?>"
		class="thumbnail" alt="<?php echo $this->buildings->name ; ?>" title="<?php echo $this->buildings->name ; ?>"
		width="100" height="100" id="building_image" />
        <p class="desc"><?php echo $this->buildings->comment  ; ?></p>
      </div><!-- end desc -->
      <div class="stats">
        <table class="stats" >
          <tr>
            <th scope="row">ID</th>
            <td><?php echo $this->buildings->id ; ?></td>
          </tr>
          <tr>
            <th scope="row">Protection</th>
            <td><?php echo $this->buildings->protection ; ?></td>
          </tr>
          <tr>
            <th scope="row">Energy</th>
            <td><?php echo $this->buildings->energy  ; ?></td>
          </tr>
          <tr>
            <th scope="row">Type</th>
            <td><?php echo $this->buildings->type  ; ?></td>
          </tr>
          <tr>
            <th scope="row">Owner</th>
            <td><?php echo $this->buildings->owner  ; ?></td>
          </tr>
          <tr>
            <th scope="row">XP</th>
            <td><?php echo $this->buildings->xp  ; ?></td>
          </tr>
          <tr>
            <th scope="row">Sale Price</th>
            <td><?php echo $this->buildings->price  ; ?></td>
          </tr>
          <tr>
            <th scope="row">Timer</th>
            <td><?php echo $this->buildings->timer ; ?></td>
          </tr>
        </table> 
      </div><!-- end stats -->
    </div><!-- end info -->
    <div class="extra clearfix">
      <div class="message_board">
        <?php echo $this->loadTemplate ('board_message'); ?>
      </div>
    </div>
  </div><!--end building_left-->
  <div class="building_right">
    <div id="status">
      <div class="instructions">
        <?php echo $this->loadTemplate ('board_info1'); ?>
      </div>
      <div id="action" class="clearfix">
<?php
//////////////////////////////   No Owner - Buy Only //////////////////////////////////
if ($this->buildings->owner == 0){?>
        <div class="buy" >
          <a href="#" class= "buy" id = "<?php echo $this->buildings->id ; ?>">Buy this <?php echo $this->buildings->type ; ?></a>
        </div> <!--buy-->
<?php }?>
<?php
/////////////////////////////////////// Owned but not Player Owned //////////////////////////
if ($this->buildings->owner != $this->user->id && $this->buildings->owner != 0 ){?>
        <div class= "attack" >
          <a href="#" class= "attack" id = "<?php echo $this->buildings->id ; ?>"> Attack this  <?php echo $this->buildings->type ; ?></a>
        </div><!-- attack-->
<?php } 

///////////////////////////////////// Owned by Player  ////////////////////////// 
if ($this->buildings->owner == $this->user->id){
	// echo $this->loadTemplate ('board_info1'); 
	//  echo $this->loadTemplate ('board_crystals'); 

}
?>
      </div><!-- end action -->
    </div><!-- end status. Is this being used? I mean, really?? -->
  </div><!--end building_right-->
</div><!-- end building -->
<?php
if ($this->buildings->owner == $this->user->id || $this->buildings->public == 1 ){
	echo $this->loadTemplate ($this->buildings->type);
}
?>
<script type='text/javascript'>
buy_building();
function buy_building() {
	$$('.buy').addEvent('click', function(){
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=buy_building&building_id=<?php echo $this->buildings->id ; ?>", 
				onSuccess: function(result){
					$('<?php echo $this->buildings->id ; ?>').setStyle('visibility','hidden');
				}
		}).get();
	});
}
/*
function buy1(itemID){
	var a = new Request.JSON({
		url: 'index.php?option=com_battle&format=raw&task=action&action=buy&building_id=<?php echo $this->buildings->id ; ?> &item=' + itemID,
		onSuccess: function(result){
		}
	}).get();
}
function sell1(itemID){
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=sell&building_id=<?php echo $this->buildings->id ; ?>&item=" + itemID, 
     
		onSuccess: function(result){
		}
	}).get();
}
*/
</script>
