<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 
echo "<pre>";
//print_r($this->groups);
echo "</pre>";	

    // print_r($this->metals);

        echo "<table class='shade-table' border='1px' >";
        echo '<th></th><th>name</th><th>xp</th><th>health</th><th>bank</th><th>money</th><th>level</th>';
          foreach ($this->groups as $player)

        {    
                    echo '<tr>
                    <td> <img src="/images/comprofiler/' . $player['avatar'] .'" class="thumbnail" alt="' . $player['username'] .
			'" title="' .  $player['username'] .'" width="100" height="100" id="character_image" />
			
			
			</td>    
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                    <td> <a href= "http://eclecticmeme.com/index.php?option=com_comprofiler&task=userprofile&user=' .$player["iduser"] .'">'.$player["username"].'</a></td>    
            <td> ' .$player["xp"].'</td>
           <td> ' .$player["health"].'</td>
           <td> ' .$player["bank"].'</td>
           <td> ' .$player["money"].'</td>
            <td>' .$player["level"].'</td>
                  
                     </tr>';
			
         }	
            

    echo '</table>'; 
    echo '<br>';      
    echo '<br>'; 

     ?>
