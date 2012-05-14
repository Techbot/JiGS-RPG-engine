<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');
$editor =& JFactory::getEditor();
if ($this->row->id)
{
	JToolBarHelper::title( JText::_( 'Edit Map Profile' ), 'addedit.png' );
}
else
{
	JToolBarHelper::title( JText::_( 'Add Map Profile' ), 'addedit.png' );
}
JToolBarHelper::save();
JToolBarHelper::apply();
if ($this->row->id)
{
	JToolBarHelper::cancel( 'cancel', 'Close' );
}
else
{
	JToolBarHelper::cancel();
}
// print_r($this->row);?>
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
<div style="
width:416px; 
height:416px;
margin: 0 auto; 
text-align:center;
background:#666;
position:relative;" 
>
<?php
	for ($y=0;  $y <= 7 ; $y++){
?>
<?php 
		$name='row'.$y;
		//  echo $name;
		$arr[$y] = explode(",",($this->row->$name)); 
		// 	print_r($arr[$x]);
		$x = 0;	 	
		foreach ($arr[$y] as $row){ ?>
	<!--each div is 52x52 (width/height plus padding and margin on both sides) so each div begins 52px after the preceeding. Total width of containing div is 52x8-->
<div class="grid" style="
<?php	if ($row==0) { ?>
		background-color:#000;
		<?php } elseif ($row>=1) { ?> 
		background-color:#fff
		;
	<?php }?>
display:inline; 
position:absolute; 
width:40px; 
height:40px; 
padding:5px;
margin:1px;
text-align:center;
top:<?php echo ($y*52)+0?>px; 
left: <?php echo $x*52?>px;
"> 
<?php echo $row ?></div>
<?php	
			$x= $x+1;
		}
	}
?>
<div style="clear:both;"></div>
</div>
