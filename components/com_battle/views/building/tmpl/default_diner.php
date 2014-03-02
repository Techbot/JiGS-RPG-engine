 <?php defined( '_JEXEC' ) or die( 'Restricted access' );  ?>
 

<div id="slider-id" class="liquid-slider">

		
			<div>
				<h2 class="title">(@ 0)</h2>
				<div id="eat_burger" style="visibility:visible;">
				<img style="margin:10px 0 0 30px;" 
				src="<?php echo $this->baseurl ?>/components/com_battle/images/burger.png" alt="McGuffin Burger" />
				<h4 style="margin:10px 0 0 30px;">Increase your health by 10pts with<br />
				a SuperSized  McGuffin Burger</h4>
				<p style="margin:10px 0 0 30px;">I'm lovin it</p>
				</div>

			</div>	
			
			
			<div>
		
			<?php if($this->cropper->level>=9)
			{ ?>
				<div id="eat_burger" style="visibility:visible;">
				<img style="margin:10px 0 0 30px;" 
				src="<?php echo $this->baseurl ?>/components/com_battle/images/burger.png" alt="McGuffin Burger" />
				<h4 style="margin:10px 0 0 30px;">Increase your health by 10pts with<br />
				a SuperSized McGuffin Burger</h4>
				<p style="margin:10px 0 0 30px;">I'm lovin it</p>
				</div>
				
			<?php } else { ?>
			
				<div id="eat_burger" style="visibility:visible;">
				
				<h4 style="margin:10px 0 0 30px;">You're only a <?php print_r( $this->cropper->level); ?></h4>
				</div>
			<?php } ?>

			</div>	

			
			<!--div>
			<img class="none"  src="<?php //echo $this->baseurl ?>/images/stories/mcdicks001.jpg" alt="McGuffin Burger" width="640px" />
			</div-->

			<div>
				<h2 class="title">(o_O)</h2>
				<img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks002.jpg" alt="McDonald Ad Busters"/>
				
			</div>

			<div>
				<h2 class="title">(^._.^)~</h2>
				<img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks003.jpg" alt="McDonald Ad Busters"/>
			</div>

			<div>
				<h2 class="title"><( -'.'- )></h2>
			<img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks004.jpg" alt="McDonald Ad Busters"/>
			</div>

			<div>
				<h2 class="title">(^o^)</h2>
			<a href="http://eclecticmeme.com/index.php?option=com_content&id=7%3Achapter-four&catid=2%3A2007&Itemid=13#KingRonald" title="Meet King Ronald III"><img class="none" src="<?php echo $this->baseurl ?>/images/stories/mcdicks005.jpg" alt="McDonald Ad Busters"/></a>
			</div>

			<!--<div>
				<h2>(^_~)</h2>
				<img src="<?php echo $this->baseurl ?>/components/com_battle/includes/img7.jpg" alt="Photo" />
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque ac dolor. Aenean consectetuer nibh sed ante pretium egestas. Fusce hendrerit. Duis ultrices tristique diam.</p>
				<p>Quisque aliquet accumsan lectus. Nullam porttitor tortor et sem. Nulla lobortis, leo elementum fringilla mollis, magna neque rhoncus lorem, vitae venenatis tellus felis vitae lacus.</p>
				<p>Nunc ante. Cras sodales. Quisque augue enim, rutrum quis, dignissim quis, convallis molestie, nisi. Praesent at lacus. Aenean tincidunt. In hac habitasse platea dictumst.</p>
			</div>-->

</div>



