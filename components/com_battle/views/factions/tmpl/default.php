<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 
echo "<pre>";
//print_r($this->factions);
echo "</pre>";	

    // print_r($this->metals);
foreach ($this->factions as $faction)

{
        echo "<table class='shade-table' border='1px' >";
        echo '<th>' .$faction->name .'</th><th> Total Members</th>  <th> Total Money</th> <th> Total Bank</th> <th>Total XP</th>         ';
        $i=0;
        foreach ($faction->groups as $group)
       
        {
            echo '<tr><td>
            <a href="http://eclecticmeme.com/index.php?option=com_battle&view=group&gid='. $group .'" >' . $faction->groupnames[$i] .'</a>
            
            
            </td>
            
          <td>  ' . $faction->groupstats[$i]->total_members . '</td>
          <td>  ' . $faction->groupstats[$i]->total_money . '</td>  
          <td>  ' . $faction->groupstats[$i]->total_bank . '</td>
           <td>  ' . $faction->groupstats[$i]->total_xp . '</td>
            
            </tr>';
			
		 //	foreach ($faction->$groupname->ids as $id)
		//		{
		//			echo '<tr><td> ' . $id.'</td></tr>';
		//	   }
		 	
		 	
		$i++; 	
        }    
            

    echo '</table>'; 
    echo '<br>';      
    echo '<br>'; 
 }
     ?>
