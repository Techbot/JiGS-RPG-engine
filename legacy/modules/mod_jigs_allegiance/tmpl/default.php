<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$db =& JFactory::getDBO();
$user =& JFactory::getUser();





$query = ('SELECT cb_faction FROM jos_comprofiler WHERE user_id = "'.$user->id) .'"' ;
$db->setQuery($query);
$faction=$db->loadResult();



jimport('joomla.html.pane');
//1st Parameter: Specify 'tabs' as appearance 
//2nd Parameter: Starting with third tab as the default (zero based index)
//open one!




 // echo "<pre>";
 // print_r($rows);
 // echo "</pre>";


	  
echo '
	   <table class="admintable">
    <tr>
      <td width="100" align="right" class="key">
    Name:
      </td>
      <td>
        <input class="text_area" type="text" name="faction_name" id="name" size="5" maxlength="5" value="'. $faction  . '" />
      </td>
    </tr>
 
    </table>
	
 	' ;
