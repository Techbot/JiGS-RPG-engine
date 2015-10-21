<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.categories');

// Include the syndicate functions only once
require_once( dirname(__FILE__).'/helper.php' );
$mainframe = JFactory::getApplication();

$sbid = JRequest::getVar( 'sbid',			'',			'get' ); 

if($sbid == '') {
	$categories = JCategories::getInstance('Shoutbox');
	$category = $categories->get($params->get('parent', 'root'));
	$sbid = $category->id;
}

if($sbid == 'root') {
	echo "Create a category first!";
} else {


$shouts 	= intval($params->get( 'shouts', 10 ));
$delshouts 	= intval($params->get( 'delshouts', 50 ));
$post_guest = $params->get( 'post_guest' );
$tag	 	= $params->get( 'tag' );
$soundopt	= $params->get( 'sound' );
$loggedin 	= modShoutboxHelper::getType();
$user 		=& JFactory::getUser();

//Make the urls to get the shouts
$uri =& JURI::getInstance();
//addshouts
$uri->delVar('mode');
$param = $uri->getQuery(true);
$query = array_merge($param, array('mode' => 'addshout', 'sbid' => $sbid));
$uri->setQuery($query);
$addshout = $uri->toString();
$uri->delVar('mode');

//Banned IP's
$ips = $params->get( 'ips' );
$iparr = explode('[,]', $ips);
$ipaccess = in_array($_SERVER['REMOTE_ADDR'], $iparr);

$name = JRequest::getVar( 'sbname'.$sbid,			'',			'post' ); 
$url  = JRequest::getVar( 'sburl'.$sbid,			'',			'post' );
$text = JRequest::getVar( 'sbshout'.$sbid,		'',			'post' );
$user_calc = JRequest::getVar( 'shoutboxOp'.$sbid,			'',			'post' );
//$user_calc=md5($user_calc.$params->get( 'phrase' )); 
$user_Control = JRequest::getVar( 'shoutboxControl'.$sbid,			'',			'post' );
$homepage = JRequest::getVar( 'h'.$sbid,			'',			'post' );
$shoutid = JRequest::getInt( 'shoutid',			'',			'get' ); 

$maydelete = $user->authorize('com_content', 'edit', 'content', 'all');

$sound = '';
$soundbool = false;
if($soundopt) {
	$img_sound = (isset($_COOKIE['sb_sound'.$sbid]) && $_COOKIE['sb_sound'.$sbid] == 0) ? "sound_0.gif" : "sound_1.gif";
	$sound = '<img src="modules/mod_shoutbox/images/'.$img_sound.'" alt="" id="sbsound_btn'.$sbid.'" class="sbsound_btn" title="'.JText::_('TOGGLESOUND').'" />';
	$soundbool = true;
}

$session = & JFactory::getSession();
if(md5($user_calc.$params->get( 'phrase' )) == $user_Control) {
	$session->set('shoutcaptcha', 'ok');
}

if(!empty($user_calc) && !empty($user_Control) && md5($user_calc.$params->get( 'phrase' )) != $user_Control) {
	if($session->get('shoutboxtries')) {
		$session->set('shoutboxtries', $session->get('shoutboxtries')+1);
	} else {
		$session->set('shoutboxtries', '1');
	}
}

$rand1=mt_rand(0,10);
$rand2=mt_rand(0,10);
$total=intval($rand1+$rand2);

$mode = JRequest::getCmd('mode');

if(!$ipaccess) {
	switch ($mode) {
	case 'addshout':
		if(empty($homepage)) {
			echo $sbid;
			modShoutboxHelper::addShout($sbid, $name, $url, $text, $tag, $delshouts, $user_calc, $user_Control, $params);
		}

		break;
	case 'delshout':
		if($maydelete) {
			modShoutboxHelper::delShout($shoutid);
		}
		break;
	}

	list($list, $lastid, $time) = modShoutboxHelper::getShouts($sbid, $shouts, $params);

}



//JHTML::_('behavior.mootools');
$module_base     = JURI::base() . 'modules/mod_shoutbox/';
$doc =& JFactory::getDocument();
$doc->addStyleSheet($module_base . 'css/mod_shoutbox.css');
$doc->addScript($module_base . 'js/shoutbox.js');

require(JModuleHelper::getLayoutPath('mod_shoutbox'));
}
?>