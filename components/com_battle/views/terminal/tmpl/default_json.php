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
$table = file_get_contents( 'http://eclecticmeme.com/components/com_battle/views/terminal/tmpl/table.php');

$body       = "
<a href='#' class='mid'></a>
<img src = '/components/com_battle/images/hacker-map.jpg'>";

$body       .= $table;


echo json_encode($body);



