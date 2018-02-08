<?php
/**
 * @version		$Id: template_config.php WaseemSadiq $
 * @package		Joomla
 * @subpackage	Templates / basic skeleton template
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');

/* check if left or right modules are published */
// Set $right to "0"

	$right = "0";
	
// if $this->countModules function returns a number we set $right to "1"

	if ($this->countModules('emc23-right') and JRequest::getCmd('layout') != 'form') $right = "1";
	
// Set $left to "0" 
	$left = "0";

// if $this->countModules function returns a number we set $left to "1"

	if ($this->countModules('emc23-left or emc23-syndicate or emc23-rounded')) $left = "1";

/* Set style type based on column layout */
/* if there ARE modules published in the left module position AND there are NO modules published in the right module position
	then we want to return "-left-only" as our $style
*/
if (($left == "1") && ($right == "0")) {
										$style = "left-only";
										$loadfirst_span		= 12;
										$left_span		= 3;
										$middlecol_span	= 9;
										}

/* if there are NO modules published in the left module position AND there ARE modules published in the right module position
	then we want to return "-right-only" as our $style
*/
if (($left == "0") && ($right == "1")) {
										$style = "right-only";
										$loadfirst_span		= 9;										$middlecol_span	= 12;
										$right_span		= 3;
										}

/* if there are NO modules published in the left module position AND there are NO modules published in the right module position
	then we want to return "-wide" as our $style
*/
if (($left == "0") && ($right == "0")){
										$style = "wide";
										$loadfirst_span		= 12;
										$middlecol_span	= 12;
										}


/* if there ARE modules published in the left module position AND there ARE modules published in the right module position
	then we want to return "-both" as our $style
*/
if (($left == "1") && ($right == "1")) {
										$style = "both";
										$loadfirst_span		= 9;
										$left_span		= 3;
										$middlecol_span	= 9;
										$right_span		= 3;
										}

											
										
										
#--------------------------------------------------------------------------#
	
/* 
	Count the number of top header modules
	edit these lines to indicate which modules are in the top header block 
*/
$firstheadermodule = $this->countModules('emc23-top-1');
$secondheadermodule = $this->countModules('emc23-top-2');


#--------------------------------------------------------------------------#

$headermodule1 = ($firstheadermodule ? 1 : 0);
$headermodule2 = ($secondheadermodule ? 1 : 0);

$header_total = ($headermodule1 + $headermodule2);

// If we needed the width of each div rather than a number then we get that width like this: $width = (100 / $header_total).'%';

/* Bootstrap */
if ($header_total == "1") $headermodule_span = "12";
if ($header_total == "2") $headermodule_span = "6";





#--------------------------------------------------------------------------#




	
/* 
	Count the number of top teaser modules
	edit these lines to indicate which modules are in the top teaser block 
*/
$firsttopmodule = $this->countModules('emc23-position-1');
$secondtopmodule = $this->countModules('emc23-position-2');
$thirdtopmodule = $this->countModules('emc23-position-3');
$forthtopmodule = $this->countModules('emc23-position-4');
#--------------------------------------------------------------------------#

$topmodule1 = ($firsttopmodule ? 1 : 0);
$topmodule2 = ($secondtopmodule ? 1 : 0);
$topmodule3 = ($thirdtopmodule ? 1 : 0);
$topmodule4 = ($forthtopmodule ? 1 : 0);

$top_total = ($topmodule1 + $topmodule2 + $topmodule3 + $topmodule4);

// If we needed the width of each div rather than a number then we get that width like this: $width = (100 / $top_total).'%';

/* Bootstrap */
if ($top_total == "1") $topmodule_span = "12";
if ($top_total == "2") $topmodule_span = "6";
if ($top_total == "3") $topmodule_span = "4";
if ($top_total == "4") $topmodule_span = "3";




#--------------------------------------------------------------------------#

	
/* 
	Count the number of content teaser modules
	edit these lines to indicate which modules are in the top teaser block 
*/
$firstcontentmodule = $this->countModules('emc23-position-5');
$secondcontentmodule = $this->countModules('emc23-position-6');
$thirdcontentmodule = $this->countModules('emc23-position-7');
$fourthcontentmodule = $this->countModules('emc23-position-8');

#--------------------------------------------------------------------------#

$contentmodule1 = ($firstcontentmodule ? 1 : 0);
$contentmodule2 = ($secondcontentmodule ? 1 : 0);
$contentmodule3 = ($thirdcontentmodule ? 1 : 0);
$contentmodule4 = ($fourthcontentmodule ? 1 : 0);

$content_total = ($contentmodule1 + $contentmodule2 + $contentmodule3 + $contentmodule4);

// If we needed the width of each div rather than a number then we get that width like this: $width = (100 / $content_total).'%';


/* Bootstrap */
if ($content_total == "1") $contentmodule_span = "12";
if ($content_total == "2") $contentmodule_span = "6";
if ($content_total == "3") $contentmodule_span = "4";
if ($content_total == "4") $contentmodule_span = "3";



#--------------------------------------------------------------------------#

/*  
	Count the number of bottom teaser modules
	edit these lines to indicate which modules are in the bottom teaser block
*/
$firstbottommodule = $this->countModules('emc23-position-9');
$secondbottommodule = $this->countModules('emc23-position-10');
$thirdbottommodule = $this->countModules('emc23-position-11');
$fourthbottommodule = $this->countModules('emc23-position-12');

#--------------------------------------------------------------------------#

$bottommodule1 = ($firstbottommodule ? 1 : 0);
$bottommodule2 = ($secondbottommodule ? 1 : 0);
$bottommodule3 = ($thirdbottommodule ? 1 : 0);
$bottommodule4 = ($fourthbottommodule ? 1 : 0);

$bottom_total = ($bottommodule1 + $bottommodule2 + $bottommodule3 + $bottommodule4);

// If we needed the width of each div rather than a number then we get that width like this: $width = (100 / $bottom_total).'%';

/* Bootstrap */
if ($bottom_total == "1") $bottommodule_span = "12";
if ($bottom_total == "2") $bottommodule_span = "6";
if ($bottom_total == "3") $bottommodule_span = "4";
if ($bottom_total == "4") $bottommodule_span = "3";


#--------------------------------------------------------------------------#	


#--------------------------------------------------------------------------#
	
/* 
	Count the number of footer teaser modules
	edit these lines to indicate which modules are in the footer teaser block 
*/
$firstfootermodule = $this->countModules('emc23-position-13');
$secondfootermodule = $this->countModules('emc23-position-14');
$thirdfootermodule = $this->countModules('emc23-position-15');
$forthfootermodule = $this->countModules('emc23-position-16');
#--------------------------------------------------------------------------#

$footermodule1 = ($firstfootermodule ? 1 : 0);
$footermodule2 = ($secondfootermodule ? 1 : 0);
$footermodule3 = ($thirdfootermodule ? 1 : 0);
$footermodule4 = ($forthfootermodule ? 1 : 0);

$footer_total = ($footermodule1 + $footermodule2 + $footermodule3 + $footermodule4);

// If we needed the width of each div rather than a number then we get that width like this: $width = (100 / $footer_total).'%';

/* Bootstrap */
if ($footer_total == "1") $footermodule_span = "12";
if ($footer_total == "2") $footermodule_span = "6";
if ($footer_total == "3") $footermodule_span = "4";
if ($footer_total == "4") $footermodule_span = "3";

#--------------------------------------------------------------------------#



?>
