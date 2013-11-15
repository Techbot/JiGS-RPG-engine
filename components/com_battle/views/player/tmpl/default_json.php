<?php
$people= $this->player;

$id = 0;

$text ='<div id="screen_grid" style=" width: 400px; height:400px; margin: 0 auto; text-align:center;
		background:#000; float:left; position:relative; left:0px; top:0px;">
			<div id="profile_" class="clearfix">
			<div class="name">' . $people->username . '</div>
			<div class="desc">
			<img src="/images/comprofiler/' . $people->avatar .'" class="thumbnail" alt="' . $people->username .
			'" title="<' .  $people->username .'" width="100" height="100" id="character_image" />
			<div class="stats">
			<table class="stats" >
			<tr>
			<th scope="row">ID</th>
			<td>' . $people->iduser . '</td>
			</tr>
			<tr>
			<th scope="row">Name</th>
			<td>'. $people->username .'</td>
			</tr>
			<tr>		
			<th scope="row">Money</th>
			<td>'. $people->money .'</td>
			</tr>
			</table>
			</div><!-- end stats -->


			<p class="desc">'. $people->comment .'</p>
			</div><!-- end desc -->
			<div class="vitals">
			<div class="label">Experience:</div>
			<div class="gauge"><div id="xp"><span>'. $people->xp .'</span></div></div>
			<div class="label">Intelligence:</div>
			<div class="gauge"><div id="intel"><span>'. $people->intelligence .'</span></div></div>
			<div class="label">Strength:</div>
			<div class="gauge"><div id="strength"><span>'. $people->strength  .'</span></div></div>
			<div class="label">Health:</div>
			<div class="gauge"><div id="health" style="width:'. $people->health .'%"><span id="health">'. $people->health .
			'</span></div></div>
			</div><!-- end vitals -->
			</div><!-- end profile -->

			<div id="_inventory" class="clearfix">
			<div class="name">Inventory</div>
			';

		$text .='</div><!-- end inventory -->

			<div id="action" class="clearfix">
			<!-- <div class="recruit"><a class="recruit" href="#">Recruit</a></div> --> 
			<div class="shoot"><a onclick="shoot_player(' . $people->iduser . ')" id="shoot" >Shoot</a></div>
			<div class="kick"><a onclick="kick_player('. $people->iduser . ')" id="kick" >Kick</a> </div>
			<div class="punch"><a onclick="punch_player('. $people->iduser . ')" id="punch">Punch</a> </div>
			<div class="talk"><a onclick="talk_player('. $people->iduser . ')" id="talk">Talk</a> </div>
			<!--   <div class="bribe"><a class="bribe" href="#">Bribe</a></div>
			<div class="rob"><a class="rob" href="#">Rob</a></div>
			<div class="talk"><a class="talk" href="#">Talk</a></div>--> 
			</div>

			</div>
			';
		echo json_encode($text);
