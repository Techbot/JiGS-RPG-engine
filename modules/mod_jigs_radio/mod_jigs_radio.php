<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/

// no direct access

defined('_JEXEC') or die('Restricted access');

 // require_once (dirname(__FILE__).DS.'helper.php');

$layout = $params->get('style','default'); 

$path = JModuleHelper::getLayoutPath('mod_jigs_crystals', $layout);


if (file_exists($path))
	{
	require ($path);

	}
	
	?>
<script type='text/javascript'>

function request_crystals(){
	 var all = '';
	//	var details = this.details;
	var a = new Request.JSON({
    url: "index.php?option=com_battle&format=raw&task=action&action=get_crystals2", 
    onSuccess: function(result){
   for (i = 0; i < result.length; ++ i){
  var row = "<br>Crystal " + (i+1) + ":" + result[i].name  + " : " + result[i].quantity;
  all= all + row;  
    	}
    	$('crystal').innerHTML = all;	
    }	

    }).get();
}
 //   request_crystals();
//	request_crystals.periodical(95085);


alert('j');

window.onload = init;
var context;
var bufferLoader;

function init() {

	alert('hi');

	// Fix up prefixing
	window.AudioContext = window.AudioContext || window.webkitAudioContext;
	context = new AudioContext();

	bufferLoader = new BufferLoader(
		context,
		[
			'061.wav',
			'MD2.wav',
		],
		finishedLoading
	);

	bufferLoader.load();
}

function finishedLoading(bufferList) {
	// Create two sources and play them both together.
	var source1 = context.createBufferSource();
	var source2 = context.createBufferSource();
	source1.buffer = bufferList[0];
	source2.buffer = bufferList[1];


	alert ('yo');
	source1.connect(context.destination);
	source2.connect(context.destination);
	source1.start(0);
	source2.start(0);
}

</script>

	

	
