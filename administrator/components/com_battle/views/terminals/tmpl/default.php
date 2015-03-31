<?php

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

/*
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_battle.category');
$saveOrder	= $listOrder == 'a.ordering';
*/

JToolBarHelper::title( JText::_( 'Terminals' ), 'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::preferences('com_battle');
JToolBarHelper::editList();
JToolBarHelper::deleteList('Are you sure you want to delete terminal?');
JToolBarHelper::addNew();
$this->grid = JRequest::getVar('filter_grid', 1, '', 'int');
$this->type = JRequest::getVar('filter_type');
?>

<form action="<?php echo JRoute::_('index.php?option=com_battle&view=terminals'); ?>" method="get" name="adminForm" id="adminForm">
    <fieldset id="filter-bar">
        <div class="filter-search fltlft">
            <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
            <input type="text" name="filter_search" id="filter_search" value="<?php //echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_WEBLINKS_SEARCH_IN_TITLE'); ?>" />
            <button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
            <button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
        </div>

        GRID:<?php echo $this->grid; ?>Type:<?php echo $this->type; ?><div class="filter-select fltrt">

            <select name="filter_grid" class="inputbox"  onchange="this.form.submit()">
                <option value=""  <?php if($this->grid ==""){echo "selected ='TRUE'";}?>>SELECT GRID</option>
                <option value="1" <?php if($this->grid ==1){echo "selected ='TRUE'";}?>>1</option>
                <option value="2" <?php if($this->grid ==2){echo "selected ='TRUE'";}?>>2</option>
                <option value="3" <?php if($this->grid ==3){echo "selected ='TRUE'";}?>>3</option>
                <option value="4" <?php if($this->grid ==4){echo "selected ='TRUE'";}?>>4</option>
                <option value="5" <?php if($this->grid ==5){echo "selected ='TRUE'";}?>>5</option>
                <option value="6" <?php if($this->grid ==6){echo "selected ='TRUE'";}?>>6</option>
                <option value="7" <?php if($this->grid ==7){echo "selected ='TRUE'";}?>>7</option>
                <option value="8" <?php if($this->grid ==8){echo "selected ='TRUE'";}?>>8</option>
                <option value="9" <?php if($this->grid ==9){echo "selected ='TRUE'";}?>>9</option>
                <option value="10" <?php if($this->grid ==10){echo "selected ='TRUE'";}?>>10</option>
                <option value="11" <?php if($this->grid ==11){echo "selected ='TRUE'";}?>>11</option>
                <option value="12" <?php if($this->grid ==12){echo "selected ='TRUE'";}?>>12</option>
                <option value="13" <?php if($this->grid ==13){echo "selected ='TRUE'";}?>>13</option>
                <option value="14" <?php if($this->grid ==14){echo "selected ='TRUE'";}?>>14</option>
                <option value="15" <?php if($this->grid ==15){echo "selected ='TRUE'";}?>>15</option>
                <option value="16" <?php if($this->grid ==16){echo "selected ='TRUE'";}?>>16</option>
                <option value="17" <?php if($this->grid ==17){echo "selected ='TRUE'";}?>>17</option>
                <option value="18" <?php if($this->grid ==18){echo "selected ='TRUE'";}?>>18</option>
                <option value="19" <?php if($this->grid ==19){echo "selected ='TRUE'";}?>>19</option>
                <option value="20" <?php if($this->grid ==20){echo "selected ='TRUE'";}?>>20</option>
                <option value="21" <?php if($this->grid ==21){echo "selected ='TRUE'";}?>>21</option>
                <option value="22" <?php if($this->grid ==22){echo "selected ='TRUE'";}?>>22</option>
                <option value="23" <?php if($this->grid ==23){echo "selected ='TRUE'";}?>>23</option>
                <option value="24" <?php if($this->grid ==24){echo "selected ='TRUE'";}?>>24</option>
                <option value="25" <?php if($this->grid ==25){echo "selected ='TRUE'";}?>>25</option>
                <option value="26" <?php if($this->grid ==26){echo "selected ='TRUE'";}?>>26</option>
                <option value="27" <?php if($this->grid ==27){echo "selected ='TRUE'";}?>>27</option>
                <option value="28" <?php if($this->grid ==28){echo "selected ='TRUE'";}?>>28</option>
                <option value="29" <?php if($this->grid ==29){echo "selected ='TRUE'";}?>>29</option>
                <option value="30" <?php if($this->grid ==30){echo "selected ='TRUE'";}?>>30</option>
                <option value="31" <?php if($this->grid ==31){echo "selected ='TRUE'";}?>>31</option>
                <option value="32" <?php if($this->grid ==32){echo "selected ='TRUE'";}?>>32</option>
                <option value="33" <?php if($this->grid ==33){echo "selected ='TRUE'";}?>>33</option>
                <option value="34" <?php if($this->grid ==34){echo "selected ='TRUE'";}?>>34</option>
                <option value="35" <?php if($this->grid ==35){echo "selected ='TRUE'";}?>>35</option>
                <option value="36" <?php if($this->grid ==36){echo "selected ='TRUE'";}?>>36</option>
                <option value="37" <?php if($this->grid ==37){echo "selected ='TRUE'";}?>>37</option>
                <option value="38" <?php if($this->grid ==38){echo "selected ='TRUE'";}?>>38</option>
                <option value="39" <?php if($this->grid ==39){echo "selected ='TRUE'";}?>>39</option>



            </select>

            <select name="filter_published" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
                <?php //echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true);?>
            </select>


    </fieldset>
    <div class="clr"> </div>

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
	  <th class="title" width="5%">level</th>
      <th>comment</th>
	<th width="5%">grid</th>    
      <th width="5%">posx</th>
      <th width="5%">posy</th>
        <th width="5%">published</th>

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
	$link = JFilterOutput::ampReplace( 'index.php?option=com_battle&task=edit&controller=terminals&cid[]='. $row->id );
?>
    <tr class="<?php echo "$k"; ?>">
      <td>
	<?php echo $checked; ?>
      </td>
	    <td>
      <?php echo $row->id; ?>
      </td>   
	   <td>
    <a href="<?php echo $link; ?>"> <img src="/components/com_battle/images/buildings/miniatures/<?php echo $row->image ?>" height = '50px' width='50px' ></a>
      </td>
      <td>
	<a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
      </td>
	 <td>
      <?php echo $row->type; ?>
      </td>   
	 <td>
      <?php echo $row->level; ?>
      </td>        
      <td>
	<?php echo $row->comment; ?>
      </td>
       <td>
	<?php echo $row->grid; ?>
      </td> 
      <td>
	<?php echo $row->posx; ?>
      </td>
      <td>
	<?php echo $row->posy; ?>
      </td>

        <td>
            <?php echo $published; ?>
        </td>



    </tr>
<?php
	$k = 1 - $k;
}
?>
</table>
<input type="hidden" name="option" value="com_battle" />
<input type="hidden" name="controller" value="terminals" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>

