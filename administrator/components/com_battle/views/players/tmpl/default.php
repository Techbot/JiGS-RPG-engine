<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

JToolBarHelper::title( JText::_( 'Players' ), 'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::preferences('com_battle');
JToolBarHelper::editList();
JToolBarHelper::deleteList('Are you sure you want to delete reviews?');
JToolBarHelper::addNew();

?>
<form action="index.php" method="post" name="adminForm">
<table class="adminlist">
  <thead>
    <tr>
      <th width="20">
        <input type="checkbox" name="toggle" 
             value="" onclick="checkAll(<?php echo 
             count( $this->rows ); ?>);" />
      </th>
      <th class="title">Name</th>
      <th class="title">Pic</th>      
      <th width="15%">Money</th>
      <th width="10%">xp</th>
      <th width="10%">intelligence  </th>  
      <th width="10%">Attack</th>
      <th width="10%">Defense</th>
      <th width="10%">nbrattacks</th>
      <th width="10%">nbrkills  </th>  
      <th width="10%">active  </th> 
      <th width="10%">time killled  </th>  
      <th width="10%">strength   </th>   
     
    </tr>
  </thead>

  <?php
  jimport('joomla.filter.output');
  $k = 0;
  for ($i=0, $n=count( $this->rows ); $i < $n; $i++) 
  {
    $row = &$this->rows[$i];
    $checked = JHTML::_('grid.id', $i, $row->id );
    $published = JHTML::_('grid.published', $row, $i );
	$link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&task=edit&controller=players&cid[]='. $row->id );
    ?>
    <tr class="<?php echo "row$k"; ?>">
      <td>
        <?php echo $checked; ?>
      </td>
      <td>
        <a href="<?php echo $link; ?>"><?php echo $row->username; ?></a>
      </td>
         
           <td>
      
      <img src="<?php echo JURI::root(); ?>/images/comprofiler/<?php echo $row->avatar ?>" height = '50px' width='50px' >
       </td>
      
      
      <td>
        <?php echo $row->money; ?>
      </td>
      <td>
        <?php echo $row->xp; ?>
      </td>
  
        <td>
        <?php echo $row->intelligence; ?>
      </td>    
       <td>
        <?php echo $row->attack; ?>
      </td>
       <td>
        <?php echo $row->defence; ?>
      </td>
      
        <td>
        <?php echo $row->nbrattacks; ?>
      </td>     
           <td>
        <?php echo $row->nbrkills ?>
      </td>    
                 <td>
        <?php echo $row->active ?>
      </td>    
      
      <td>
       <?php echo $row->time_killed ?>
         </td>   
       <td>
       <?php echo $row->strength ?>
         </td>    
    
    
   
    </tr>
    
    
    
    
    
    
    
    <?php
    $k = 1 - $k;
  }
  ?>
</table>
<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="controller" value="players" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>