<?php
/**
* @version		$Id: slimbox.php 2008-02-01 AmyStephen $
* @package		Joomla!
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
* 
* Usage: 
* 
* Slimbox is a visual clone of the popular Lightbox JS v2.0 by Lokesh Dhakar, 
* written using the ultra compact mootools framework. It was designed to be small, 
* efficient, more convenient and 100% compatible with the original Lightbox v2. 
* From http://www.digitalia.be/software/slimbox
* Slimbox is free software released under MIT License. 
* http://www.opensource.org/licenses/mit-license.php
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport('joomla.event.plugin');

/**
* Plugin that loads module positions within contentz
*/




class plgContentSlimbox extends JPlugin
{
   /**
    * Constructor
    *
    * For php4 compatability we must not use the __constructor as a constructor for
    * plugins because func_get_args ( void ) returns a copy of all passed arguments
    * NOT references.  This causes problems with cross-referencing necessary for the
    * observer design pattern.
    */
  function plgContentSlimbox ( &$subject, $config )
{
		parent::__construct( $subject, $config );
}
    /**
    * Plugin method with the same name as the event will be called automatically.
    */
      
  //  print_r($regex);
	
    
    
    function onContentBeforeDisplay( $params,$row )
    {
 
 //print_r($row);
 //print_r($params);
 
    //exit();
    	
       // global $mainframe;
		$document = JFactory::getDocument();
		JHTML::_( 'behavior.mootools' );
 		
		//	Add CSS		
		$document->addStyleSheet( JURI::base() . 'plugins/content/slimbox/css/slimbox.css' );

		//	Add Javascript
		$document->addScript( JURI::base() .'plugins/content/slimbox/js/slimbox.js');

 		//	Find all plugin occurrences 
 		$firsttime = true;
 		$working = "";
 		$replacethis = "";
 		$withthis = "";
	 	$regex = '/{slimbox\s*.*?}/i';
		preg_match_all( $regex, $row->text, $matches );		
	 	$count = count( $matches[0] );
	 	
	 	// 	Perform once for each plugin occurrence
	 	for ( $i=0; $i < $count; $i++ ) {
 		
 			$firsttime = true;
 			
			$replacethis = $matches[0][$i];
			$working = $replacethis;
			$working = str_replace( '{slimbox', '', $working );
			$working = str_replace( '}', '', $working );
 			$working = trim($working);
 			
 			//	Display Single image or Gallery of images 
 			if (substr($working,0,6) == "single") {
 				$singleorGallery = "single";
				$working = substr($working,6,(strlen($working) - 6));
 				$working = trim($working);
 			} else {
 				$singleorGallery = "gallery";
 			}
 			
	 		if ($singleorGallery == "single") {
				$js = "";
				$js = "						
				function openGallery" . ($i + 1) . "() {
    				return Lightbox.open([";
			}
			
			$withthis = '';
			$withthis .= '<div id="slimbox'. ($i + 1) . '">';			
			$countimagesets = 0;	
			$imagesets = explode(";",$working);
			$countimagesets = count( $imagesets );

	 		for ( $j=0; $j < $countimagesets; $j++ ) {
				$thumbnail = '';
				$imagefile = '';
				$countpartsofimageset = 0;
				$singleimage = explode(",",$imagesets[$j]);
				$countpartsofimageset = count( $singleimage );
				$imagefile = trim($singleimage[0]);
				$thumbnail = trim($singleimage[1]);
				$caption = "";
				if ($countpartsofimageset == 3) {
					$caption = trim($singleimage[2]);					
				}
				if ($singleorGallery == "single") {
					if ($firsttime == true) {
						$withthis .= '<a href="#" onclick="return openGallery' . ($i + 1) . '()">' . '<img src="'. $thumbnail . '" border="0" /></a>';
					} else {
						$js .= ", ";
					}
					$js .= "['" . JURI::base() . $imagefile . "', '" . $caption . "']";	
				} else {
					$withthis .= '<a href="' . JURI::base() . $imagefile . '" class="slimbox" rel="lightbox[slimbox'. $i . ']" title="' . $caption .  '">';
					$withthis .= '<img src="'. $thumbnail . '" border="0" /></a>';			
				}
				$firsttime = false;	
			}
			
			if ($singleorGallery == "single") {
				$js .= "], 0);
				}";
				$document->addScriptDeclaration( $js ); 
	 		}
	 		$withthis .= '</div>';
	 		

	 		$row->text = str_replace( $replacethis, $withthis, $row->text );			
 		}
		return true;
	}
}
