 <?php defined( '_JEXEC' ) or die( 'Restricted access' );  ?>
 

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
		
			<?php if($this->cropper->level>=9)
			{ ?>
				<div id="eat_burger" style="visibility:visible;">
				<img style="margin-left:30px;" 
				src="<?php echo $this->baseurl ?>/components/com_battle/images/burger.png" alt="McGuffin Burger" />
				<h4>Increase your health by 10pts with<br />
				a SuperSized  McGuffin Burger</h4>I'm lovin it
				</div>
				
			<?php } else { ?>
			
				<div id="eat_burger" style="visibility:visible;">
				
				<h4>You're only a <?php print_r( $this->cropper->level); ?></h4>
				</div>
			<?php } ?>

			</div>	

			
			<!--div>
			<img class="none"  src="<?php //echo $this->baseurl ?>/images/stories/mcdicks001.jpg" alt="McGuffin Burger" width="640px" />
			</div-->

			<div>
				<img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks002.jpg" alt="McDonald Ad Busters" width="640px" />
				
			</div>

			<div>
				<img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks003.jpg" alt="McDonald Ad Busters" width="640px" />
			</div>

			<div>
			<img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks004.jpg" alt="McDonald Ad Busters" width="640px" />
			</div>

			<div>
			<a href="http://eclecticmeme.com/index.php?option=com_content&id=7%3Achapter-four&catid=2%3A2007&Itemid=13#KingRonald" title="Meet King Ronald III"><img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks005.jpg" alt="McDonald Ad Busters" width="640px" /></a>
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



