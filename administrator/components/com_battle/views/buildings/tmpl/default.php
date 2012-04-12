<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

JToolBarHelper::title( JText::_( 'Buildings' ), 'generic.png' );
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
      <th class="title" width="5%">
        <input type="checkbox" name="toggle" 
             value="" onclick="checkAll(<?php echo 
             count( $this->rows ); ?>);" />
      </th>   
            <th class="title" width="5%">id</th>   
      <th class="title" width="10%">image</th>
      <th class="title" width="10%">name</th>
     <th class="title" width="10%">type</th>
          <th class="title" width="5%">xp</th>
      <th>comment</th>
        <th width="5%">grid</th>
        <th width="5%">map</th>      
      <th width="5%">posx</th>
      <th width="5%">posy</th>
    
    </tr>
  </thead>
  

  <?php
  
  
  //print_r($this->rows);
  
  
  jimport('joomla.filter.output');
  $k = 0;
  for ($i=0, $n=count( $this->rows ); $i < $n; $i++) 
  {
    $row = &$this->rows[$i];
    $checked = JHTML::_('grid.id', $i, $row->id );
    $published = JHTML::_('grid.published', $row, $i );
	$link = JFilterOutput::ampReplace( 'index.php?option=com_battle&task=edit&controller=buildings&cid[]='. $row->id );
    ?>
    <tr class="<?php echo "row$k"; ?>">
      <td>
        <?php echo $checked; ?>
      </td>
     
            <td>
      <?php echo $row->id; ?>
      </td>   
           <td>
    <a href="<?php echo $link; ?>"> <img src="<?php echo JURI::root(); ?>/components/com_battle/images/buildings/<?php echo $row->image ?>" height = '50px' width='50px' ></a>
      </td>
     
     
     
      <td>
        <a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
      </td>
      
         <td>
      <?php echo $row->type; ?>
      </td>   
         <td>
      <?php echo $row->xp; ?>
      </td>        
      
      <td>
        <?php echo $row->comment; ?>
      </td>
       <td>
        <?php echo $row->grid; ?>
      </td> 
         <td>
        <?php echo $row->map; ?>
      </td>    
      <td>
        <?php echo $row->posx; ?>
      </td>
      <td>
        <?php echo $row->posy; ?>
      </td>
 
    </tr>
    <?php
    $k = 1 - $k;
  }
  ?>
</table>
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="controller" value="buildings" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>