<?php

jimport( 'joomla.methods' ); 
if ($this->player->id == 0){
    $this->player->name = 'The King';
}
//echo 'test:';
// print_r($this->buildings);
//exit();



$body ='
<div class="building_left">


<a href="#" class="mid"></a>
    <div id="info" class=" clearfix">
      <div class="name">'. $this->player->name  . ' owns ' . $this->buildings->name . '
        <span class="small">[Level 1]</span>
        <span class="red"><a href="#" title="Allocate stats points">-</a></span>
        <span class="small">
          <span class="highlight">3 Stats Pts</span>
          <span class="red"><a href="#" title="Allocate stats points">-</a></span>
        </span>
      </div>
      
      
      <div class="desc">
        <img src="components/com_battle/images/buildings/'.$this->buildings->image  . '"
        class="thumbnail" alt="' . $this->buildings->name . ' title="' . $this->buildings->name . '"
        width="100" height="100" id="building_image" />
        <p class="desc">' . $this->buildings->comment  . '</p>
      </div><!-- end desc -->



      <div class="stats">
        <table class="stats" id="stats" >
          <tr>
            <th scope="row">ID</th>
            <td>' . $this->buildings->id . '</td>
          </tr>
          <tr>
            <th scope="row">Protection</th>
            <td>' . $this->buildings->protection . '</td>
          </tr>
          <tr>
            <th scope="row">Energy</th>
            <td id ="t_energy">' . $this->buildings->energy  . '</td>
          </tr>
          <tr>
            <th scope="row">Type</th>
            <td>' . $this->buildings->type  . '</td>
          </tr>
          <tr>
            <th scope="row">Owner</th>
            <td>' .$this->buildings->owner  . '</td>
          </tr>';


          
          
          
       $body .='     <tr>
            <th scope="row">Hobbits</th>
            <td id ="_h"><span id ="assign_primary_data">' . $this->building_hobbit_stats->primary . '</span> / <span id ="assign_distribution_data">' . $this->building_hobbit_stats->distribution . '</span> / <span id ="assign_defence_data">' . $this->building_hobbit_stats->defence . '</span></td>
          </tr>';
        
           
          
  $body .='        
          
          <tr>
            <th scope="row">XP</th>
            <td>' . $this->buildings->xp  . '</td>
          </tr>
          <tr>
            <th scope="row">Sale Price</th>
            <td>' . $this->buildings->price  . '</td>
          </tr>
          <tr>
            <th scope="row">Timer</th>
            <td>' . $this->buildings->timer . '</td>
          </tr>
        </table>
      </div><!-- end stats -->
    </div><!-- end info -->
    <div class="extra clearfix">
      <div class="message_board">
        ' . $this->loadTemplate ("board_message") .  '
      </div>
    </div>
  </div><!--end building_left-->



  <div class="building_right">
    <div id="status">
      <div class="instructions">';


    if ($this->buildings->owner == 0)
    {
        if ($this->buildings->type == 'bank')
        {
            $body .= $this->loadTemplate ("board_info_bank");
        }else
        {
            $body .= $this->loadTemplate ("board_info_poster");
        }
    }


    if ($this->buildings->owner != $this->user->id && $this->buildings->owner != 0 )
    {
        $body .= $this->loadTemplate ("board_info_poster");
    }


    //if player owned

    if ($this->buildings->owner == $this->user->id)
    {
        $body .= $this->loadTemplate ("board_info1");
    }
    $body .='  </div>



    <div id="action" class="clearfix">
    ';

//////////////////////////////   No Owner - Buy Only //////////////////////////////////
    if ($this->buildings->owner == 0)
    {

    if ($this->buildings->type == 'bank')
            {
                    $body .=' <div class="buy" ><a href="#" class= "buy" id = "'. $this->buildings->id .'" >Hack this ' . $this->buildings->type .'</a></div> <!--hack-->';
            }
        if ($this->buildings->type == 'farm' ||$this->buildings->type == 'mine'  ||$this->buildings->type == 'factory')
            {
                    $body .=' <div class="buy" ><a href="#" class= "buy" id = "'. $this->buildings->id .'" >Buy this ' . $this->buildings->type .'</a></div> <!--buy-->';
            }

     if ($this->buildings->type == 'stand' ||$this->buildings->type == 'reprocessor'  ||$this->buildings->type == 'factory')
        {
            $body .=' <div class="buy" ><a href="#" class= "buy" id = "'. $this->buildings->id .'" >Attack this ' . $this->buildings->type .'</a></div> <!--buy-->';
        }
 



    }
/////////////////////////////////////// Owned but not Player Owned //////////////////////////
if ($this->buildings->owner != $this->user->id && $this->buildings->owner != 0 ){
  $body .='      <div class= "attack" >
          <!--a href="#" class= "attack" id = "' . $this->buildings->id . '"> Attack this '. $this->buildings->type .'</a-->
        </div><!-- attack-->
        ';

} 
///////////////////////////////////// Owned by Player  ////////////////////////// 
if ($this->buildings->owner == $this->user->id){
    // echo $this->loadTemplate ('board_info1');
    //  echo $this->loadTemplate ('board_crystals');
}
$body .='
      </div><!-- end action -->
    </div><!-- end status. Is this being used? I mean, really?? -->
  </div><!--end building_right-->
  <div class="clearfix"></div>
  <div id="building_function" class="clearfix">

';


if ($this->buildings->owner == $this->user->id || $this->buildings->public == 1 )
{

    $body .= $this->loadTemplate ($this->buildings->type);


}
elseif ($this->buildings->owner == 0 ||$this->buildings->owner == "")
{

    $body .= $this->loadTemplate ($this->buildings->type . "_not_owned");
}
elseif($this->buildings->owner != $this->user->id )
{

    $body .= $this->loadTemplate ($this->buildings->type . "_owned");
}


$body .='</div><!--end building_function-->';

//$body = "hello";
echo json_encode($body);



