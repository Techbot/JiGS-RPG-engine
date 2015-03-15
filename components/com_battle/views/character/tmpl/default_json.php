<?php
$people = $this->people;
$loses = $people->nbr_attacks - $people->nbr_kills;
$text ='

            <div id="profile_" class="NPC clearfix">

          <a href="#" class="mid"></a>
                <div class="name">' . $people->name  . '</div>
                <div class="clearfix" id="action">
                    <div class="btn btn-danger shoot"><a onclick="shoot_character(' . $people->id  . ')" id="shoot" >Shoot</a></div>
                    <div class="btn btn-danger kick"><a onclick="kick_character(' . $people->id  . ')" id="kick" >Kick</a></div>
                    <div class="btn btn-danger punch"><a onclick="punch_character(' . $people->id  . ')" id="punch">Punch</a></div>
                    <div class="inactive btn recruit btn-warning"><a class="recruit" href="#">Recruit</a></div>
                    <div class="inactive btn bribe btn-warning"><a class="bribe_character" href="#">Bribe</a></div>
                    <div class="inactive btn rob btn-warning"><a class="rob_character" href="#">Rob</a></div>
                    <div class="btn talk btn-warning"><a onclick="talk_character(' . $people->id  . ')" id="talk">Talk</a></div>
                </div>

                <div class="clearfix vitals">

                    <div class="vital xp">
                        <div class="label">Slack:</div>
                        <div class="gauge"><div style="width:'. $people->slack .'%" id="strength"><span>' . $people->slack  . '</span></div></div>
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

                    <dl class="char stats dl-horizontal">
                        <dt>Name</dt>
                        <dd>' . $people->name  . '</dd>
                        <dt>Faction</dt>
                        <dd>unknown</dd>
                        <dt>Group</dt>
                        <dd>unknown</dd>
                        <dt>Address</dt>
                        <dd>' . $people->map  . ' / ' . $people->grid  . '</dd>
                    </dl>

                        <table class="stats">
                            <tr>
                                <th scope="row">ID</th>
                                <td>' . $people->id  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Level</th>
                                <td>' . $people->level  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">XP</th>
                                <td>' . $people->xp  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Attack</th>
                                <td>' . $people->attack  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Defence</th>
                                <td>' . $people->defence  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Attacks</th>
                                <td>' . $people->nbr_attacks  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Wins</th>
                                <td>' . $people->nbr_kills  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Loses</th>
                                <td>' . $loses  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Cash</th>
                                <td>' . $people->money  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Bank</th>
                                <td>' . $people->bank  . '</td>
                            </tr>
                        </table>
                        <table class="stats">
                            <tr>
                                <th scope="row">Intel</th>
                                <td>' . $people->intelligence  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Strength</th>
                                <td>' . $people->strength  . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Speed</th>
                                <td>' . $people->speed  . '</td>
                            </tr>
                        </table>

                    </div><!-- end stats -->
                    <hr style="clear:both;">
                    <div class="clearfix npc_bio">
                        <div class="npc_desc">
                            <h4>Description</h4>
                            <p class="desc">' . $people->comment  . '</p>
                        </div>
                        <div class="npc_char">
                            <h4>Characteristics</h4>
                        <ul>
                                <li>' . $people->mood  . '</li>
                                <li>' . $people->aggression  . '</li>
                                <li>unknown</li>
                        </ul>
                        </div>
                        <div class="npc_history">
                            <h4>History</h4>
                            <div>' . $people->history  . '</div>
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
        $text .='</div><!-- end profile -->';
        echo json_encode($text);
