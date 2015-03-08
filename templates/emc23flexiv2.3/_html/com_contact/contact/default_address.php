<?php // @version $Id: default_address.php 12387 2009-06-30 01:17:44Z ian $
defined('_JEXEC') or die('Restricted access');
?>

<div class="contact_address">
  <!--open contact_address div -->
<?php

$show_address = (($this->contact->params->get('address_check') > 0) &&
		($this->contact->address || $this->contact->suburb || $this->contact->state || $this->contact->country || $this->contact->postcode)) ||
		(($this->contact->email_to && $this->contact->params->get('show_email')) || $this->contact->telephone || $this->contact->fax );

if ($show_address):
	echo '<address>';
endif;

if (($this->contact->params->get('address_check') > 0) && ($this->contact->address || $this->contact->suburb || $this->contact->state || $this->contact->country || $this->contact->postcode)) :
	if ( $this->contact->params->get('address_check') > 0) :
		if (( $this->contact->params->get('contact_icons') ==0) || ($this->contact->params->get('contact_icons') ==1)):
			echo '<span class="marker">'.$this->contact->params->get('marker_address').'</span> <br />';
		endif;
	endif;

	if ($this->contact->address && $this->contact->params->get('show_street_address')) :
		echo nl2br($this->escape($this->contact->address)).'<br />';
	endif;

	if ($this->contact->suburb && $this->contact->params->get('show_suburb')) :
		echo $this->escape($this->contact->suburb).'<br />';
	endif;

	if ($this->contact->state && $this->contact->params->get('show_state')) :
		echo $this->escape($this->contact->state).'<br />';
	endif;

	if ($this->contact->country && $this->contact->params->get('show_country')) :
		echo $this->escape($this->contact->country).'<br />';
	endif;

	if ($this->contact->postcode && $this->contact->params->get('show_postcode')) :
		echo $this->escape($this->contact->postcode).'<br />';
	endif;

endif;

if (($this->contact->email_to && $this->contact->params->get('show_email')) || $this->contact->telephone || $this->contact->fax ) :
	if ($this->contact->email_to && $this->contact->params->get('show_email')) :
		if (( $this->contact->params->get('contact_icons') ==0) || ( $this->contact->params->get('contact_icons') ==1)):
			echo '<span class="marker">'.$this->contact->params->get('marker_email').'</span>';
		endif;

		echo $this->contact->email_to.'<br />';
	endif;

	if ($this->contact->telephone && $this->contact->params->get('show_telephone')) :
		if (( $this->contact->params->get('contact_icons') ==0) || ( $this->contact->params->get('contact_icons') ==1)):
			echo '<span class="marker">'.$this->contact->params->get('marker_telephone').'</span>';
		endif;
		echo nl2br($this->escape($this->contact->telephone)).'<br />';
	endif;

	if ($this->contact->fax && $this->contact->params->get('show_fax')) :
		if (( $this->contact->params->get('contact_icons') ==0) || ( $this->contact->params->get('contact_icons') ==1)):
			echo '<span class="marker">'.$this->contact->params->get('marker_fax').'</span>';
		endif;
		echo nl2br($this->escape($this->contact->fax)).'<br />';
	endif;

	if ( $this->contact->mobile && $this->contact->params->get( 'show_mobile' ) ) :
		if (( $this->contact->params->get('contact_icons') ==0) || ( $this->contact->params->get('contact_icons') ==1)):
			echo '<span class="marker">'.$this->contact->params->get( 'marker_mobile' ).'</span>';
		endif;
		echo nl2br($this->escape($this->contact->mobile)).'<br />';
	endif;

	if ($this->contact->webpage && $this->contact->params->get('show_webpage')) :
		echo '<a href="'.$this->escape($this->contact->webpage).'" target="_blank"> '.$this->escape($this->contact->webpage).'</a><br />';
		echo '</address>';
	endif;
endif;

if ($show_address):
	echo '</address>';
endif; ?>

</div>
<!--close contact_address div -->


<?php if ($this->contact->misc && $this->contact->params->get('show_misc')) : ?>
<p>
  <?php if (( $this->contact->params->get('contact_icons') ==0) || ( $this->contact->params->get('contact_icons') ==1)): ?>
  <span class="marker"><?php echo $this->contact->params->get('marker_misc'); ?></span> 
  <?php endif; ?>
  <?php echo nl2br($this->contact->misc); ?>
</p>
<?php endif; ?>

