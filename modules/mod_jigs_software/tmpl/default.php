<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$db =& JFactory::getDBO();
$user =& JFactory::getUser();

$query = ('SELECT * FROM #__jigs_software') ;
$db->setQuery($query);
$rows =$db->loadAssoc();



$options = array(
    'onActive' => 'function(title, description){
        description.setStyle("display", "block");
        title.addClass("open").removeClass("closed");
    }',
    'onBackground' => 'function(title, description){
        description.setStyle("display", "none");
        title.addClass("closed").removeClass("open");
    }',
    'startOffset' => 0,  // 0 starts on the first tab, 1 starts the second, etc...
    'useCookie' => true, // this must not be a string. Don't use quotes.
);


$name = Array(8);

$name[1]='Sub Routine';
$name[2]='Method';
$name[3]='Function';
$name[4]='Algorythm';
$name[5]='Stack';
$name[6]='Procedure';
$name[7]='API';
$name[8]='Plugin';





 // echo "<pre>";
 // print_r($rows);
 // echo "</pre>";

for ($i = 1; $i <= 8; $i++ )
{


// echo $pane->startPanel($i, 'panel' );
// if (($row->iduser)==($user->id)){
	  
echo '
	   <table class="admintable">
    <tr>
      <td width="100" align="right"  colspan="2" class="key">
   
     
        <input class="text_area" type="text" name="name" id="name" size="12"maxlength="12" value="'. $name[$i]  . '" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
       Quantity:
      </td>
      <td>
        <input class="text_area" type="text" name="address" id="address" size="5" maxlength="5" value="'. $rows['quantity_'. $i] . '" />
      </td>
    </tr>
	        <tr>
      <td width="100" align="right" class="key">
 Price :
      </td>
      <td>
            <input class="text_area" type="text" name="address" id="address" size="5" maxlength="5" value="'. $rows['price_' . $i] . '" />
      </td>
    </tr>
    </table>
	
 	' ;
	// }


	
	

	
	}



