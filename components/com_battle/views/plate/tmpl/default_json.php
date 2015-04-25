<?php defined( '_JEXEC' ) or die( 'Restricted access' );

 jimport( 'joomla.methods' );

//JHTML::_('behavior.modal'); 

$link = "http://eclecticmeme.com/components/com_battle/views/plate/tmpl/" . $this->plate->details;

echo json_encode( "<iframe src='$link' style = 'height:500px;width:690px;'></iframe>");