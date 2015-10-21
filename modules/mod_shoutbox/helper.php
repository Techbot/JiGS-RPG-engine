<?php
defined('_JEXEC') or die('Restricted access');

class modShoutboxHelper {

	function addShout($sbid, $name, $url, $text, $tag, $delshouts, $user_calc, $user_Control, &$params)
	{		
		header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
		header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" ); 
		header( "Cache-Control: no-cache, must-revalidate" ); 
		header( "Pragma: no-cache" );
		header( "Content-Type: text/html; charset=utf-8" );
		$user		=& JFactory::getUser();
		$userid = $user->get('id');

		if($userid > 0 && $params->get('url') == 3) {
			$url = "index.php?option=com_comprofiler&task=userProfile&user=".$userid;
		} elseif($userid > 0 && $params->get('url') == 2) {
			$url = "index.php?option=com_community&view=profile&userid=".$userid;
		} elseif($userid > 0 && $params->get('url') == 4) {
			$url = "index.php?option=com_kunena&func=profile&userid=".$userid;
		}
		
		if ($name != '' && $text != '' ) {
			($tag && $userid == 0) ? $name = '['.$name.']' : $name;
			modShoutboxHelper::jal_addData($sbid, $name, $url, $text, $delshouts, $user_calc, $user_Control, $params);
		}
		exit();
	}
	
	function delShout($id)
	{
		header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
		header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" ); 
		header( "Cache-Control: no-cache, must-revalidate" ); 
		header( "Pragma: no-cache" );
		header( "Content-Type: text/html; charset=utf-8" );
		
		$db = & JFactory::getDBO();
		$query = 'DELETE FROM #__shoutbox WHERE id='. (int) $id;
		$db->setQuery($query);
		if (!$db->query()) {
			JError::raiseError( 500, $db->stderr() );
			return false;
		}
	}
	
	function jal_addData($sbid, $name,$url,$text, $delshouts, $user_calc, $user_Control, &$params) {
		$mainframe = JFactory::getApplication();
		$user 		=& JFactory::getUser();
		
		if($user->get('guest') && !$params->get( 'post_guest' )) {
			return;
		}
		
		$session = & JFactory::getSession();
		if($session->get('shoutcaptcha') != 'ok' || md5($user_calc.$params->get( 'phrase' )) != $user_Control) {
			return;
		}
		
		if(intval($session->get('shoutboxtries')) > intval($params->get('captcha_tries'))) {
			return;
		}
		
		//filter some spam
		$url = ($url == "http://") ? "" : htmlspecialchars($url);
		if($params->get('url') == 0 && strlen($url) > 0) {
			return;
		}
		
		if($user->get('guest') && substr_count($text, 'http://') > intval($params->get('guest_urls'))) {
			return;
		}
		
		//Banned Words
		$bwords = $params->get( 'banned' );
		$bwords = preg_split('[, ]', $bwords);
		
		//Censored Words
		$censored = $params->get( 'censored' );
		$censored = preg_split('[, ]', $censored);
		
		$db = & JFactory::getDBO();
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$name = strip_tags($name);
		$name = substr(trim($name), 0,12);
		
		$text = strip_tags($text);
		$text = substr($text,0,500);
		
		$text = htmlspecialchars(trim($text));
		
		foreach($bwords as $badword) {
			if($badword && strpos(strtolower($text), strtolower($badword)) !== false) {
				return;
			} 
		}
		
		foreach($censored as $badword) {
			$text = preg_replace("/\b(".str_replace('\*', '\w*?', preg_quote($badword)).")\b/ie", "str_repeat('#', strlen('\\1'))", $text);
		}
		
		$name = (empty($name)) ? "Anonymous" : htmlspecialchars($name);
		
		
		
		$date =& JFactory::getDate(); 
		$time = $date->toUnix();
		
		
		$avatar = 0;
		if($params->get('avatar')) {
			$avatar = htmlspecialchars(modShoutboxHelper::getAvatar($user, $params->get('avatar'), $params->get('dav')));
		}
		
		$target = '';
		if (strpos($text, JURI::base())===false) $target=' target="_blank" rel="nofollow"';
		$text = preg_replace( "`(http|ftp)+(s)?:(//)((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a href=\"\\0\"$target>&laquo;link&raquo;</a>", $text);
		$text = preg_replace("`([-_a-z0-9]+(\.[-_a-z0-9]+)*@[-a-z0-9]+(\.[-a-z0-9]+)*\.[a-z]{2,6})`i","<a href=\"mailto:\\1\">&laquo;email&raquo;</a>", $text); 
		
		$mainframe->triggerEvent('onBBCode_RenderText', array (& $text) ); 
		$mainframe->triggerEvent('onSmiley_RenderText', array (& $text) );
		
		$query = 'INSERT INTO #__shoutbox' . ' (sbid,time,name,avatar,url,text,ip) VALUES ('.$db->quote( $sbid ).', "'.$time.'", '.$db->quote( $name ).', '.$db->quote( $avatar ).', '.$db->quote( $url ).', '.$db->quote( $text ).', '.$db->quote( $ip ).' )';
		$db->setQuery($query);
		if (!$db->query()) {
			JError::raiseError( 500, $db->stderr() );
			return false;
		}
		modShoutboxHelper::deleteOld($delshouts);
	} 
	
	function deleteOld($delshouts) {
		$db = & JFactory::getDBO();
		
		$query = 'SELECT * FROM #__shoutbox ORDER BY id DESC';
		$db->setQuery($query, $delshouts-1, 1);
		
		$row = $db->loadObject();
		if(!empty($row)) {
			$id = $row->id;
			$db->setQuery('DELETE FROM #__shoutbox WHERE id < '.$id);
			if (!$db->query()) {
				JError::raiseError( 500, $db->stderr() );
				return false;
			}
		}	
	}
	
	function getAvatar($user, $extension, $default_avatar) {
		$avatar = 0;
		if($user->get('id') == 0) {
			$avatar = (!empty($default_avatar)) ? $default_avatar : 0;
		} elseif($extension == 1) {
			require_once(JPATH_ADMINISTRATOR.'/components/com_rokbridge/helper.php' );
			$rokbridge = new RokBridgeHelper();
			$phpbb_db   = $rokbridge->phpbb_db;
			$query = "SELECT user_id, user_type, username, user_unread_privmsg, user_new_privmsg, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height, user_lastvisit, FROM_UNIXTIME(user_lastvisit,'%a %b %D %x %h:%i %p') AS LastVisit FROM #__users WHERE ". $rokbridge->getWhereClause($user->username)
			;
			$phpbb_db->setQuery($query);
			$fuser = $phpbb_db->loadObject();
			
			$avatar     = $rokbridge->getAvatar($fuser, 35,"",$default_avatar);
			$avatar = substr($avatar, strpos($avatar, '"')+1);
			$avatar = substr($avatar, 0, strpos($avatar, '"'));
		} elseif($extension == 2) {
			$jspath = JPATH_BASE.DS.'components/com_community';
			include_once($jspath.DS.'libraries/core.php');
			
			$user =& CFactory::getUser($user->get('id'));
			$avatar = $user->getThumbAvatar();
		} elseif($extension == 3) {
			$jspath = JPATH_ADMINISTRATOR.'/components/com_comprofiler';
			include_once($jspath.DS.'plugin.foundation.php');
			cbimport( 'cb.database' );
			
			$user =& CBuser::getInstance($user->get('id'));
			$avatar = $user->avatarFilePath( 1 );
			if(empty($avatar)) {
				$avatar = $default_avatar;
			}
		} elseif($extension == 4) {
			$ini = JFile::read(JPATH_ADMINISTRATOR.'/components/com_juser/config.ini');
			$juserparams = new JParameter($ini);
			$avatar_save_path =  $juserparams->get('general::avatars_dir');
			
			if(file_exists(JPATH_ROOT.DS.$avatar_save_path.DS.$user->get('username').'.jpg')){
				$avatar = JURI::root().str_replace('\\', '/',$avatar_save_path).'/'.$user->get('username').'.jpg';
			} else {
				$avatar = JURI::root().'/components/com_juser/images/default_avatar.png';
			}
		} elseif($extension == 5) {
			require_once(JPATH_BASE.DS.'components/com_kunena/class.kunena.php');
			$kunena_user = KunenaFactory::getUser($user->get('id'));
			$username = $kunena_user->getName();
			$avatar = $kunena_user->getAvatarURL();
		}
		return $avatar;
	}
	
	function getShouts($sbid, $shouts, &$params) {
		$mainframe = JFactory::getApplication();
		
		//Make the urls to get the shouts
		$uri =& JURI::getInstance();
		//addshouts
		$uri->delVar('mode');
		$param = $uri->getQuery(true);
		
		$user 		=& JFactory::getUser();
		$maydelete = $user->authorize('com_content', 'edit', 'content', 'all');
		
		$db =& JFactory::getDBO();
		$query = 'SELECT * FROM #__shoutbox WHERE sbid = '.$sbid.' ORDER BY id DESC';
		$db->setQuery( $query , 0 , $shouts);
		$rows = $db->loadObjectList();
		if (!$db->query()) {
			JError::raiseError( 500, $db->stderr() );
			return false;
		}
		if(!empty($rows)) {
			$i		= 0;
			$lastid = $rows[0]->id;
			$time = $rows[0]->time;
			$shouts	= array();
			foreach ( $rows as $row ) {
				$shouts[$i]->name = $row->name; 
				$shouts[$i]->text = $row->text;
				$shouts[$i]->url = $row->url;
				$shouts[$i]->url = (empty($shouts[$i]->url) && $shouts[$i]->url = "http://") ? $shouts[$i]->name : '<a href="'.$shouts[$i]->url.'">'.$shouts[$i]->name.'</a>';
				$shouts[$i]->id = $row->id;
				
				if($maydelete) {
					$query = array_merge($param, array('mode' => 'delshout', 'shoutid' => $shouts[$i]->id));
					$uri->setQuery($query);
					$delshout = $uri->toString();
					$shouts[$i]->text =  $shouts[$i]->text.' <a href="'.$delshout.'" title="Delete">x</a>';
				}
				$shouts[$i]->avatar = htmlspecialchars($row->avatar);
				$shouts[$i]->time = $row->time;
				$shouts[$i]->ip = $row->ip;
				$i++;
			}
			if($params->get('newshout')) {
				return array(array_reverse($shouts), $lastid, $time);
			} else {
				return array($shouts, $lastid, $time);
			}
		}
	}
	
	function getType()
	{
		$user = & JFactory::getUser();
	    return (!$user->get('guest')) ? 'user' : 'guest';
	}
	
	function time_since($original) {
	    // array of time period chunks
	    $chunks = array(
	        array(60 * 60 * 24 * 365 , JText::_( 'YEAR'), JText::_( 'YEARS')),
	        array(60 * 60 * 24 * 30 , JText::_( 'MONTH') , JText::_( 'MONTHS')),
	        array(60 * 60 * 24 * 7, JText::_( 'WEEK') , JText::_( 'WEEKS')),
	        array(60 * 60 * 24 , JText::_( 'DAY') , JText::_( 'DAYS')),
	        array(60 * 60 , JText::_( 'HOUR') , JText::_( 'HOURS')),
	        array(60 , JText::_( 'MINUTE') , JText::_( 'MINUTES')),
	    );
	    $original = $original - 10; // Shaves a second, eliminates a bug where $time and $original match.
		$date =& JFactory::getDate(); 
	    $today = $date->toUnix(); /* Current unix time  */
	    $since = $today - $original;

	    // $j saves performing the count function each time around the loop
	    for ($i = 0, $j = count($chunks); $i < $j; $i++) {

	        $seconds = $chunks[$i][0];
	        $name = $chunks[$i][1];
			$names = $chunks[$i][2];

	        // finding the biggest chunk (if the chunk fits, break)
	        if (($count = floor($since / $seconds)) != 0) {
	            break;
	        }
	    }

	    $print = ($count == 1) ? '1 '.$name : "$count {$names}";

	    if ($i + 1 < $j) {
	        // now getting the second item
	        $seconds2 = $chunks[$i + 1][0];
	        $name2 = $chunks[$i + 1][1];
			$names2 = $chunks[$i + 1][2];

	        // add second item if it's greater than 0
	        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
	            $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$names2}";
	        }
	    }
	return $print;
	}	
}
