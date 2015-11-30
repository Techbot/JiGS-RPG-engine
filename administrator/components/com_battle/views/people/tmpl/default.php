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
JToolBarHelper::title( JText::_( 'People' ), 'generic.png' );
JToolBarHelper::publishList();
JToolBarHelper::unpublishList();
JToolBarHelper::preferences('com_battle');
JToolBarHelper::editList();
JToolBarHelper::deleteList('Are you sure you want to delete reviews?');
JToolBarHelper::addNew();
$this->grid = JRequest::getVar('filter_grid', 1, '', 'int');
?>
<form action="index.php" method="post" name="adminForm">

        <div class="filter-search fltlft">
            <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
            <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_WEBLINKS_SEARCH_IN_TITLE'); ?>" />
            <button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
            <button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
        </div>
        GRID:<?php echo $this->grid; ?>
        <div class="filter-select fltrt"><br/>
            <select name="filter_grid" class="inputbox"  onchange="this.form.submit()">
                <option value=""  <?php if($this->grid ==""){echo "selected ='TRUE'";}?>>SELECT GRID</option>
                <option value="1" <?php if($this->grid ==1){echo "selected ='TRUE'";}?>>1</option>
                <option value="2" <?php if($this->grid ==2){echo "selected ='TRUE'";}?>>2</option>
                <option value="3" <?php if($this->grid ==3){echo "selected ='TRUE'";}?>>3</option>
                <option value="4" <?php if($this->grid ==4){echo "selected ='TRUE'";}?>>4</option>
                <option value="5" <?php if($this->grid ==5){echo "selected ='TRUE'";}?>>5</option>
                <option value="6" <?php if($this->grid ==6){echo "selected ='TRUE'";}?>>6</option>
                <option value="2" <?php if($this->grid ==7){echo "selected ='TRUE'";}?>>7</option>
                <option value="3" <?php if($this->grid ==8){echo "selected ='TRUE'";}?>>8</option>
                <option value="4" <?php if($this->grid ==9){echo "selected ='TRUE'";}?>>9</option>
                <option value="5" <?php if($this->grid ==10){echo "selected ='TRUE'";}?>>10</option>
                <option value="6" <?php if($this->grid ==11){echo "selected ='TRUE'";}?>>11</option>
            </select>
            <select name="filter_published" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
                <?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true);?>
            </select>
            <!--select name="filter_category_id" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
                <?php //echo JHtml::_('select.options', JHtml::_('category.options', 'com_weblinks'), 'value', 'text', $this->state->get('filter.category_id'));?>
            </select-->
            <select name="filter_access" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_ACCESS');?></option>
                <?php echo JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text', $this->state->get('filter.access'));?>
            </select>
            <select name="filter_language" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_LANGUAGE');?></option>
                <?php echo JHtml::_('select.options', JHtml::_('contentlanguage.existing', true, true), 'value', 'text', $this->state->get('filter.language'));?>
            </select>
        </div>

    <div class="clr"></div>
    <br/>
    <div>
        <table class="adminlist">
            <thead>
            <tr>
                <th width="20">
                    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->rows ); ?>);" />
                </th>
                <th class="title">Id</th>
                <th class="title">Image</th>
                <th class="title">Name</th>
                <th class="title">Gid</th>
                <th width="15%">Health</th>
                <th width="10%">Money</th>
                <!--th width="10%">Humour</th-->
                <th width="15%">Health</th>
                <th width="10%">Money</th>
                <th width="10%">Attack</th>
                <th width="10%">Defence</th>
                <th width="10%">Attacks</th>
                <th width="10%">Kills</th>
                <th width="10%">grid</th>
                <th width="10%">map</th>
                <th width="10%">x</th>
                <th width="10%">y</th>
                <th width="5%">published</th>
            </tr>
            </thead>
            <?php
            jimport('joomla.filter.output');
            $k = 0;
            for ($i=0, $n=count( $this->rows ); $i < $n; $i++) {
                $row = &$this->rows[$i];
                $checked = JHTML::_('grid.id', $i, $row->id);
                $published = JHTML::_('grid.published', $row, $i);
                $link = JFilterOutput::ampReplace('index.php?option=com_battle&controller=people&task=edit&cid[]=' . $row->id);
            ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td><?php echo $checked; ?></td>
                    <td><?php echo $row->id; ?></td>
                    <td><a href="<?php echo $link; ?>"><img src="<?php echo JURI::root(); ?>/components/com_battle/images/ennemis/<?php echo $row->avatar ?>"
                        height='50px' width='50px'></a>
                    </td>
                    <td><a href="<?php echo $link; ?>"><?php echo $row->name; ?></a></td>
                    <td><?php echo $row->gid; ?></td>
                    <td><?php echo $row->health; ?></td>
                    <td><?php echo $row->money; ?></td>
                    <!--td><?php //echo $row->humeur; ?></td-->
                    <td>     <?php echo $row->id_weapon; ?></td>
                    <td> <?php echo $row->money; ?></td>
                    <td>     <?php echo $row->attack; ?></td>
                    <td>     <?php echo $row->defence; ?></td>
                    <td>   <?php echo $row->nbr_attacks; ?></td>
                    <td>   <?php echo $row->nbr_kills; ?></td>
                    <td>   <?php echo $row->grid; ?></td>
                    <td>   <?php echo $row->map; ?></td>
                    <td>   <?php echo $row->posx; ?></td>
                    <td>   <?php echo $row->posy; ?></td>
                    <td>   <?php echo $published; ?></td>
                </tr>
                <?php $k = 1 - $k;
            }
            ?>
        </table>
     </div>
    <input type="hidden" name="controller" value="people" />
    <input type="hidden" name="option" value="com_battle" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
</form>
