<?php

require_once('/var/www/www.eclecticmeme.com/components/com_battle/includes/ascii_art.php');
$x = new AsciiArt('/var/www/www.eclecticmeme.com/components/com_battle/images/sito/avatar2.jpg');
$color = $x->getBackgroundColor()->getHexValue();
?>


<?php
$x->setFontSize(6);

$stuff = $x->show(range("a", "z"), 0.25, true, true);



echo json_encode($stuff);

//echo $x->show(range("a", "z"), 0.25, true, true);


?>

