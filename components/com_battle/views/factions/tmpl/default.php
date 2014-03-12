<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 
//echo "<pre>";
//print_r($this->factions);
//echo "</pre>";	


//exit();
echo "<table class='shade-table' border='1px' >";
echo '<th>Guild Name </th><th>Faction</th><th>Avatar</th><th>Captain</th><th> Total Members</th>  <th> Total Money</th> <th> Total Bank</th> <th>Total XP</th>         ';
    // print_r($this->metals);
foreach ($this->factions as $group)

{
       
        
        $i=0;

            echo '<tr> <td>
            <a href="http://eclecticmeme.com/index.php?option=com_battle&view=group&gid='. $group->id .'" >' . $group->name .'</a>
            
            
            </td> '; 
            
            
            
      if ( $group->fid==42){
      
      
      echo "       
            
            
            
            
             <td>
           cyberian
             </td>  ";
             
             
             
             }
             
             
             
             
             
             
             ;
             
        if ( $group->fid==35){
      
      
      echo "       
            
            
            
            
             <td>
           gaian
             </td>  ";
             
             
             
             }
             
             
             
             
             
             
             ;   
             
             if ( $group->fid==36){
      
      
      echo "       6
            
            
            
            
             <td>
          fantasian
             </td>  ";
             
             
             
             }
             
             
             
             
             
             
             ;     
             
                 
             
             echo'
            
            
            
            
            
             <td>
            
            
            <img src="/images/comprofiler/' . $group->avatar .'" class="thumbnail" alt="' . $group->name .
			'" title="' .  $group->name .'" width="50" height="50" id="character_image" />
            
            
            
            
            
            
            
            
            
           
            
            
            </td> 
            <td>
            
            '.$group->captain_name .'
            
            
            </td> 
        
                        <td>
            
            '.$group->total_members .'
            
            
            </td>             <td>
            
            '.$group->total_money .'
            
            
            </td> 
            
            
                        <td>
            
            '.$group->total_bank .'
            
            
            </td> 
                        <td>
            
            '.$group->total_xp .'
            
            
            </td> 
            
            
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

     ?>
