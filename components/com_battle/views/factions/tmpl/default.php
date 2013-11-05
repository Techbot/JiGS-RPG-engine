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
        echo '<th><td> ' .$faction->name .'</td></th>';
        $i=0;
        foreach ($faction->groups as $group)
       
        {
            echo '<tr><td>
            <a href="http://eclecticmeme.com/index.php?option=com_battle&view=group&gid='. $group .'" >' . $faction->groupnames[$i] .'</a>
            
            
            </td></tr>';
			
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
