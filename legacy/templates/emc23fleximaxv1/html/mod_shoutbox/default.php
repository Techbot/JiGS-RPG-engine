<?php if($ipaccess) : ?>
	<?php echo JText::_( 'NOIPACC'); ?>
<?php else : ?>
<script type="text/javascript">
	if (typeof(Shoutbox) !== 'undefined') {
		window.addEvent('domready', function() {
			var shoutbox = new Shoutbox({
				refresh: <?php echo $params->get("refresh", '4') * 1000 ?>,
				sound: <?php echo($params->get('sound', 1)==1 && $params->get('latestmessage', 1)==1 ?'true':'false'); ?>,
				captcha: <?php echo($params->get('captcha', 1)==1?'true':'false'); ?>,
				geturl: '<?php echo JURI::base() ?>modules/mod_shoutbox/getShouts.php',
				periods_singular: ['<?php echo JText::_( 'SECOND') ?>', '<?php echo JText::_( 'MINUTE') ?>', '<?php echo JText::_( 'HOUR') ?>', '<?php echo JText::_( 'DAY') ?>'],
				periods_plural: ['<?php echo JText::_( 'SECONDS') ?>', '<?php echo JText::_( 'MINUTES') ?>', '<?php echo JText::_( 'HOURS') ?>', '<?php echo JText::_( 'DAYS') ?>'],
				ago: '<?php echo JText::_( 'AGO') ?>',
				path: '<?php echo JURI::base() ?>modules/mod_shoutbox/',
				fade_from: '<?php echo $params->get("fadefrom"); ?>',
				fade_to: '<?php echo $params->get("fadeto"); ?>',
				addBottom: <?php echo($params->get('newshout', 1)==1?'true':'false'); ?>,
				latestMessage: <?php echo($params->get('latestmessage', 1)==1?'true':'false'); ?>,
				growShouts: <?php echo($params->get('ajaxshouts', 1)==1?'true':'false'); ?>,
				sbid: <?php echo $sbid ?>
			});
			<?php if(JPluginHelper::isEnabled('system', 'yvsmiley') && ($params->get('post_guest') || $loggedin != 'guest')) : ?>
			var mySlide = new Fx.Slide('sbsmile<?php echo $sbid ?>');
			mySlide.hide();	
			$('toggle<?php echo $sbid ?>').addEvent('click', function(e){
				e = new Event(e);
				mySlide.toggle();
				e.stop();
			});
			<?php endif; ?>
		});
	};
</script>
	
	<div id="shoutbox<?php echo $sbid ?>" class="shoutbox test">
		<div id="shoutboxtop<?php echo $sbid ?>" class="shoutboxtop">
		<?php if($params->get('latestmessage')) : ?>
			<?php echo $sound; ?>
			<div class="lastMessage"><span><?php echo JText::_( 'LAST_MESSAGE'); ?>:</span> <em id="responseTime<?php echo $sbid ?>" class="responseTime"><?php echo modShoutboxHelper::time_since($list[0]->time); ?> <?php echo JText::_( 'AGO'); ?></em></div>
			<?php endif; ?>
		<div id="chatoutput<?php echo $sbid ?>" class="chatoutput">
			<ul id="outputList<?php echo $sbid ?>" class="outputList">
			<?php if(!empty($list)) : ?>
				<?php foreach ($list as $item) : ?>
				<li>
					<?php if ($item->avatar != '0') : ?>
					<div class="avatar"><img src="<?php echo $item->avatar; ?>" width="35" height="35" alt="avatar" /></div>
					<?php endif; ?>
					<span title="<?php echo modShoutboxHelper::time_since($item->time); ?>"><?php echo $item->url; ?>: </span><?php echo $item->text; ?>
				</li>
			<?php endforeach; ?>
			<?php endif; ?>
			</ul>
		</div>
		</div>
		
		
		<!--<?php if(file_exists('components/com_shoutbox')) : ?>
			<?php $link = JRoute::_('index.php?option=com_shoutbox&view=category&sbid='.$sbid); ?>
			<a href="<?php echo $link; ?>"><?php echo JText::_( 'ARCHIVE'); ?></a>
		<?php endif; ?>-->
		
		
		
		<?php if ($params->get('tag')) : ?>
		<p><?php echo JText::_( 'GUESTTAG');?></p>
		<?php endif; ?>
		<?php if ($params->get('post_guest') || $loggedin != 'guest') : ?>
		<form id="chatForm<?php echo $sbid ?>" name="chatForm<?php echo $sbid ?>" class="chatForm" method="post" action="<?php echo JFilterOutput::ampReplace($addshout) ?>">
			<p>
				<?php $name = ($params->get("name")) ? $user->get('name') : $user->get('username'); ?>
				<?php if($loggedin != 'guest') :  /* If they are logged in, then print their nickname */ ?>
				<label><?php echo JText::_( 'NAME'); ?> <em><?php echo $name; ?></em></label>
				<input type="hidden" name="sbname<?php echo $sbid ?>" id="sbname<?php echo $sbid ?>" class="inputbox" value="<?php echo $name; ?>" />
				<?php else:  /* Otherwise allow the user to pick their own name */ ?>
				<label for="sbname<?php echo $sbid ?>"><?php echo JText::_( 'NAME'); ?></label>
				<input type="text" name="sbname<?php echo $sbid ?>" id="sbname<?php echo $sbid ?>" class="inputbox" value="<?php if (isset($_COOKIE['sb_username'.$sbid])) { echo $_COOKIE['sb_username'.$sbid]; } ?>" />
				<?php endif; ?>

				<?php if ($params->get('url') != 1) : ?>
				<span style="display: none">
				<?php endif; ?>
				<input type="text" name="sburl<?php echo $sbid ?>" id="sburl<?php echo $sbid ?>" class="inputbox" value="<?php if (isset($_COOKIE['sb_url'.$sbid])) { echo $_COOKIE['sb_url'.$sbid]; } else { echo 'http://'; } ?>" />	
				<label for="sburl<?php echo $sbid ?>">Url:</label>
				<?php if ($params->get('url') != 1) : ?>
				</span>
				<?php endif; ?>
				
				<label for="sbshout<?php echo $sbid ?>"><?php echo JText::_( 'MESSAGE'); ?></label>
				<?php
				$Form = '';
				$mainframe->triggerEvent('onBBCode_RenderForm', array('document.forms.chatForm'.$sbid.'.sbshout'.$sbid, &$Form) );
				echo $Form;
				?>
				<?php if ($params->get('textarea')) : ?>
				<textarea rows="4" cols="16" name="sbshout<?php echo $sbid ?>" id="sbshout<?php echo $sbid ?>" class="inputbox"></textarea>
				<?php else: ?>
				<input type="text" name="sbshout<?php echo $sbid ?>" id="sbshout<?php echo $sbid ?>" class="inputbox" />
				<?php endif; ?>
				<input type="text" name="homepage<?php echo $sbid ?>" id="homepage<?php echo $sbid ?>" class="homepage" />
			</p>
			<?php if(JPluginHelper::isEnabled('system', 'yvsmiley')): ?>
			<a id="toggle<?php echo $sbid ?>" href="#" name="toggle"><?php echo JText::_( 'SMILEYS'); ?></a>
			<?php 
			$smilies = '';
			$mainframe->triggerEvent('onSmiley_RenderForm', array('document.forms.chatForm'.$sbid.'.sbshout'.$sbid, &$smilies, 'sbsmile'.$sbid) );
			echo $smilies;
			?>
			<?php endif; ?>
			
			<?php if ($params->get('captcha') && $session->get('shoutcaptcha') != 'ok' && $loggedin == 'guest') : ?>
			<div id="shoutbox_captcha<?php echo $sbid ?>">
				<input type="hidden" name="shoutboxControl<?php echo $sbid ?>" id="shoutboxControl<?php echo $sbid ?>" value="<?php echo md5($total.$params->get( 'phrase', '')); ?>"/>
				<label><?php echo JText::_( 'CAPTCHA'); ?></label>
				<select name="shoutboxOp<?php echo $sbid ?>" id="shoutboxOp<?php echo $sbid ?>">
				<option value="-3"><?php echo $rand1."+".$rand2."="; ?></option>
				<?php for ($i = 0; $i < 21; $i++) {
				echo '<option value="'.$i.'">'.$i.'</option>';
				}
				?>
				</select>
			</div>
			<?php else: ?>
			<input type="hidden" name="shoutboxControl<?php echo $sbid ?>" id="shoutboxControl<?php echo $sbid ?>" value="<?php echo md5($total.$params->get( 'phrase', '')); ?>"/>
			<input type="hidden" name="shoutboxOp<?php echo $sbid ?>" id="shoutboxOp<?php echo $sbid ?>" value="<?php echo $total; ?>"/>
			<?php endif; ?>
			<input type="hidden" id="sblastid<?php echo $sbid ?>" value="<?php echo $lastid + 1; ?>" name="sblastid<?php echo $sbid ?>" />
			<input type="hidden" id="sbtime<?php echo $sbid ?>" value="<?php echo $time; ?>" name="sbtime<?php echo $sbid ?>" />
			<input type="hidden" id="sbservertime<?php echo $sbid ?>" value="<?php echo JFactory::getDate()->toUnix(); ?>" name="sbservertime<?php echo $sbid ?>" />
			<input type="submit" id="sbsubmit<?php echo $sbid ?>" name="sbsubmit<?php echo $sbid ?>" class="button" value="<?php echo JText::_( 'SEND'); ?>" />
		</form>
		<span id="sbsound<?php echo $sbid ?>"></span>
		<?php else: ?>
		<p><?php echo JText::_( 'REGISTER_ONLY'); ?></p>
		<form>
			<input type="hidden" id="sblastid<?php echo $sbid ?>" value="<?php echo $lastid + 1; ?>" name="sblastid<?php echo $sbid ?>" />
			<input type="hidden" id="sbtime<?php echo $sbid ?>" value="<?php echo $time; ?>" name="sbtime<?php echo $sbid ?>" />
			<input type="hidden" id="sbservertime<?php echo $sbid ?>" value="<?php echo JFactory::getDate()->toUnix(); ?>" name="sbservertime<?php echo $sbid ?>" />
		</form>
		<span id="sbsound<?php echo $sbid ?>"></span>
		<?php endif; ?>
	</div>
<?php endif; ?>