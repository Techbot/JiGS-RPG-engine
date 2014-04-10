<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 
//echo "<pre>";
//print_r($this->factions);
//echo "</pre>";	

echo "<table class='shade-table' border='1px' >";
echo '<th>Guild Name </th><th>Faction</th><th>Avatar</th><th>Captain</th><th> Total Members</th>  <th> Total Money</th> <th> Total Bank</th> <th>Total XP</th>         ';
    // print_r($this->metals);
foreach ($this->factions as $group)

{
    echo "<tr><td><a href='http://eclecticmeme.com/index.php?option=com_battle&view=group&gid=$group->id'>$group->name</a></td>"; 
    
    if ( $group->faction==42)
    {
        echo "<td>cyberian</td>";
    }
    
    elseif ( $group->faction==35)
    {
        echo "<td>gaian</td>";
    }   
             
    elseif ( $group->faction==36)
    {
        echo "<td>fantasian</td>";
    }
    else
    {
        echo "<td></td>";
    }         
 
    echo "<td><img src='/images/comprofiler/$group->avatar' class='thumbnail' alt='$group->name ' title='$group->name' width='50' height='50' id='character_image' /></td> 
    <td>$group->captain_name </td>
    <td>$group->total_members </td>
    <td>$group->total_money </td>
    <td>$group->total_bank </td> 
    <td>$group->total_xp </td> 
    </tr>";
        
}         

    echo '</table>'; 
    echo '<br>';      
    echo '<br>'; 

     ?>
