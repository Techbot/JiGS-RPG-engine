<?php
/**
 * @package		Joomla
 * @subpackage	Templates / basic skeleton template
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
     / \
    /   \
   /  0  \
  /       \
 /   \_/   \
/___________\
www.emc23.com
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
include_once("includes/template_config.php");
$url = clone(JURI::getInstance());
$user =& JFactory::getUser();
$app = Jfactory::getApplication();
$doc			= JFactory::getDocument();
$menutype	= $this->params->get('menutype');
$templateparams	= $app->getTemplate(true)->params;
?>

<?php echo '<?xml version="1.0" encoding="utf-8"?' .'>'; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <jdoc:include type="head" />

  <!-- stops internally-linked content loading in iframes -->
  <script type="text/javascript">
    <!--
    if (top.location!= self.location) {
      top.location = self.location.href
    }
    -->
  </script>
  <script id="loadarea_0" type="text/javascript"></script>
  <script id="loadarea_1" type="text/javascript"></script>

  <!-- Bootstrap core -->
  <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap theme -->
  <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap-theme.min.css" rel="stylesheet">

  <!-- EMC23 template -->
  <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/emc_styles.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/emc_styles-fixed.css" rel="stylesheet" type="text/css" media="screen" />

  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Le fav and touch icons -->
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="128x128" href="/fnord_128x128.png">
  <link rel="apple-touch-icon-precomposed" sizes="48x48" href="/fnord_48x48.png">
  <link rel="apple-touch-icon-precomposed" sizes="32x32" href="/fnord_32x32.png">
  <link rel="apple-touch-icon-precomposed" href="/fnord_128x128.png">

  <script type="text/javascript" src="<?php echo $this->baseurl ?>/media/system/js/modal.js"></script>
  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/media/system/css/modal.css" type="text/css" />

  <!-- ATTN this should be in component -->
  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.css" type="text/css" media="screen" />

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <script src="/components/com_battle/includes/jigs.js"></script>


  <script>
    // Find the right method, call on correct element
    function launchFullscreen(element) {
      if(element.requestFullscreen) {
        element.requestFullscreen();
      } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
      } else if(element.webkitRequestFullscreen) {
        element.webkitRequestFullscreen();
      } else if(element.msRequestFullscreen) {
        element.msRequestFullscreen();
      }
    }
    function exitFullscreen() {
      if(document.exitFullscreen) {
        document.exitFullscreen();
      } else if(document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if(document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      }
    }
    function dumpFullscreen() {
      console.log("document.fullscreenElement is: ", document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement);
      console.log("document.fullscreenEnabled is: ", document.fullscreenEnabled || document.mozFullScreenEnabled || document.webkitFullscreenEnabled || document.msFullscreenEnabled);
    }
    // Events
    document.addEventListener("fullscreenchange", function(e) {
      console.log("fullscreenchange event! ", e);
    });
    document.addEventListener("mozfullscreenchange", function(e) {
      console.log("mozfullscreenchange event! ", e);
    });
    document.addEventListener("webkitfullscreenchange", function(e) {
      console.log("webkitfullscreenchange event! ", e);
    });
    document.addEventListener("msfullscreenchange", function(e) {
      console.log("msfullscreenchange event! ", e);
    });
    // Add different events for fullscreen
  </script>


</head>

<!-- If user is not logged in -->

<body id="<?php echo $style ;?>" class="<?php if($user->id==0): ?>guest<?php endif; ?>">


<i onclick="launchFullscreen(document.documentElement);" class="fa fa-arrows-alt" title="Enable Fullscreen"></i>
<i onclick="exitFullscreen();" class="fa fa-compress" title="Exit Fullscreen"></i>

<?php if ($this->countModules('emc23-shelf-nav or emc23-search')) : ?>
  <div id="shelf" class="container-fluid">
    <?php if ($this->countModules('emc23-shelf-nav')) : ?><!--horizontal nav-->
    <div id="shelf-nav">
      <jdoc:include type="modules" name="emc23-shelf-nav" style="none" />
    </div><!-- end nav -->
    <?php endif; ?>

    <?php if ($this->countModules('emc23-search')) : ?><!-- search -->
    <div id="search">
      <jdoc:include type="modules" name="emc23-search" style="none" />
    </div><!-- end search -->
  <?php endif; ?>

  </div><!-- end shelf -->
<?php endif; ?>


<div id="wrapper" class="container-fluid">

  <div id="header" class="row"><!--header-->

    <div id="logo">
      <a href="<?php echo $this->baseurl ?>/index.php" title="<?php echo $app->getCfg('sitename');?> Home"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo.png" border="0" alt="<?php echo $app->getCfg('sitename');?> Logo" /></a>

      <div id="sitetitle">
        <a href="<?php echo $this->baseurl ?>/index.php" title="<?php echo $app->getCfg('sitename');?> Home">
          <?php echo htmlspecialchars($templateparams->get('sitetitle'));?></a>
      </div>

      <div id="sitedescription">
        <?php echo htmlspecialchars($templateparams->get('sitedescription'));?>
      </div>

    </div><!-- end logo -->

    <?php if ($this->countModules('emc23-top-1 or emc23-top-2')) : ?>
      <div id="header-modules" class="col-md-8">

        <?php if ($this->countModules('emc23-top-1')) : ?><!--top-module-->
        <div id="top-module-1" class="col-md-<?php echo $headermodule_span ;?>">
          <div class="inside">
            <jdoc:include type="modules" name="emc23-top-1" style="xhtml" />
          </div><!-- end inside -->
        </div><!-- end top-module-1 -->
        <?php endif; ?>

        <?php if ($this->countModules('emc23-top-2')) : ?><!--top-module-->
        <div id="top-module-2" class="col-md-<?php echo $headermodule_span ;?>">
          <div class="inside">
            <jdoc:include type="modules" name="emc23-top-2" style="xhtml" />
          </div><!-- end inside -->
        </div><!-- end top-module-2 -->
      <?php endif; ?>


      </div><!-- end header-modules -->
    <?php endif; ?>

  </div><!-- end header -->


  <?php if ($this->countModules('emc23-topnav')) : ?><!--horizontal nav-->
  <div class="navbar-nav">
    <div class="navbar-inner">
      <a class="btn btn-default navbar-btn" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-collapse collapse">
        <!--<p class="navbar-text pull-right">
          Logged in as <a href="#" class="navbar-link">Username</a>
        </p>-->
        <jdoc:include type="modules" name="emc23-topnav" style="none" />
      </div><!--/.nav-collapse -->
    </div>
  </div><!-- end nav -->
  <?php endif; ?>


  <!--breadcrumbs - display on all pages except Front Page-->
  <?php if ($this->countModules('emc23-breadcrumbs')) :?>
    <div id="breadcrumbs" class="row">
      <jdoc:include type="modules" name="emc23-breadcrumbs" />
    </div><!-- end breadcrumbs -->
  <?php endif; ?>


  <!--top-modules-->
  <?php if ($this->countModules('emc23-position-1 or emc23-position-2 or emc23-position-3 or emc23-position-4')) : ?>
    <div id="top-modules" class="row">

      <?php if ($this->countModules('emc23-position-1')) { ?>
        <div class="teaser-1 col-md-<?php echo $topmodule_span ;?>">
          <div class="inside">
            <jdoc:include type="modules" name="emc23-position-1" style="xhtml" />
          </div><!-- end inside -->
        </div><!-- end teaser-1 -->
      <?php } ?>

      <?php if ($this->countModules('emc23-position-2')) : ?>
        <div class="teaser-2 col-md-<?php echo $topmodule_span ;?>">
          <div class="inside">
            <jdoc:include type="modules" name="emc23-position-2" style="xhtml" />
          </div><!-- end inside -->
        </div><!-- end teaser-2 -->
      <?php endif; ?>

      <?php if ($this->countModules('emc23-position-3')) : ?>
        <div class="teaser-3 col-md-<?php echo $topmodule_span ;?>">
          <div class="inside">
            <jdoc:include type="modules" name="emc23-position-3" style="xhtml" />
          </div><!-- end inside -->
        </div><!-- end teaser-3 -->
      <?php endif; ?>


      <?php if ($this->countModules('emc23-position-4')) : ?>
        <div class="teaser-4 col-md-<?php echo $topmodule_span ;?>">
          <div class="inside">
            <jdoc:include type="modules" name="emc23-position-4" style="xhtml" />
          </div><!-- end inside -->
        </div><!-- end teaser-4 -->
      <?php endif; ?>


    </div><!-- end top-modules -->
  <?php endif; ?>


  <!--Main Content Area-->
  <div id="BodyContent" class="row">
    <div id="LoadFirst" class="col-md-<?php echo $loadfirst_span ;?>">
      <div class="row">

        <div id="MiddleCol" class="col-md-<?php echo $middlecol_span ;?>">
          <div class="inside">

            <!--content-modules-->
            <?php if ($this->countModules('emc23-position-5 or emc23-position-6 or emc23-position-7 or emc23-position-8')) : ?>
              <div id="content-modules" class="row">

                <?php if ($this->countModules('emc23-position-5')) : ?>
                  <div class="teaser-1 col-md-<?php echo $contentmodule_span ;?>">
                    <div class="inside">
                      <jdoc:include type="modules" name="emc23-position-5" style="xhtml" />
                    </div><!-- end inside -->
                  </div><!-- end teaser-1 -->
                <?php endif; ?>

                <?php if ($this->countModules('emc23-position-6')) : ?>
                  <div class="teaser-2 col-md-<?php echo $contentmodule_span ;?>">
                    <div class="inside">
                      <jdoc:include type="modules" name="emc23-position-6" style="xhtml" />
                    </div><!-- end inside -->
                  </div><!-- end teaser-2 -->
                <?php endif; ?>

                <?php if ($this->countModules('emc23-position-7')) : ?>
                  <div class="teaser-3 col-md-<?php echo $contentmodule_span ;?>">
                    <div class="inside">
                      <jdoc:include type="modules" name="emc23-position-7" style="xhtml" />
                    </div><!-- end inside -->
                  </div><!-- end teaser-3 -->
                <?php endif; ?>


                <?php if ($this->countModules('emc23-position-8')) : ?>
                  <div class="teaser-4 col-md-<?php echo $contentmodule_span ;?>">
                    <div class="inside">
                      <jdoc:include type="modules" name="emc23-position-8" style="xhtml" />
                    </div><!-- end inside -->
                  </div><!-- end teaser-4 -->
                <?php endif; ?>

              </div><!-- end content-modules -->
            <?php endif; ?>


            <!--Main Content-->
            <div id="mainbody" class="row">
              <?php if(count(JFactory::getApplication()->getMessageQueue())):?>
                <div class="error">
                  <h2> Message </h2>
                  <jdoc:include type="message" />
                </div>
              <?php endif; ?>
              <jdoc:include type="component" />
            </div><!-- end mainbody -->



            <!--bottom-modules-->
            <?php if ($this->countModules('emc23-position-9 or emc23-position-10 or emc23-position-11 or emc23-position-12')) : ?>
              <div id="bottom-modules" class="row">

                <?php if ($this->countModules('emc23-position-9')) : ?>
                  <div class="teaser-1 col-md-<?php echo $bottommodule_span ;?>">
                    <div class="inside">
                      <jdoc:include type="modules" name="emc23-position-9" style="xhtml" />
                    </div><!-- end inside -->
                  </div><!-- end teaser-1 -->
                <?php endif; ?>

                <?php if ($this->countModules('emc23-position-10')) : ?>
                  <div class="teaser-2 col-md-<?php echo $bottommodule_span ;?>">
                    <div class="inside">
                      <jdoc:include type="modules" name="emc23-position-10" style="xhtml" />
                    </div><!-- end inside -->
                  </div><!-- end teaser-2 -->
                <?php endif; ?>

                <?php if ($this->countModules('emc23-position-11')) : ?>
                  <div class="teaser-3 col-md-<?php echo $bottommodule_span ;?>">
                    <div class="inside">
                      <jdoc:include type="modules" name="emc23-position-11" style="xhtml" />
                    </div><!-- end inside -->
                  </div><!-- end teaser-3 -->
                <?php endif; ?>

                <?php if ($this->countModules('emc23-position-12')) : ?>
                  <div class="teaser-4 col-md-<?php echo $bottommodule_span ;?>">
                    <div class="inside">
                      <jdoc:include type="modules" name="emc23-position-12" style="xhtml" />
                    </div><!-- end inside -->
                  </div><!-- end teaser-4 -->
                <?php endif; ?>

              </div><!-- end bottom-modules -->
            <?php endif; ?>


            <?php if ($this->countModules('messenger')) : ?>
              <jdoc:include type="modules" name="messenger" style="html" />
            <?php endif; ?>


          </div><!-- end inside -->
        </div><!-- end MiddleCol -->

        <!--Left Column-->
        <?php if($this->countModules('emc23-right') and JRequest::getCmd('layout') != 'form') : ?>
          <div id="sidebar" class="col-md-<?php echo $left_span ;?>">
            <div class="inside">
              <jdoc:include type="modules" name="emc23-right" style="xhtml" />
            </div><!-- end inside -->
          </div><!-- end sidebar-->
        <?php endif; ?>

      </div> <!-- end row -->
    </div><!-- end LoadFirst -->

    <!--Right Column-->

    <?php if ($this->countModules('emc23-menu or emc23-left or emc23-syndicate or emc23-rounded')) : ?>
      <div id="sidebar-2" class="col-md-<?php echo $right_span ;?>">
        <div class="inside">
          <?php if ($this->countModules('emc23-menu')) : ?>
            <jdoc:include type="modules" name="emc23-menu" style="xhtml" />
          <?php endif; ?>
          <?php if ($this->countModules('emc23-left')) : ?>
            <jdoc:include type="modules" name="emc23-left" style="xhtml" />
          <?php endif; ?>
          <?php if ($this->countModules('emc23-left-wide')) : ?>
            <jdoc:include type="modules" name="emc23-left-wide" style="xhtml" />
          <?php endif; ?>
          <?php if ($this->countModules('emc23-rounded')) : ?>
            <jdoc:include type="modules" name="emc23-rounded" style="rounded" />
          <?php endif; ?>
        </div><!-- end inside -->
      </div><!-- end sidebar-2-->
    <?php endif; ?>


  </div><!-- end BodyContent -->


  <!--footer-modules-->
  <?php if ($this->countModules('emc23-position-13 or emc23-position-14 or emc23-position-15 or emc23-position-16')) : ?>
    <div id="footer-modules" class="row">

      <?php if ($this->countModules('emc23-position-13')) : ?>
        <div class="teaser-1 col-md-<?php echo $footermodule_span ;?>">
          <div class="inside">
            <jdoc:include type="modules" name="emc23-position-13" style="xhtml" />
          </div><!-- end inside -->
        </div><!-- end teaser-1 -->
      <?php endif; ?>

      <?php if ($this->countModules('emc23-position-14')) : ?>
        <div class="teaser-2 col-md-<?php echo $footermodule_span ;?>">
          <div class="inside">
            <jdoc:include type="modules" name="emc23-position-14" style="xhtml" />
          </div><!-- end inside -->
        </div><!-- end teaser-2 -->
      <?php endif; ?>

      <?php if ($this->countModules('emc23-position-15')) : ?>
        <div class="teaser-3 col-md-<?php echo $footermodule_span ;?>">
          <div class="inside">
            <jdoc:include type="modules" name="emc23-position-15" style="xhtml" />
          </div><!-- end inside -->
        </div><!-- end teaser-3 -->
      <?php endif; ?>

      <?php if ($this->countModules('emc23-position-16')) : ?>
        <div class="teaser-4 col-md-<?php echo $footermodule_span ;?>">
          <div class="inside">
            <jdoc:include type="modules" name="emc23-position-16" style="xhtml" />
          </div><!-- end inside -->
        </div><!-- end teaser-4 -->
      <?php endif; ?>

    </div><!-- end footer-modules -->
  <?php endif; ?>



  <!--footer-->
  <?php if ($this->countModules('emc23-footer-nav or emc23-footer')) : ?>
    <div id="footer" class="row">
      <p class="pull-right"><a href="#">Back to top</a></p>


      <div class="inside">
        <?php if ($this->countModules('emc23-footer-nav')) : ?><!-- footer nav-->
        <div id="footer_nav" class="clearfix">
          <jdoc:include type="modules" name="emc23-footer-nav" style="none" />
        </div>
        <?php endif; ?>

        <?php if ($this->countModules('emc23-footer')) : ?>
          <jdoc:include type="modules" name="emc23-footer" style="none" />
        <?php endif; ?>
      </div><!-- end inside -->
    </div><!-- end footer -->
  <?php endif; ?>


</div><!-- end wrapper -->


<!--banner-->
<?php if ($this->countModules('emc23-banner')) : ?>
  <div id="banner" class="clearfix"><jdoc:include type="modules" name="emc23-banner" style="none" /></div>
<?php endif; ?>

<!--debug-->
<?php if ($this->countModules('debug')) : ?>
  <div id="debug"><jdoc:include type="modules" name="debug" /></div>
<?php endif; ?>



<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/bootstrap3/bootstrap.min.js"></script>


<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/emctempus.js"></script>

<script type="text/javascript">
  jQuery(document).ready(function() {
    $('.carousel').carousel({
      interval: 2000
    });
    // if login form is displayed - user not logged in
    if ( $( '#login-form .userdata' ).length > 0) {
      $("#jwts_a1").css({
        "display":"block",
        "height":"auto",
        "visibility":"visible"
      });
      $("#jwts_ac1").css("top",0);
    }
  });
</script>


</body>
</html>