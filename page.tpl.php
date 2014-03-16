
<?php print render($page['header']); ?>
<!-- Content -->
<div class="decaWaveContent">
  
  <div class="featureWrap">
     <?php print render($page['feature']); ?>
  </div>

    <div class="wrapper">
      <aside>
       <?php print render($page['side_menu']); ?>
      </aside>
	
<!-- Content column -->
      <section class="rightColumn">
      <?php print render($page['highlighted']); ?>
      <!--<?php print $breadcrumb; ?>-->
     

      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="page__title title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
      </section>
      <span class="clear"></span>
    </div>

    
    <!--<?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second): ?>
      <aside>
        <?php print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      </aside>
    <?php endif; ?>-->


</div>

  <?php print render($page['postscript_first']); ?>

  <?php print render($page['footer']); ?>




