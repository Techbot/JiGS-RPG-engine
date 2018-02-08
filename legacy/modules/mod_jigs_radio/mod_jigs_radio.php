<?php
/**

* @copyright	Copyright (C) 2010 EMC23.com . All rights reserved.

*/
// no direct access
defined('_JEXEC') or die('Restricted access');
 // require_once (dirname(__FILE__).DS.'helper.php');
$layout = $params->get('style','default');
$path = JModuleHelper::getLayoutPath('mod_jigs_radio', $layout);
if (file_exists($path))
	{
	require ($path);
	}
?>





<script type='text/javascript'>
	var source1;
	var source2;
    var context;
    var bufferLoader;
    var VolumeSample = {
    };

    // Gain node needs to be mutated by volume control.
    VolumeSample.gainNode = null;



	function BufferLoader(context, urlList, callback) {
		this.context = context;
		this.urlList = urlList;
		this.onload = callback;
		this.bufferList = new Array();
		this.loadCount = 0;
	}

	BufferLoader.prototype.loadBuffer = function(url, index) {
		// Load buffer asynchronously
		var request = new XMLHttpRequest();
		request.open("GET", url, true);
		request.responseType = "arraybuffer";
		var loader = this;
		request.onload = function() {
			// Asynchronously decode the audio file data in request.response
			loader.context.decodeAudioData(
				request.response,
				function(buffer) {
					if (!buffer) {
						alert('error decoding file data: ' + url);
						return;
					}
					loader.bufferList[index] = buffer;
					if (++loader.loadCount == loader.urlList.length)
						loader.onload(loader.bufferList);
				},
				function(error) {
					console.error('decodeAudioData error', error);
				}
			);
		}

		request.onerror = function() {
			alert('BufferLoader: XHR error');
		}

		request.send();
	}

	BufferLoader.prototype.load = function() {
		for (var i = 0; i < this.urlList.length; ++i)
			this.loadBuffer(this.urlList[i], i);
	}


    VolumeSample.play = function(bufferList) {
        if (!context.createGain)
            context.createGain = context.createGainNode;
        this.gainNode = context.createGain();
        //if (!source1)
        source1 = context.createBufferSource();
        //if (!source2)
        source2 = context.createBufferSource();

        if (!source1.buffer)
        source1.buffer = bufferList[0];
        if (! source2.buffer)
        source2.buffer = bufferList[1];
        //var source = context.createBufferSource();
        //source.buffer = BUFFERS.techno;
        // Connect source to a gain node
        source1.connect(this.gainNode);
        source2.connect(this.gainNode);

        // Connect gain node to destination
        this.gainNode.connect(context.destination);

        // Start playback in a loop
       // source1.loop = true;
        if (!source1.start)
            source1.start = source1.noteOn;
      //  source2.loop = true;
        if (!source2.start)
            source2.start = source2.noteOn;

        source1.start(0);
        source2.start(0);
        this.playing = 1;
        //	this.source = source1;
    };

    VolumeSample.changeVolume = function(element) {
     //   var volume = element.value;
        var fraction = parseInt(element.value) / parseInt(element.max);
        // Let's use an x*x curve (x-squared) since simple linear (x) does not
        // sound as good.
        this.gainNode.gain.value = fraction * fraction;
    };

    VolumeSample.stop = function() {
      //  if (!source1.stop)
     //       source1.stop = source1.noteOff;
     //   if (!source2.stop)
   //         source2.stop = source2.noteOff;


        //this.source.stop(0);
        source1.stop(0);
        source2.stop(0);
        this.playing =0;
    };

    VolumeSample.toggle = function() {
        this.playing ? this.stop() : this.play(bufferLoader.bufferList);
      //  this.playing = !this.playing;
      if (this.playing) {
        document.getElementById('emcradioPlay').value = 'Stop';
        var stopClass = document.getElementById('emcradioPlay');
        stopClass.className += " stop";
      } else {
        document.getElementById('emcradioPlay').value = 'Play';
      }

    };

    init();


function init() {

	// Fix up prefixing
	window.AudioContext = window.AudioContext || window.webkitAudioContext;
	context = new AudioContext();

	bufferLoader = new BufferLoader(
		context,
		[
			'/modules/mod_jigs_radio/061.wav',
			'/modules/mod_jigs_radio/MD2.wav',
		],
        VolumeSample.toggle
	);

	bufferLoader.load();

}


/*
function finishedLoading(bufferList) {
	// Create two sources and play them both together.
    source1.buffer = bufferList[0];
    source2.buffer = bufferList[1];
	//source1.connect(context.destination);
	//source2.connect(context.destination);
	//source1.start(0);
	//source2.start(0);
}
*/
		(function worker() {
			$.ajax({
				dataType:'text json',
				url: 'index.php?option=com_battle&format=raw&task=action&action=get_radio_stats',
				success: function(data) {


					data = $.parseJSON(data);



					$('.radio_stats').html(data);


					console.log(data);


				},
				complete: function(data) {
					console.log(data);


					// Schedule the next request when the current one's complete
					setTimeout(worker, 5000);
				}
			});
		})();
;
	/*
	 function finishedLoading(bufferList) {
	 // Create two sources and play them both together.
	 source1.buffer = bufferList[0];
	 source2.buffer = bufferList[1];
	 //source1.connect(context.destination);
	 //source2.connect(context.destination);
	 //source1.start(0);
	 //source2.start(0);
	 }
	 */

</script>

	

	
