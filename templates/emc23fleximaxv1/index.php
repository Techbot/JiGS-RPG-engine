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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<jdoc:include type="head" />
<?php  JHTML::_('behavior.mootools'); ?>

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
  

<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" rel="stylesheet" type="text/css" media="screen" />	
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/theme.css" rel="stylesheet" type="text/css" media="screen" />
    
<?php if($this->direction == 'rtl') : ?><link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/rtl/layout_rtl.css" rel="stylesheet" type="text/css" /><?php endif; ?>

<!-- Menu Type -->
<?php if($templateparams->get('menutype')=='suckerfish'){ ?>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/suckerfish.css" rel="stylesheet" type="text/css" />
<?php }
else { ?>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/dropdown.css" rel="stylesheet" type="text/css" />
<?php } ?>
  
	<!--[if lte IE 6]>
	<style type="text/css"> img { behavior: url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/iepngfix.htc); }</style>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie_hacks.css" media="screen, projection" />
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/iehover.js"></script>
	<![endif]-->	
	<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie_7.css" media="screen, projection" />
	<![endif]-->
	<!--[if IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie_8.css" media="screen, projection" />
	<![endif]-->

	
    <!-- Le styles -->
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap.css" rel="stylesheet">
	<!--<style type="text/css">
      body {
        padding-top: 68px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>-->
	
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/custom_emc23.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
	
<script type="text/javascript" src="<?php echo $this->baseurl ?>/media/system/js/modal.js"></script>

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/media/system/css/modal.css" type="text/css" />

<!-- these should be in component -->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/jigs.css" type="text/css" media="screen" />
<!-- noob slide -->
<!--link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/_web.css" type="text/css" media="screen" /-->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/components/com_battle/includes/style.css" type="text/css" media="screen" />

<script type="text/javascript" src="<?php echo $this->baseurl ?>/components/com_battle/includes/_class.noobSlide.packed.js"></script>

<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/emctempus.js"></script>	
	

	
</head>

<body id="<?php echo $style ;?>">

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




<div id="header" class="row-fluid"><!--header-->
                   
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
	<div id="header-modules" class="span8">
	   
		<?php if ($this->countModules('emc23-top-1')) : ?><!--top-module-->
		<div id="top-module-1" class="span<?php echo $headermodule_span ;?>">
		<div class="inside">
		<jdoc:include type="modules" name="emc23-top-1" style="xhtml" />
		</div><!-- end inside -->
		</div><!-- end top-module-1 -->
		<?php endif; ?>     
		   
		<?php if ($this->countModules('emc23-top-2')) : ?><!--top-module-->
		<div id="top-module-2" class="span<?php echo $headermodule_span ;?>">
		<div class="inside">
		<jdoc:include type="modules" name="emc23-top-2" style="xhtml" />
		</div><!-- end inside -->
		</div><!-- end top-module-2 -->
		<?php endif; ?>
		

	</div><!-- end header-modules -->
	<?php endif; ?>
	           
 </div><!-- end header -->
          


            
<?php if ($this->countModules('emc23-topnav')) : ?><!--horizontal nav-->
   <div class="navbar">
      <div class="navbar-inner">
          	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
	  
 		  <div class="nav-collapse collapse">
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
<div id="breadcrumbs" class="row-fluid">
<jdoc:include type="modules" name="emc23-breadcrumbs" />
</div><!-- end breadcrumbs --> 
<?php endif; ?>


<!--top-modules-->
<?php if ($this->countModules('emc23-position-1 or emc23-position-2 or emc23-position-3 or emc23-position-4')) : ?>
<div id="top-modules" class="row-fluid">

	<?php if ($this->countModules('emc23-position-1')) { ?>
	<div class="teaser-1 span<?php echo $topmodule_span ;?>">
		<div class="inside">
			<jdoc:include type="modules" name="emc23-position-1" style="xhtml" />
		</div><!-- end inside -->
	</div><!-- end teaser-1 -->
	<?php } ?>

	<?php if ($this->countModules('emc23-position-2')) : ?>
	<div class="teaser-2 span<?php echo $topmodule_span ;?>">
		<div class="inside">
			<jdoc:include type="modules" name="emc23-position-2" style="xhtml" />
		</div><!-- end inside -->
	</div><!-- end teaser-2 -->
	<?php endif; ?>

	<?php if ($this->countModules('emc23-position-3')) : ?>
	<div class="teaser-3 span<?php echo $topmodule_span ;?>">
		<div class="inside">
			<jdoc:include type="modules" name="emc23-position-3" style="xhtml" />
		</div><!-- end inside -->
	</div><!-- end teaser-3 -->
	<?php endif; ?>    

	
	<?php if ($this->countModules('emc23-position-4')) : ?>
	<div class="teaser-4 span<?php echo $topmodule_span ;?>">
		<div class="inside">
			<jdoc:include type="modules" name="emc23-position-4" style="xhtml" />
		</div><!-- end inside -->
	</div><!-- end teaser-4 -->
	<?php endif; ?>


</div><!-- end top-modules -->
<?php endif; ?>

		
<!--Main Content Area-->
<div id="BodyContent" class="row-fluid">
	<div id="LoadFirst" class="span<?php echo $loadfirst_span ;?>">
		<div class="row-fluid">
	
		<div id="MiddleCol" class="span<?php echo $middlecol_span ;?>">
			<div class="inside">
			
				<!--content-modules-->
				<?php if ($this->countModules('emc23-position-5 or emc23-position-6 or emc23-position-7 or emc23-position-8')) : ?>
				<div id="content-modules" class="row-fluid">
					
					<?php if ($this->countModules('emc23-position-5')) : ?>
					<div class="teaser-1 span<?php echo $contentmodule_span ;?>">
						<div class="inside">
							<jdoc:include type="modules" name="emc23-position-5" style="xhtml" />
						</div><!-- end inside -->
					</div><!-- end teaser-1 -->
					<?php endif; ?>

					<?php if ($this->countModules('emc23-position-6')) : ?>
					<div class="teaser-2 span<?php echo $contentmodule_span ;?>">
						<div class="inside">
							<jdoc:include type="modules" name="emc23-position-6" style="xhtml" />
						</div><!-- end inside -->
					</div><!-- end teaser-2 -->
					<?php endif; ?>

					<?php if ($this->countModules('emc23-position-7')) : ?>
					<div class="teaser-3 span<?php echo $contentmodule_span ;?>">
						<div class="inside">
							<jdoc:include type="modules" name="emc23-position-7" style="xhtml" />
						</div><!-- end inside -->
					</div><!-- end teaser-3 -->
					<?php endif; ?>


					<?php if ($this->countModules('emc23-position-8')) : ?>
					<div class="teaser-4 span<?php echo $contentmodule_span ;?>">
						<div class="inside">
							<jdoc:include type="modules" name="emc23-position-8" style="xhtml" />
						</div><!-- end inside -->
					</div><!-- end teaser-4 -->
					<?php endif; ?>
		
				</div><!-- end content-modules -->
				<?php endif; ?>

				
				<!--Main Content-->		
				<div id="mainbody" class="row-fluid">
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
				<div id="bottom-modules" class="row-fluid">

					<?php if ($this->countModules('emc23-position-9')) : ?>
					<div class="teaser-1 span<?php echo $bottommodule_span ;?>">
						<div class="inside">
							<jdoc:include type="modules" name="emc23-position-9" style="xhtml" />
						</div><!-- end inside -->
					</div><!-- end teaser-1 -->
					<?php endif; ?>

					<?php if ($this->countModules('emc23-position-10')) : ?>
					<div class="teaser-2 span<?php echo $bottommodule_span ;?>">
						<div class="inside">
							<jdoc:include type="modules" name="emc23-position-10" style="xhtml" />
						</div><!-- end inside -->
					</div><!-- end teaser-2 -->
					<?php endif; ?>

					<?php if ($this->countModules('emc23-position-11')) : ?>
					<div class="teaser-3 span<?php echo $bottommodule_span ;?>">
						<div class="inside">
							<jdoc:include type="modules" name="emc23-position-11" style="xhtml" />
						</div><!-- end inside -->
					</div><!-- end teaser-3 -->
					<?php endif; ?>

					<?php if ($this->countModules('emc23-position-12')) : ?>
					<div class="teaser-4 span<?php echo $bottommodule_span ;?>">
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
		<?php if ($this->countModules('emc23-menu or emc23-left or emc23-syndicate or emc23-rounded')) : ?>
		<div id="sidebar" class="span<?php echo $left_span ;?>">
			<div class="inside">
				<?php if ($this->countModules('emc23-menu')) : ?>
					<jdoc:include type="modules" name="emc23-menu" style="xhtml" />
				<?php endif; ?>
				<?php if ($this->countModules('emc23-left')) : ?>
					<jdoc:include type="modules" name="emc23-left" style="xhtml" />
				<?php endif; ?>
				<?php if ($this->countModules('emc23-syndicate')) : ?>
					<jdoc:include type="modules" name="emc23-syndicate" style="xhtml" />
				<?php endif; ?>
				<?php if ($this->countModules('emc23-rounded')) : ?>
					<jdoc:include type="modules" name="emc23-rounded" style="rounded" />
				<?php endif; ?>
			</div><!-- end inside -->
		</div><!-- end sidebar-->
		<?php endif; ?>
		
	</div> <!-- end row -->		
	</div><!-- end LoadFirst -->
	
	<!--Right Column-->
	<?php if($this->countModules('emc23-right') and JRequest::getCmd('layout') != 'form') : ?>
	<div id="sidebar-2" class="span<?php echo $right_span ;?>">
		<div class="inside">
			<jdoc:include type="modules" name="emc23-right" style="xhtml" />
		</div><!-- end inside -->
	</div><!-- end sidebar-2-->
	<?php endif; ?>


</div><!-- end BodyContent -->


<!--footer-modules-->
<?php if ($this->countModules('emc23-position-13 or emc23-position-14 or emc23-position-15 or emc23-position-16')) : ?>
<div id="footer-modules" class="row-fluid"> 

	<?php if ($this->countModules('emc23-position-13')) : ?>
	<div class="teaser-1 span<?php echo $footermodule_span ;?>">
		<div class="inside">
			<jdoc:include type="modules" name="emc23-position-13" style="xhtml" />
		</div><!-- end inside -->
	</div><!-- end teaser-1 -->
	<?php endif; ?>

	<?php if ($this->countModules('emc23-position-14')) : ?>
	<div class="teaser-2 span<?php echo $footermodule_span ;?>">
		<div class="inside">
			<jdoc:include type="modules" name="emc23-position-14" style="xhtml" />
		</div><!-- end inside -->
	</div><!-- end teaser-2 -->
	<?php endif; ?>

	<?php if ($this->countModules('emc23-position-15')) : ?>
	<div class="teaser-3 span<?php echo $footermodule_span ;?>">
		<div class="inside">
			<jdoc:include type="modules" name="emc23-position-15" style="xhtml" />
		</div><!-- end inside -->
	</div><!-- end teaser-3 -->
	<?php endif; ?>

	<?php if ($this->countModules('emc23-position-16')) : ?>
	<div class="teaser-4 span<?php echo $footermodule_span ;?>">
		<div class="inside">
			<jdoc:include type="modules" name="emc23-position-16" style="xhtml" />
		</div><!-- end inside -->
	</div><!-- end teaser-4 -->
	<?php endif; ?>
		
</div><!-- end footer-modules -->
<?php endif; ?>



<!--footer-->				
<?php if ($this->countModules('emc23-footer-nav or emc23-footer')) : ?>
<div id="footer" class="row-fluid">
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
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery1.8.1.js"></script>
	<!--script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/bootstrap.js"></script-->


</body>
</html>