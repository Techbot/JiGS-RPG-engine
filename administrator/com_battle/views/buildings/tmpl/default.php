<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_weblinks
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_battle.category');
$saveOrder	= $listOrder == 'a.ordering';

JToolBarHelper::title( JText::_( 'Buildings' ), 'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::preferences('com_battle');
JToolBarHelper::editList();
JToolBarHelper::deleteList('Are you sure you want to delete building?');
JToolBarHelper::addNew();
$this->grid = JRequest::getVar('filter_grid', 1, '', 'int');
$this->type = JRequest::getVar('filter_type');
?>

<form action="<?php echo JRoute::_('index.php?option=com_battle&view=buildings'); ?>" method="get" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_WEBLINKS_SEARCH_IN_TITLE'); ?>" />
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
			
			</select>
			
			
			<select name="filter_published" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true);?>
			</select>

			<select name="filter_category_id" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('category.options', 'com_weblinks'), 'value', 'text', $this->state->get('filter.category_id'));?>
			</select>




            <select name="filter_type" class="inputbox" onchange="this.form.submit()">
				
				<option value=""  <?php if($this->type ==""){echo "selected ='TRUE'";}?>>SELECT Type</option>
				<option value="stand" <?php if($this->type =="stand"){echo "selected ='TRUE'";}?>>Stand</option>
				<option value="mine" <?php if($this->type =="mine"){echo "selected ='TRUE'";}?>>Mine</option>
				<option value="factory" <?php if($this->type =="factory"){echo "selected ='TRUE'";}?>>Factory</option>
				<option value="flat" <?php if($this->type =="flat"){echo "selected ='TRUE'";}?>>Flat</option>
				<option value="farm" <?php if($this->type =="farm"){echo "selected ='TRUE'";}?>>Farm</option>
				<option value="scrapyard" <?php if($this->type =="scrapyard"){echo "selected ='TRUE'";}?>>Scrapyard</option>
			
			
			</select>
			
			

			<select name="filter_language" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_LANGUAGE');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('contentlanguage.existing', true, true), 'value', 'text', $this->state->get('filter.language'));?>
			</select>
		</div>
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
          <th class="title" width="5%">xp</th>
      <th>comment</th>
        <th width="5%">grid</th>
        <th width="5%">map</th>      
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
       <td>
        <?php //echo $row->published; ?>
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
