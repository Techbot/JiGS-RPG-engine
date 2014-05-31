<?php
$people = $this->people;

		$text ='
		<div style=" width: 100%; height:auto; margin: 0 auto; text-align:center; background:#000; " id="screen_grid">

			<div id="profile_" class="clearfix">
			
			<a href="index.php?option=com_battle&amp;view=single&amp;Itemid=115" class="mid"></a>


				<div class="name">' . $people->name  . '</div>
				
				<div class="clearfix" id="action">
					<div class="btn btn-danger shoot"><a onclick="shoot_character(' . $people->id  . ')" id="shoot" >Shoot</a></div>
					<div class="btn btn-danger kick"><a onclick="kick_character(' . $people->id  . ')" id="kick" >Kick</a></div>
					<div class="btn btn-danger punch"><a onclick="punch_character(' . $people->id  . ')" id="punch">Punch</a></div>
					<div class="btn recruit btn-warning"><a class="recruit" href="#">Recruit</a></div>
					<div class="btn bribe btn-warning"><a class="bribe_character" href="#">Bribe</a></div>
					<div class="btn rob btn-warning"><a class="rob_character" href="#">Rob</a></div>
					<div class="btn talk btn-warning"><a onclick="talk_character(' . $people->id  . ')" id="talk">Talk</a></div>
				</div>
				
				<div class="clearfix vitals">
					<div class="vital xp">
						<div class="label">Experience:</div>
						<div class="gauge"><div style="width:'. $people->xp .'%" id="xp"><span>' . $people->xp  . '</span></div></div>
					</div>
					<div class="vital xp">
						<div class="label">Intelligence:</div>
						<div class="gauge"><div style="width:'. $people->intelligence .'%" id="intel"><span>' . $people->intelligence  . '</span></div></div>
					</div>
					<div class="vital xp">
						<div class="label">Strength:</div>
						<div class="gauge"><div style="width:'. $people->strength .'%" id="strength"><span>' . $people->strength  . '</span></div></div>
					</div>	
					<div class="vital xp">
						<div class="label">Health:</div>
						<div class="gauge"><div style="width:'. $people->health .'%" id="health"><span id="health_value">' . $people->health  . '</span></div></div>
						
					</div>	
				</div><!-- end vitals -->
				
				<hr>	


				<div class="desc">
					
					<figure>
						<img src="/components/com_battle/images/ennemis/' . $people->avatar . '" class="thumbnail" alt="'. $people->name . ' " title="' . $people->name .'" width="100" height="100" id="character_image" />
					</figure>
					
					<div class="stats">
						
						<table class="stats">
							<tr>
								<th scope="row">ID</th>
								<td>' . $people->id  . '</td>
							</tr>
							<tr>
								<th scope="row">Name</th>
								<td>' . $people->name  . '</td>
							</tr>
							<tr>		
								<th scope="row">Money</th>
								<td>' . $people->money  . '</td>
							</tr>
							<tr>		
								<th scope="row">XP</th>
								<td>' . $people->xp  . '</td>
							</tr>
							<tr>		
								<th scope="row">Intel</th>
								<td>' . $people->intelligence  . '</td>
							</tr>
							<tr>		
								<th scope="row">Strength</th>
								<td>' . $people->strength  . '</td>
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

							<p class="desc">' . $people->comment  . '</p>

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
								He left home at 14 when his tutor was killed under suspecious circumstances. His adopted parent"s distrust of him due to his genius only heightened as he got older and more independent, so he gravitated towards intellectual-based social scenes until being introduced to the underground intelligencia.
							</p>
							
						</div>	
						
					</div><!-- end bio -->
						
				</div><!-- end desc -->
		
		
			<!--
				<div id="_inventory" class="clearfix">
					<div class="name">Inventory</div>
					
					/*foreach ($this->inv as $inv_object)
					{
					$text .= "<br>" . $inv_object["name"] ;
					}
					* /
				</div>
			-->
			';
				
			$text .='</div><!-- end profile -->
			';

		echo json_encode($text);
