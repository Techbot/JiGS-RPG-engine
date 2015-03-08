<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.calendar');
JHtml::_('behavior.formvalidation');

// Create shortcut to parameters.
$params = $this->state->get('params');
//$images = json_decode($this->item->images);
//$urls = json_decode($this->item->urls);

// This checks if the editor config options have ever been saved. If they haven't they will fall back to the original settings.
$editoroptions = isset($params->show_publishing_options);
if (!$editoroptions):
	$params->show_urls_images_frontend = '0';
endif;
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'article.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
			<?php echo $this->form->getField('articletext')->save(); ?>
			Joomla.submitform(task);
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<div class="edit item-page<?php echo $this->pageclass_sfx; ?> row-fluid">
	<?php if ($params->get('show_page_heading', 1)) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($params->get('page_heading')); ?> </h1>
	</div>
	<?php endif; ?>
	<form action="<?php echo JRoute::_('index.php?option=com_content&a_id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal">
		<fieldset>
			<legend><?php echo JText::_('JEDITOR'); ?></legend>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('title'); ?>
				<div class="controls"> <?php echo $this->form->getInput('title'); ?> </div>
			</div>
			<?php if (is_null($this->item->id)):?>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('alias'); ?>
				<div class="controls"><?php echo $this->form->getInput('alias'); ?> </div>
			</div>
			<?php endif; ?>
			<div class="formelm-buttons form-actions">
				<button class="btn btn-primary" type="button" onclick="Joomla.submitbutton('article.save')"> <?php echo JText::_('JSAVE') ?> </button>
				<button class="btn" type="button" onclick="Joomla.submitbutton('article.cancel')"> <?php echo JText::_('JCANCEL') ?> </button>
			</div>
			<div class="control-group"> <?php echo $this->form->getInput('articletext'); ?> </div>
		</fieldset>
		<?php if ($params->get('show_urls_images_frontend')  ): ?>
		<fieldset>
			<legend><?php echo JText::_('COM_CONTENT_IMAGES_AND_URLS'); ?></legend>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('image_intro', 'images'); ?>
				<div class="controls"><?php echo $this->form->getInput('image_intro', 'images'); ?> </div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('image_intro_alt', 'images'); ?>
				<div class="controls"><?php echo $this->form->getInput('image_intro_alt', 'images'); ?> </div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('image_intro_caption', 'images'); ?>
				<div class="controls"><?php echo $this->form->getInput('image_intro_caption', 'images'); ?> </div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('float_intro', 'images'); ?>
				<div class="controls"><?php echo $this->form->getInput('float_intro', 'images'); ?> </div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('image_fulltext', 'images'); ?>
				<div class="controls"><?php echo $this->form->getInput('image_fulltext', 'images'); ?> </div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('image_fulltext_alt', 'images'); ?>
				<div class="controls"><?php echo $this->form->getInput('image_fulltext_alt', 'images'); ?> </div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('image_fulltext_caption', 'images'); ?>
				<div class="controls"><?php echo $this->form->getInput('image_fulltext_caption', 'images'); ?> </div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('float_fulltext', 'images'); ?>
				<div class="controls"><?php echo $this->form->getInput('float_fulltext', 'images'); ?> </div>
			</div>
			<div  class="formelm control-group"> <?php echo $this->form->getLabel('urla', 'urls'); ?>
				<div class="controls"><?php echo $this->form->getInput('urla', 'urls'); ?> </div>
			</div>
			<div  class="formelm control-group"> <?php echo $this->form->getLabel('urlatext', 'urls'); ?>
				<div class="controls"><?php echo $this->form->getInput('urlatext', 'urls'); ?> </div>
			</div>
			<?php echo $this->form->getInput('targeta', 'urls'); ?>
			<div  class="formelm control-group"> <?php echo $this->form->getLabel('urlb', 'urls'); ?>
				<div class="controls"><?php echo $this->form->getInput('urlb', 'urls'); ?> </div>
			</div>
			<div  class="formelm control-group"> <?php echo $this->form->getLabel('urlbtext', 'urls'); ?>
				<div class="controls"><?php echo $this->form->getInput('urlbtext', 'urls'); ?> </div>
			</div>
			<?php echo $this->form->getInput('targetb', 'urls'); ?>
			<div  class="formelm control-group"> <?php echo $this->form->getLabel('urlc', 'urls'); ?>
				<div class="controls"><?php echo $this->form->getInput('urlc', 'urls'); ?> </div>
			</div>
			<div  class="formelm control-group"> <?php echo $this->form->getLabel('urlctext', 'urls'); ?>
				<div class="controls"><?php echo $this->form->getInput('urlctext', 'urls'); ?> </div>
			</div>
			<div class="control-group"> <?php echo $this->form->getInput('targetc', 'urls'); ?> </div>
		</fieldset>
		<?php endif; ?>
		<fieldset>
			<legend><?php echo JText::_('COM_CONTENT_PUBLISHING'); ?></legend>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('catid'); ?>
				<div class="controls">
					<?php if($this->params->get('enable_category', 0) == 1) : ?>
					<span class="category"> <?php echo $this->category_title; ?> </span>
					<?php else : ?>
					<?php echo $this->form->getInput('catid', null, $this->item->catid); ?>
					<?php endif;?>
				</div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('created_by_alias'); ?>
				<div class="controls"><?php echo $this->form->getInput('created_by_alias'); ?> </div>
			</div>
			<?php if ($this->item->params->get('access-change')): ?>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('state'); ?>
				<div class="controls"><?php echo $this->form->getInput('state'); ?> </div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('featured'); ?>
				<div class="controls"><?php echo $this->form->getInput('featured'); ?> </div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('publish_up'); ?>
				<div class="controls"><?php echo $this->form->getInput('publish_up'); ?> </div>
			</div>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('publish_down'); ?>
				<div class="controls"><?php echo $this->form->getInput('publish_down'); ?> </div>
			</div>
			<?php endif; ?>
			<div class="formelm control-group"> <?php echo $this->form->getLabel('access'); ?>
				<div class="controls"><?php echo $this->form->getInput('access'); ?> </div>
			</div>
			<?php if (is_null($this->item->id)):?>
			<div class="control-group">
				<div class="form-note controls">
					<p class="help-block"><?php echo JText::_('COM_CONTENT_ORDERING'); ?></p>
				</div>
			</div>
			<?php endif; ?>
		</fieldset>
		<fieldset>
			<legend><?php echo JText::_('JFIELD_LANGUAGE_LABEL'); ?></legend>
			<div class="formelm-area control-group"> <?php echo $this->form->getLabel('language'); ?>
				<div class="controls"><?php echo $this->form->getInput('language'); ?> </div>
			</div>
		</fieldset>
		<fieldset>
			<legend><?php echo JText::_('COM_CONTENT_METADATA'); ?></legend>
			<div class="formelm-area control-group"> <?php echo $this->form->getLabel('metadesc'); ?>
				<div class="controls"> <?php echo $this->form->getInput('metadesc'); ?> </div>
			</div>
			<div class="formelm-area control-group"> <?php echo $this->form->getLabel('metakey'); ?>
				<div class="controls"><?php echo $this->form->getInput('metakey'); ?> </div>
			</div>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
			<?php if($this->params->get('enable_category', 0) == 1) :?>
			<input type="hidden" name="jform[catid]" value="<?php echo $this->params->get('catid', 1);?>"/>
			<?php endif;?>
			<?php echo JHtml::_( 'form.token' ); ?>
			<div class="formelm-buttons form-actions">
				<button class="btn btn-primary" type="button" onclick="Joomla.submitbutton('article.save')"> <?php echo JText::_('JSAVE') ?> </button>
				<button class="btn" type="button" onclick="Joomla.submitbutton('article.cancel')"> <?php echo JText::_('JCANCEL') ?> </button>
			</div>
		</fieldset>
	</form>
</div>
