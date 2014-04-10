<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 
	

        echo "<table class='shade-table' border='1px' >";
        echo '<th></th><th>name</th><th>xp</th><th>health</th><th>bank</th><th>money</th><th>level</th>';
       

           foreach ($this->groups as $char)
         
                 {    
                 
               if ($char->type=="pc"){
               
               $path= "images/comprofiler/";
               
               }  
                if ($char->type=="npc"){
               
               $path = "components/com_battle/images/ennemis/miniatures/";
               
               } 
 
                    echo '<tr>
                 
                                    <td> <img src="'. $path . $char->avatar. '" class="thumbnail" alt="' . $char->avatar .
			                '" title="' .  $char->name .'" width="50" height="50" id="character_image" />
			
			
			                </td>    
                            <td> <a href= "http://eclecticmeme.com/index.php?option=com_comprofiler&task=userprofile&user=' .$char->id .'">'.$char->name.'</a></td>    
                            <td> ' .$char->xp.'</td>
                           <td> ' .$char->health.'</td>
                           <td> ' .$char->bank.'</td>
                           <td> ' .$char->money.'</td>
                            <td>' .$char->level.'</td>
                  
           </tr>';
			
         }	
         
         
         
            

    echo '</table>'; 
    echo '<br>';      
    echo '<br>'; 

     ?>
