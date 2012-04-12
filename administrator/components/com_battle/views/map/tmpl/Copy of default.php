<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();

if ($this->row->id) {
	JToolBarHelper::title( JText::_( 'Edit Drug Profile' ), 'addedit.png' );
} else {
	JToolBarHelper::title( JText::_( 'Add Drug Profile' ), 'addedit.png' );
}

JToolBarHelper::save();
JToolBarHelper::apply();
if ($this->row->id) {
	JToolBarHelper::cancel( 'cancel', 'Close' );
} else {
	JToolBarHelper::cancel();
}?>


<div  style = "border:1px; border-color:black;">

<?php
	for ($y=0;  $y <= 7 ; $y++) {
		?>

		
		
<?php 
		
	 $name='row'.$y;
	//  echo $name;
	 	$arr[$y] = explode(",",($this->row->$name)); 
	// 	print_r($arr[$x]);

 $x = 0;	 	
foreach ($arr[$y] as $row){
	
	
	?>
	
	<div style= "
	position:absolute;
	width:10px;
	top:<?php echo ($y*50)+100?>px;
	left: <?php echo $x*20?>px;
	 padding: 1px;" > <?php echo $row ?></div>
	
<?php	

$x= $x+10;
	}
}
	 
	 ?>	

  </div>
 



<form action="index.php" method="post" name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend>Details</legend>
    <table>
        <tr>
      <td width="100" align="right" class="key">
        row00
      </td>
      <td>
        <input class="text_area" type="text" name="iduser" id="iduser" size="50" maxlength="50" value="<?php echo $this->row->row0;?>" />
      </td>
    </tr>
   
     <tr>
      <td width="100" align="right" class="key">
        row01
      </td>
      <td>
        <input class="text_area" type="text" name="iduser" id="iduser" size="50" maxlength="50" value="<?php echo $this->row->row1;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        row02
      </td>
      <td>
         <input class="text_area" type="text" name="quantite1" id="quantite1" size="50" maxlength="50" value="<?php echo $this->row->row2;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        row03
      </td>
      <td>
          <input class="text_area" type="text" name="prix1" id="prix1" size="50" maxlength="50" value="<?php echo $this->row->row3;?>" />
      </td>
    </tr>
       <tr>
      <td width="100" align="right" class="key">
        row04
      </td>
      <td>
         <input class="text_area" type="text" name="quantite2" id="quantite2" size="50" maxlength="50" value="<?php echo $this->row->row4;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        row05
      </td>
      <td>
          <input class="text_area" type="text" name="prix2" id="prix2" size="50" maxlength="50" value="<?php echo $this->row->row5;?>" />
      </td>
    </tr><tr>
      <td width="100" align="right" class="key">
        row06
      </td>
      <td>
         <input class="text_area" type="text" name="quantite3" id="quantite3" size="50" maxlength="50" value="<?php echo $this->row->row6;?>" />
      </td>
    </tr>
    <tr>
      <td width="100" align="right" class="key">
        row07
      </td>
      <td>
          <input class="text_area" type="text" name="prix3" id="prix3" size="50" maxlength="50" value="<?php echo $this->row->row7;?>" />
      </td>
    </tr>

    </table>
    
    
    
    
    
    
  </fieldset>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="controller" value="maps" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>