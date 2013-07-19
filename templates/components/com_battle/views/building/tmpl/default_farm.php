<?php defined( '_JEXEC' ) or die( 'Restricted access' );
  $now=time();
?>
<div>
	<div class="sample diner">
		<div class="mask3">
			<div id="box4">
			


				<?php
					for ($land = 1 ; $land <= 8 ;$land++){
	
					$status = $this->fields->status_field[$land];

				?>
					<div>
 						<div style = "visibility: visible;">Field <?php echo $land ?> :
 						</div>
	
						<div id = "<?php echo $land ?>" class="work_field" style="visibility:visible;text-align:center;">
						<a href="#"   class = "field" ><img src="/components/com_battle/images/<?php  echo $status; ?>.gif"></a>
						</div>

							 Status: Field is Barren. Click to begin Tilling.					
					
							<div id='farm_progress' style='visibility: hidden;'>
					<label title="when manufactoring began">Started: </label><span id="since"></span>
					<label>Current Time: </label><span id="now"><?php echo date('l jS \of F Y h:i:s A',$now) ; ?></span>
					
					<div id="time_elapsed" class='wrapper sec'>
					<label title="since manufactoring began">Time Elapsed: </label> <span id="elapsed"> </span> secs
					</div>
					<div id="time_remaining" class='wrapper sec'>
					<label title="until manufactoring is complete">Time Remaining: </label>
					<span id="remaining"> </span>secs
					</div>
					</div>
					<!-- end of conveyor_progress -->
					
 
						<div class='clear'>
						</div>
					</div>
					
				
					
	 <?php		
 }
?>

	</div>
</div>
	<p class="buttons" id="handles4">
		<span>(@ 0)</span>
		<span>(^o^)</span>
		<span>(^._.^)~</span>
		<span>(o_O)</span>
		<span>(^_~)</span>
		<span>< ( -'.'- ) ></span>
		<!--<span>7. Sette</span>
		<span>8. Ocho</span>>-->
	</p>
</div>
	<script type="text/javascript">

//SAMPLE 4 (walk to item)
		var nS4 = new noobSlide({
			box: $('box4'),
			items: $$('#box4 div'),
			size: 640,
			handles: $$('#handles4 span'),
			onWalk: function(currentItem,currentHandle){
				$('info4').set('html',currentItem.getFirst().innerHTML);
				this.handles.removeClass('active');
				currentHandle.addClass('active');
			}
		});
			</script>
				
			
			

 </div>

<script type='text/javascript'>

	
function test(){
		var itemID = this.get('id');
		work(itemID);
		
		}



	
function work_field() {
	$$('.work_field').addEvent('click',test );
    }	

    function work(itemID){	 	
    var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=work_field&building_id=<?php echo $this->buildings->id ?>&crop=1&field=" + itemID  ,
    onSuccess: function(result){
   
    	//new tmp element that contains the new div
    	var tmpDiv = new Element('div',{html:'<div id="'+itemID+'"><img src ="components/com_battle/images/jigs_loader.gif" /></div>'});

    	//new div (first child of my tmp div) replaces the old 'myDiv' (that can be grabbed from the DOM by $)
    	tmpDiv.getFirst().replaces($(itemID));
   
		$('farm_progress').setStyle('visibility','visible');
	    
    	}
    }).get();}

    function check_farm(){
		var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=check_farm&field=1&building=<?php echo $this->buildings->id ; ?>" , 
	    onSuccess: function(result){
 
		    document.getElementById('since').innerHTML = result['since'];
		    document.getElementById('now').innerHTML = result['now'];
		    document.getElementById('elapsed').innerHTML = result['elapsed'];
		    document.getElementById('remaining').innerHTML = result['remaining'];
			itemID = result['field'];
			status = result['status'];
	        if (result['remaining'] <= 0 ){
		       // $('adminForm').setStyle('visibility','visible');
			    $('farm_progress').setStyle('visibility','hidden');
				var tmpDiv = new Element('div',{html:'<div id="'+itemID+'" class ="work_field"><img src ="components/com_battle/images/'+result['status'] +'.gif" /></div>'});
				//new div (first child of my tmp div) replaces the old 'myDiv' (that can be grabbed from the DOM by $)
				tmpDiv.getFirst().replaces($(itemID));
				$$('.work_field').removeEvent('click', test);
				work_field();
			    }
		    }
	    }).get();
	    }
 work_field();
 var timer = check_farm.periodical(5000);
 </script>
 
