<?php
$people= $this->player;

$id = 0;

$text ='
			<div id="profile_" class="PLAYERS clearfix">

			<a href="index.php?option=com_battle&amp;view=phaser&amp;Itemid=115" class="mid"></a>


				<div class="name">' . $people->name  . '</div>

				<div class="clearfix" id="action">
					<div class="btn btn-danger shoot"><a onclick="shoot_player(' . $people->id  . ')" id="shoot" >Shoot</a></div>
					<div class="btn btn-danger kick"><a onclick="kick_player(' . $people->id  . ')" id="kick" >Kick</a></div>
					<div class="btn btn-danger punch"><a onclick="punch_player(' . $people->id  . ')" id="punch">Punch</a></div>
					<div class="inactive btn recruit btn-warning"><a class="recruit" href="#">Recruit</a></div>
					<div class="inactive btn bribe btn-warning"><a class="bribe_character" href="#">Bribe</a></div>
					<div class="inactive btn rob btn-warning"><a class="rob_character" href="#">Rob</a></div>
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
						<!--img src="/components/com_battle/images/ennemis/' . $people->avatar . '" class="thumbnail" alt="'. $people->name . ' " title="' . $people->name .'" width="100" height="100" id="character_image" /-->
				<img src="/images/comprofiler/' . $people->avatar . '" class="thumbnail" alt="'. $people->name . ' " title="' . $people->name .'" width="100" height="100" id="character_image" />
						</figure>

					<div class="stats">

						<dl class="char stats dl-horizontal">

							<dt>Name</dt>
							<dd>' . $people->name  . '</dd>

							<dt>Age</dt>
							<dd>unknown</dd>

							<dt>Gender</dt>
							<dd>unknown</dd>

							<dt>Address</dt>
							<dd>unknown</dd>

							<dt>Vocation</dt>
							<dd>unknown</dd>

						</dl>


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

					</div><!-- end stats -->

					<hr style="clear:both;">

					<div class="clearfix npc_bio">


						<div class="npc_desc">

							<h4>Description</h4>

							<p class="desc">' . $people->commentaire  . '</p>

							<ul>
								<li>unknown</li>
								<li>unknown</li>
								<li>unknown</li>
							</ul>

						</div>


						<div class="npc_char">

							<h4>Characteristics</h4>

							<ul>
								<li>unknown</li>
								<li>unknown</li>
								<li>unknown</li>
							</ul>

						</div>

						<div class="npc_history">

							<h4>History</h4>

							<p>unknown</p>

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

?>

