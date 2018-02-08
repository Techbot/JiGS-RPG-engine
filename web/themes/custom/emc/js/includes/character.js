////////////////////////////////////////
// Joomla interactive Game System
////////////Set up the variables ///////////////////////////////


function shoot_character(character_id){
	var d = document.getElementById('shoot');
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=attack_character&type=shoot&character=" + character_id,
			onSuccess: function(result){
				
			//alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);
			alert(result[2] + ' me: ' + result[0] + '   Him: ' + result[1]);
			text_message = (result[2]);
						
			myElement = document.id('health');
			myElement2= document.id('health_value');

			myElement2.set('html', result[1]);	
			
			myElement3= document.id('magazine');

			myElement3.set('html', result[3]);
		
			if(result[1]<30){

			}
			else{
			myElement.setStyle('width', parseInt(result[1]));
			}
		
			var new_message = new Element('p',{
			'display':'table-row',
			'html': text_message });
		
			new_message.inject('message_table','top');
			
			
				if (result[0] <= 0 )  {
					close();
					jump();			
					}
				if (result[1] <= 0 ) {
					close();
					jump();
					}		
				}
			}).get();
	}

function kick_character(character_id){
	var d = document.getElementById('kick');
	
		var a = new Request.JSON({
			url: "index.php?option=com_battle&format=raw&task=action&action=attack_character&type=kick&character=" + character_id,
			onSuccess: function(result){
			
//	 alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);
//	alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);
			text_message = (result[2]);

//myElement = $('health');
	
	alert (text_message);
	
//	alert(result[1]['health']);
	
//myElement.setStyle('width', result[1][2]);
//myElement.innerhtml(result[1][2]);
			
			
			var new_message = new Element('p',{
			'display':'table-row',
			'html': text_message});
			
			
			new_message.inject('message_table','top');
				 


				if (result[0] <= 0 )  {
					close();
					jump();			
					}
				if (result[1] <= 0 ) {
					close();
					jump();
					}		
				}
			}).get();
		
}

function punch_character(character_id) {
	var d = document.getElementById('punch');
	var a = new Request.JSON({
		url: "index.php?option=com_battle&format=raw&task=action&action=attack_character&type=punch&character=" + character_id,
		onSuccess: function (result) {

			text_message = (result[2]);
			var new_message = new Element('p', {
				'display': 'table-row',
				'html': text_message
			});

			new_message.inject('message_table', 'top');

			npc_health = result[1];

			if (result[0] <= 0) {
				close();
				jump();
			}
			if (result[1] <= 0) {
				close();
				jump();
			}
		}
	}).get();
}

function talk_character(character_id) {
	var d = document.getElementById('talk');
	jQuery.ajax({
		url: "/index.php?option=com_battle&format=json&view=twine&id=" + 11103,
		context: document.body,
		dataType: "json"
	}).done(function (result) {

		document.getElementById("world").hide();
		document.getElementById("npc").hide();
		document.getElementById("twines").innerHTML = result;
		document.getElementById("twines").show();
	});



}
