
<div id="profile_" class="clearfix">
	<div class="name"><?php echo $this->people->name ; ?></div>
	
	<div class="clearfix" id="action">
		<div class="btn btn-danger shoot"><a onclick="shoot_character(<?php echo $this->people->id ; ?>)" id="shoot" >Shoot</a></div>
		<div class="btn btn-danger kick"><a onclick="kick_character(<?php echo $this->people->id ; ?>)" id="kick" >Kick</a></div>
		<div class="btn btn-danger punch"><a onclick="punch_character(<?php echo $this->people->id ; ?>)" id="punch">Punch</a></div>
		<div class="btn recruit btn-warning"><a class="recruit" href="#">Recruit</a></div>
		<div class="btn bribe btn-warning"><a class="bribe_character" href="#">Bribe</a></div>
		<div class="btn rob btn-warning"><a class="rob_character" href="#">Rob</a></div>
		<div class="btn talk btn-warning"><a onclick="talk_character(<?php echo $this->people->id ; ?>)" id="talk">Talk</a></div>
	</div>
	
	<div class="clearfix vitals">
		<div class="vital xp">
			<div class="label">Experience:</div>
			<div class="gauge"><div id="xp"><span><?php echo $this->people->xp ; ?></span></div></div>
		</div>
		<div class="vital xp">
			<div class="label">Intelligence:</div>
			<div class="gauge"><div id="intel"><span><?php echo $this->people->intelligence ; ?></span></div></div>
		</div>
		<div class="vital xp">
			<div class="label">Strength:</div>
			<div class="gauge"><div id="strength"><span><?php echo $this->people->strength ; ?></span></div></div>
		</div>	
		<div class="vital xp">
			<div class="label">Health:</div>
			<div class="gauge"><div style="width:100%" id="health"><span id="health_value"><?php echo $this->people->health ; ?></span></div></div>
		</div>	
	</div><!-- end vitals -->
	
	<hr>	


	<div class="desc">
		
		<figure>
			<img src="<?php echo $this->baseurl; ?>/components/com_battle/images/ennemis/<?php echo $this->people->avatar;?>" class="thumbnail" alt="<?php $this->people->name ; ?>" title="<?php $this->people->name ; ?>" width="100" height="100" id="character_image" />
		</figure>
		
		<div class="stats">
			
			<table class="stats">
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
				<tr>		
					<th scope="row">XP</th>
					<td><?php echo $this->people->xp ; ?></td>
				</tr>
				<tr>		
					<th scope="row">Intel</th>
					<td><?php echo $this->people->intelligence ; ?></td>
				</tr>
				<tr>		
					<th scope="row">Strength</th>
					<td><?php echo $this->people->strength ; ?></td>
				</tr>
			</table>
			
			<dl class="char stats dl-horizontal">
								
				<dt>Name</dt>
				<dd>Bob</dd>

				<dt>Age</dt>
				<dd>47</dd>

				<dt>Gender</dt>
				<dd>Male</dd>

				<dt>Address</dt>
				<dd>Unit 23, Level 8, BBHC Labs</dd>

				<dt>Vocation</dt>
				<dd>Scientist</dd>

			</dl>


		</div><!-- end stats -->

		<hr style="clear:both;">

		<div class="clearfix npc_bio">


			<div class="npc_desc">

				<h4>Description</h4>

				<p class="desc"><?php echo $this->people->comment ; ?></p>

				<ul>
					<li>creator of the Eclectic Meme Conspiracy - the game</li>
					<li>nerdy but hip</li>
					<li>mad professor</li>
				</ul>

			</div>


			<div class="npc_char">
				
				<h4>Characteristics</h4>
				
				<ul>
					<li>disorganised</li>
					<li>genius</li>
					<li>dealistic when young</li>
					<li>increasingly delusional, egotistical, obsessive</li>
				</ul>
				
			</div>

			<div class="npc_history">
				
				<h4>History</h4>
					
				<p>
					He was born and soon after abandoned in the slums on the outskirts of the city. He was discovered and subsequently sold into adoption by the local slum lord, at 15 days old, procuring a huge resale value due to his intelligence readings being off the charts. According to the local authority, he would be 15% omniscient by the age of 6. He was raised in the city’s level 4, by a prestigious and wealthy couple who quickly entrusted his care to a professional tutor when they realised how fast his mind was developing.
				</p>
				
				<p>
					He left home at 14 when his tutor was killed under suspecious circumstances. His adopted parent's distrust of him due to his genius only heightened as he got older and more independent, so he gravitated towards intellectual-based social scenes until being introduced to the underground intelligencia.
				</p>
				
			</div>	
			
		</div><!-- end bio -->
			
	</div><!-- end desc -->
		
		


		<!--
		<div id="_inventory" class="clearfix">
			<div class="name">Inventory</div>
			<?php
			foreach ($this->inv as $inv_object)
			{
				echo '<br>' . $inv_object['name'] ;
			}
			?>
		</div>
		-->

		
</div><!-- end profile -->

		
