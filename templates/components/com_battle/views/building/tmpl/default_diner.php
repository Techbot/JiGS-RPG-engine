 <?php defined( '_JEXEC' ) or die( 'Restricted access' );  ?>
 
<div>

<div class="sample diner">
	<div class="mask3">
		<div id="box4">
		
		
			<div>
		
				 <div id="eat_burger" style="visibility:visible;">
				<img style="margin-left:30px;" 
				src="<?php echo $this->baseurl ?>/components/com_battle/images/burger.png" alt="McGuffin Burger" />
				<h4>Increase your health by 10pts with<br />
				a SuperSized  McGuffin Burger</h4>I'm lovin it
				</div>

			</div>	

			
			<div>
			<img class="none"  src="<?php echo $this->baseurl ?>/images/stories/mcdicks001.jpg" alt="McGuffin Burger" />
			</div>

			<div>
				<img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks002.jpg" alt="McDonald Ad Busters" />
				
			</div>

			<div>
				<img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks003.jpg" alt="McDonald Ad Busters" />
			</div>

			<div>
			<img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks004.jpg" alt="McDonald Ad Busters" />
			</div>

			<div>
			<a href="http://eclecticmeme.com/index.php?option=com_content&id=7%3Achapter-four&catid=2%3A2007&Itemid=13#KingRonald" title="Meet King Ronald III"><img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks005.jpg" alt="McDonald Ad Busters" /></a>
			</div>

			<!--<div>
				<h3>7. Nullam porttitor tortor et sem</h3>
				<img src="<?php echo $this->baseurl ?>/components/com_battle/includes/img7.jpg" alt="Photo" />
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque ac dolor. Aenean consectetuer nibh sed ante pretium egestas. Fusce hendrerit. Duis ultrices tristique diam.</p>
				<p>Quisque aliquet accumsan lectus. Nullam porttitor tortor et sem. Nulla lobortis, leo elementum fringilla mollis, magna neque rhoncus lorem, vitae venenatis tellus felis vitae lacus.</p>
				<p>Nunc ante. Cras sodales. Quisque augue enim, rutrum quis, dignissim quis, convallis molestie, nisi. Praesent at lacus. Aenean tincidunt. In hac habitasse platea dictumst.</p>
			</div>-->


		</div>
	</div>
	<p class="buttons" id="handles4">
		<span>(@ 0)</span>
		<span>(^o^)</span>
		<span>(^._.^)~</span>
		<span>(o_O)</span>
		<span>(^_~)</span>
		<span><( -'.'- )></span>
		<!--<span>7. Sette</span>
		<span>8. Ocho</span>>-->
	</p>
</div>
</div>

<script type="text/javascript">

//SAMPLE 4 (walk to item)
		var nS4 = new noobSlide({
			box: $('box4'),
			items: $$('#box4 div'),
			size: 640,
			handles: $$('#handles4 span'),
			onWalk: function(currentItem,currentHandle){
				// $('info4').set('html',currentItem.getFirst().innerHTML);
				this.handles.removeClass('active');
				currentHandle.addClass('active');
			}
		});

	   	 $('eat_burger').addEvent('click', function(){
		  var itemID = this.get('id');
 		  eat(itemID);
  		 });
  		 
	function eat(itemID){
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=eat",
			onSuccess: function(result){
				if (result=="success"){
						alert("You gained 10 health points which cost you 10 credits");
						$('eat_burger').setStyle('visibility','hidden');
						}
				if (result=="broke"){
						alert("You don't have enough money. Get out of here! Go get a job you waster!");
						$('eat_burger').setStyle('visibility','hidden');
						}
			}
		}).get();
	}
</script>
		