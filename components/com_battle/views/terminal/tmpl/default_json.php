<?php

jimport( 'joomla.methods' );
//echo json_encode($this->info);
$id         = $this->info['id'];
$level      = $this->info['Level'];
$ip         = $this->info['ip'];
$bandwidth  = $this->info['bandwidth'];
$capacity   = $this->info['capacity'];
$version    = $this->info['version'];
$status     = $this->info['status'];
$faction    = $this->info['faction'];
$battery    = $this->info['battery'];
$link= '/components/com_battle/images/hacker-map.jpg';

$table = file_get_contents( 'http://eclecticmeme.com/components/com_battle/views/terminal/tmpl/table.php');

$body       = "
<a href='#' class='mid'></a>

<div style = 'background-image: url($link);
                background-repeat: no-repeat ;
                          height:344px;
                          width: 640px;
                            '>
<p id='scroller1' style = 'margin:.1em 0;'></p>
<p id='scroller2'  style = 'margin:.1em 0;'></p>
<p id='scroller3'  style = 'margin:.1em 0;'></p>
<p id='scroller4'  style = 'margin:.1em 0;'></p>
<p id='scroller5'  style = 'margin:.1em 0;'></p>
<p id='scroller6'  style = 'margin:.1em 0;'></p>
<p id='scroller7'  style = 'margin:.1em 0;'></p>
<p id='scroller8'  style = 'margin:.1em 0;'></p>
<p id='scroller9'  style = 'margin:.1em 0;'></p>
<p id='scroller10'  style = 'margin:.1em 0;'></p>
<p id='scroller11'  style = 'margin:.1em 0;'></p>
<p id='scroller12'  style = 'margin:.1em 0;'></p>
<p id='scroller13'  style = 'margin:.1em 0;'></p>
<p id='scroller14'  style = 'margin:.1em 0;'></p>
<p id='scroller15'  style = 'margin:.1em 0;'></p>
<p id='scroller16'  style = 'margin:.1em 0;'></p>
<p id='scroller17'  style = 'margin:.1em 0;'></p>
<p id='scroller18' style = 'margin:.1em 0;'> </p>

</div>";


//$body       .= $table;

$body .="

<table width ='100%'>
    <tr>
        <td>id:</td><td>$id </td>
<td>Level:</td><td>$level</td>
<td>ip:</td><td>$ip</td>
</tr>
<tr>
    <td>bandwidth:</td><td>$bandwidth</td>
    <td>capacity:</td><td>$capacity</td>
    <td>version:</td><td>$version</td>
</tr>
<tr>
    <td>status:</td><td>$status</td>
    <td>faction:</td><td>$faction</td>
    <td>battery</td><td>$battery</td>
</tr>
</table>
<div id='action' class='clearfix'>
    <!-- <div class='recruit'><a class='recruit' href='#'>Recruit</a></div> -->
    <div class='shoot'><a onclick='enter(\"scan\")' id='type_scan' >Scan</a></div>
    <div class='kick'><a onclick='enter(\"Decrypt\")' id='Decrypt' >Decrypt</a> </div>
    <div class='punch'><a onclick='enter(\"punch\")' id='punch'>Hack</a> </div>
    <div class='shoot'><a onclick='enter(\"SSH Login\")' id='SSH Login' >SSH Login</a></div>
    <div class='kick'><a onclick='enter(\"SSH Logout\")' id='SSH Logout' >SSH Logout</a> </div>
    <div class='punch'><a onclick='enter(\"Download\")' id='Download'>Download</a> </div>
    <div class='punch'><a onclick='enter(\"Upload\")' id='Upload'>Upload</a> </div>
    <div class='punch'><a onclick='enter(\"Delete\")' id='Delete'>Delete</a> </div>
    <div class='punch'><a onclick='enter(\"Trace\")' id='Trace'>Trace</a> </div>
    <div class='punch'><a onclick='enter(\"Killtrace\")' id='Killtrace'>Killtrace</a> </div>
    <div class='punch'><a onclick='enter(\"Deploy Virus\")' id='Deploy Virus'>Deploy Virus</a> </div>
    <div class='punch'><a onclick='enter(\"Execute\")' id='Execute'>Execute</a> </div>

<div class='input-group'>
    <span class='input-group-addon' id='sizing-addon2'>$</span>
    <input type='text' onchange='type_scan' name='commandLine' class='form-control' id='commandLine' placeholder='Enter Command'>
    <span class='input-group-btn'>
        <button class='btn btn-default' type='button' id='enter'>Enter</button>
    </span>
</div>
    <!--   <div class='bribe'><a class='bribe' href='#'>Bribe</a></div>
    <div class='rob'><a class='rob' href=#'>Rob</a></div>
    <div class='talk'<a class='talk' href=''#'>Talk</a></div>-->
</div>

<!-- end action --><!--
";

echo json_encode($body);
