<?php // @version $Id: default.php 11917 2009-05-29 19:37:05Z ian $
defined('_JEXEC') or die('Restricted access');
$cparams = JComponentHelper::getParams ('com_media');
?>

<?php if ($this->params->get('show_page_title',1)) : ?>
<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php echo $this->escape($this->params->get('page_title')); ?>
</h1>
<?php endif; ?>

<?php if ($this->params->def( 'show_comp_description', 1 ) || $this->params->get( 'image', -1 ) != -1) : ?>
<div class="contentdescription<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

	<?php if ($this->params->get( 'image', -1 ) != -1) : ?>
	<img src="<?php echo $this->baseurl . '/' . $this->escape($cparams->get('image_path')).'/'.$this->escape($this->params->get('image')); ?>" class="image_<?php echo $this->escape($this->params->get( 'image_align' )); ?>" />
	<?php endif; ?>

	<?php echo $this->params->get( 'comp_description' ); ?>

	<?php if ($this->params->get( 'image', -1 ) != -1) : ?>
	<div class="wrap_image">&nbsp;</div>
	<?php endif; ?>

</div>
<?php endif; ?>

<?php if ( count( $this->categories ) ) : ?>
<ul>
	<?php foreach ( $this->categories as $category ) : ?>
	<li>
		<a href="<?php echo $category->link; ?>" class="category">
			<?php echo $this->escape($category->title); ?></a>
		<?php if ( $this->params->get( 'show_cat_items' ) ) : ?>
		&nbsp;<span class="small">(<?php echo (int)$category->numlinks . ' ' . JText::_( 'items' ); ?>)</span>
		<?php endif; ?>
		<?php if ( $this->params->def( 'show_cat_description', 1 ) && $category->description) : ?>
		<br />
		<?php echo $category->description; ?>
		<?php endif; ?>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif;
