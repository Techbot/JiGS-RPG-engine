<?php
if(isset($_GET['sblastid']) && is_numeric($_GET['sblastid']) && isset($_GET['sbid']) && is_numeric($_GET['sbid'])) {
	header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" ); 
	header( "Cache-Control: no-cache, must-revalidate" ); 
	header( "Pragma: no-cache" );
	header( "Content-Type: text/html; charset=utf-8" );
	
	require_once('../../configuration.php');
	$conf = new JConfig();

	$conn = mysql_connect($conf->host, $conf->user, $conf->password) or die ('Error connecting to mysql');
	mysql_select_db($conf->db);
	
	//mysql_set_charset('utf8'); 
	mysql_query("SET NAMES 'UTF8'");
	
	$prefix = $conf->dbprefix;
	$shoutid = intval($_GET['sblastid'] + 1);
	$sbid = intval($_GET['sbid']);
	
	$query = sprintf("SELECT * FROM %sshoutbox WHERE sbid = %d AND id>=%d ORDER BY id ASC",
	    mysql_real_escape_string($prefix),
	    mysql_real_escape_string($sbid),
	    mysql_real_escape_string($shoutid));

	$result = mysql_query($query);
	
	$shouts = array();
	while ($row = mysql_fetch_assoc($result)) {
		$shout = array('id' => $row['id'], 'time' => stripslashes($row['time']), 'name' => stripslashes($row['name']), 'avatar' => stripslashes($row['avatar']), 'text' => stripslashes($row['text']), 'url' => stripslashes($row['url']));
	    $shouts[] = $shout;
	}
	
	if(!empty($shouts)) {
		if(!function_exists('json_encode')) {
			include_once('JSON.php');
			$json = new Services_JSON();
			echo $json->encode($shouts);
		} else {
	 		echo json_encode($shouts);
		}
	} else {
		echo '0';
	}
	mysql_free_result($result);
	mysql_close($conn);
}
?>