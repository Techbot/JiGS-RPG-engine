<?php defined( '_JEXEC' ) or die( 'Restricted access' );
$now= time();
?>
<?php // echo $this->buildings->type ; ?>
<div id = "mine_noob" class="sample">
	<div class="mask3">
		<div id="box4">
			<div>
<div id = 'conveyor_progress' style='visibility:hidden;'>Construction Process in Progress</div>				
			<h3>Mine For:</h3>
<?php
// print_r ($x);
echo $this->loadTemplate ('mine_drill'); 
?> 	
			</div>
			<div>
					<h3>Conveyor 2</h3>
				<img src="<?php echo $this->baseurl ?>/components/com_battle/includes/img2.jpg" alt="Photo" />
					<p>These conveyors will be enbled as the player's experience and wealth increase.</p>
			</div>
			<div>
				<h3>Conveyor 3</h3>
				<img src="<?php echo $this->baseurl ?>/components/com_battle/includes/img3.jpg" alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and wealth increase.</p>
			</div>
			<div>
				<h3>Conveyor 4</h3>
				<img src="<?php echo $this->baseurl ?>/components/com_battle/includes/img4.jpg" alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and wealth increase.</p>
			</div>
			<div>
				<h3>Conveyor 5</h3>
				<img src="<?php echo $this->baseurl ?>/components/com_battle/includes/img5.jpg" alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and wealth increase.</p>
			</div>
			<div>
				<h3>Conveyor 6</h3>
				<img src="<?php echo $this->baseurl ?>/components/com_battle/includes/img6.jpg" alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and wealth increase.</p>
			</div>
			<div>
				<h3>Conveyor 7</h3>
				<img src="<?php echo $this->baseurl ?>/components/com_battle/includes/img7.jpg" alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and wealth increase.</p>
			</div>
			<div>
				<h3>Conveyor 8</h3>
				<img src="<?php echo $this->baseurl ?>/components/com_battle/includes/img8.jpg" alt="Photo" />
				<p>These conveyors will be enbled as the player's experience and wealth increase.</p>
			</div>
		</div>
	</div>
	<p class="buttons" id="handles4">
		<span title="Conveyor 1">C 1</span>
		<span title="Conveyor 2">C 2</span>
		<span title="Conveyor 3">C 3</span>
		<span title="Conveyor 4">C 4</span>
		<span title="Conveyor 5">C 5</span>
		<span title="Conveyor 6">C 6</span>
		<span title="Conveyor 7">C 7</span>
		<span title="Conveyor 8">C 8</span>
	</p>
</div>
<script type='text/javascript'>
function dig_time()
{
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=check_mine&building_id=<?php echo $this->buildings->id ; ?>", 
			onSuccess: function(result){
				document.getElementById('since').innerHTML = result['since'];
				document.getElementById('now').innerHTML = result['now'];
				document.getElementById('elapsed').innerHTML = result['elapsed'];
				document.getElementById('remaining').innerHTML = result['remaining'];        
				if(result['timestamp']==0){
					$$('#mine_board').setStyle('visibility','visible');
					$$('#mine_progress').setStyle('visibility','hidden');
				}
			}
	}).get();
}

var nS4 = new noobSlide({
	box: $('box4'),
	items: $$('#box4 div'),
	size: 640,
	handles: $$('#handles4 span'),
	onWalk: function(currentItem,currentHandle){
		//	$('info4').set('html',currentItem.getFirst().innerHTML);
		this.handles.removeClass('active');
		currentHandle.addClass('active');
	}
});

function mine()
{
	$$('.mine').addEvent('click', function(){
		var type = this.get('type');
		dig(type);
	});
}	

function dig(type)
{
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=mine&building_id=<?php echo $this->buildings->id ; ?>&type=" + type, 
			onSuccess: function(result){
				$$('#mine_board').setStyle('visibility','hidden');
				$$('#mine_progress').setStyle('visibility','visible');  	    
			}
	}).get();
}
mine();
dig_time();
dig_time.periodical(2000);
</script>
