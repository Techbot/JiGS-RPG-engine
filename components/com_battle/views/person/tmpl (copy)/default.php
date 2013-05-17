<script src="https://raw.github.com/DmitryBaranovskiy/raphael/master/raphael-min.js"></script>
<div id="profile" class="clearfix">
<div class="name"><?php echo $this->people->name ; ?></div>
<div class="desc">
<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/ennemis/<?php echo $this->people->image;?>" class="thumbnail" alt="<?php $this->people->name ; ?>" title="<?php $this->people->name ; ?>" width="100" height="100" id="character_image" />
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
</table>
</div><!-- end stats -->

<p class="desc"><?php echo $this->people->comment ; ?></p>
</div><!-- end desc -->
<div class="vitals">
<div class="label">Experience:</div>
<div class="gauge"><div class='xp'><span><?php echo $this->people->xp ; ?></span></div></div>
<div class="label">Intelligence:</div>
<div class="gauge"><div class='intel'><span><?php echo $this->people->intelligence ; ?></span></div></div>
<div class="label">Strength:</div>
<div class="gauge"><div class='strength'><span><?php echo $this->people->strength ; ?></span></div></div>
<div class="label">Health:</div>
<div class="gauge"><div class='health'><span><?php echo $this->people->health ; ?></span></div></div>
</div><!-- end vitals -->
</div><!-- end profile -->




<div id="_inventory" class="clearfix">
<div class="name">Inventory</div>
<?php
foreach ($this->inv as $inv_object)
{
echo '<br>' . $inv_object['name'] ;
}
?>
</div><!-- end inventory -->








<div id="action" class="clearfix">
<!-- <div class="recruit"><a class="recruit" href="#">Recruit</a></div> --> 
<div class="shoot"><a onclick="shoot(<?php echo $this->people->id ; ?>)" id="shoot" >Shoot</a></div>
<div class="kick"><a onclick="kick(<?php echo $this->people->id ; ?>)" id="kick" >Kick</a> </div>
<div class="punch"><a onclick="punch(<?php echo $this->people->id ; ?>)" id="punch">Punch</a> </div>
<!--   <div class="bribe"><a class="bribe" href="#">Bribe</a></div>
<div class="rob"><a class="rob" href="#">Rob</a></div>
<div class="talk"><a class="talk" href="#">Talk</a></div>--> 
</div><!-- end action --><!--
<div id="diagram">xxxxxxxxxxxxxxx</div>  -->

<script type="text/javascript">       

var npc_health = 0;

function shoot(character_id){
	var d = document.getElementById('shoot');
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=attack&type=shoot&character=" + character_id,
			onSuccess: function(result){
			//	alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);
				if (result[0].health <= 0 )  {
					close();
					jump();			
					}
				if (result[1].health <= 0 ) {
					close();
					jump();
					}		
				}
			}).get();
	}

function kick(character_id){
	var d = document.getElementById('kick');
	
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=attack&type=kick&character=" + character_id,
			onSuccess: function(result){
			
			//	alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);

				if (result[0].health <= 0 )  {
					close();
					jump();			
					}
				if (result[1].health <= 0 ) {
					close();
					jump();
					}		
				}
			}).get();
		
}

function punch(character_id){
    
	var d = document.getElementById('punch');
	var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=attack&type=punch&character=" + character_id,
			onSuccess: function(result){
			
			//	 alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);
				 
				 npc_health = result[1].health;
				  alert(npc_health);
// replace using jquery/mootools result[1].health
//var value = result[1].health;
//$('#health').set(value); // returns the myInput element's value.
// Element.attr
				if (result[0].health <= 0 )  {
					close();
					jump();			
					}
				if (result[1].health <= 0 ) {
					close();
					jump();
					}		
				}
			}).get();
}
 function do_stuff(){
      //  var paper = Raphael('diagram', 60, 60), rad = 43, defaultText = 'Stats', speed = 250;
      var paper = Raphael('diagram', 20, 20);


paper.circle(30, 30, npc_health).attr({ stroke: 'none', fill: '#193340' });
//var circle = paper.circle(50, 40, 10);
 //  circle.attr("fill", "#f00");
 //  circle.attr("stroke", "#fff");
}
   
//var circle2 = paper.circle(50, 40, 10);
//   circle.attr("fill", "#f00");
//   circle.attr("stroke", "#fff");
//}
   do_stuff();
</script>
