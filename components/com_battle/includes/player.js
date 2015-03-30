////////////////////////////////////////
// Joomla interactive Game System
////////////Set up the variables ///////////////////////////////

//var npc_health = 0;

function shoot_player(character_id){
    var d = document.getElementById('shoot');
        var a = new Request.JSON({
            url: "index.php?option=com_battle&format=raw&task=action&action=attack_player&type=shoot&character=" + character_id,
            onSuccess: function(result){
            //	alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);

            text_message = (result[2]);

            var new_message = new Element('p',{
            'display':'table-row',
            'html': text_message });


            new_message.inject('message_table','top');


            if (result[0].health <= 0 )  {
                    close();
                    jump();
                    }
                if (result[1].health <= 0 ) {
                    close();
                    jump();
                    }
                }
            }).get();
    }

function kick_player(character_id){
    var d = document.getElementById('kick');

        var a = new Request.JSON({
            url: "index.php?option=com_battle&format=raw&task=action&action=attack_player&type=kick&character=" + character_id,
            onSuccess: function(result){

            text_message = (result[2]);

            myElement = document.id('health');


            myElement.set('html', result[1]);
            if(result[1]['health']<30){

            }
            else{
            myElement.setStyle('width', result[1]);
            }

            var new_message = new Element('p',{
            'display':'table-row',
            'html': text_message});
            new_message.inject('message_table','top');
                if (result[0].health <= 0 )  {
                    close();
                    jump();
                    }
                if (result[1].health <= 0 ) {
                    close();
                    jump();
                    }
                }
            }).get();
}

        function punch_player(character_id)
        {
    
                var d = document.getElementById('punch');
                var a = new Request.JSON({
            url: "index.php?option=com_battle&format=raw&task=action&action=attack_player&type=punch&character=" + character_id,
            onSuccess: function(result){

            text_message = (result[2]);
            var new_message = new Element('p',{
            'display':'table-row',
            'html': text_message });

            new_message.inject('message_table','top');

                 npc_health = result[1].health;

                if (result[0].health <= 0 )  {
                    close();
                    jump();
                    }
                if (result[1].health <= 0 ) {
                    close();
                    jump();
                    }
                }
            }).get();
}
