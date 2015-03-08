<?php // @version $Id: default_items.php 11917 2009-05-29 19:37:05Z ian $
defined('_JEXEC') or die('Restricted access');
?>

<?php foreach ($this->items as $item) : ?>
<tr>
	<td class="sectiontableentry" headers="Count">
		<?php echo (int)$item->count + 1; ?>
	</td>

	<?php if ($this->params->get('show_position')) : ?>
	<td headers="Position" class="sectiontableentry<?php echo $item->odd; ?>">
		<?php echo $this->escape($item->con_position); ?>
	</td>
	<?php endif; ?>

	<td height="20" class="sectiontableentry" headers="Name">
		<a href="<?php echo $item->link; ?>" class="category<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
			<?php echo $this->escape($item->name); ?></a>
	</td>

	<?php if ($this->params->get('show_email')) : ?>
	<td headers="Mail" class="sectiontableentry<?php echo $item->odd; ?>">
		<?php echo $item->email_to; ?>
	</td>
	<?php endif; ?>

	<?php if ($this->params->get('show_telephone')) : ?>
	<td headers="Phone" class="sectiontableentry">
		<?php echo $this->escape($item->telephone); ?>
	</td>
	<?php endif; ?>

	<?php if ($this->params->get('show_mobile')) : ?>
	<td headers="Mobile" class="sectiontableentry<?php echo $item->odd; ?>">
		<?php echo $this->escape($item->mobile); ?>
	</td>
	<?php endif; ?>

	<?php if ($this->params->get('show_fax')) : ?>
	<td headers="Fax" class="sectiontableentry">
		<?php echo $this->escape($item->fax); ?>
	</td>
	<?php endif; ?>
</tr>
<?php endforeach; ?>
