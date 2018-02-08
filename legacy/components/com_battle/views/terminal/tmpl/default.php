<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.methods' ); 
if ($this->player->id == 0){
    $this->player->username = 'Nobody';
}
?>
<a href="#" class="mid"></a>
    <div id="info" class=" clearfix">

    <div class="name"><?php //echo $this->player->username; ?> owns <?php //echo $this->buildings->name; ?>
        <span class="small">[Level 1]</span>
        <span class="red"><a href="#" title="Allocate stats points">-</a></span>
        <span class="small">
          <span class="highlight">3 Stats Pts</span>
          <span class="red"><a href="#" title="Allocate stats points">-</a></span>
        </span>
      </div>
<img id ="cyber1" class="cyber" src  = "/components/com_battle/images/terminal/002a.png">

    </div><!-- end info -->

?>
<script type="text/javascript">
    //var head = document.getElementsByTagName('head')[0] ;
    //var script = document.createElement('script');
    //script.type = "text/javascript";
    //script.src = '<?php echo $this->baseurl; ?>/components/com_battle/includes/character.js';
    //head.appendChild(script);
        var message         = [];
        var gameForm        =  ' Your Input:<input type="text" id="answer"> <input type ="button" id ="enter" onclick="yourMove()" value = "enter">';
        var stage           = 1;
        var number          = 1;
        var irc_complete    = false;
        var email_complete  = false;
        var ftp_complete    = false;
        var complete        = false;
        var attempts        = 9;
        var message         ={};
        var http_message;

    stuff();

    $$('.cyber').addEvent('click', function(){
        var itemID = this.get('id');
        var a = new Request.JSON({
            url:"index.php?option=com_battle&format=json&task=computer_action&action=display_terminal&id="+itemID,
            onSuccess: function(result){
                mything = new Element ('div',{'id':"term2",
                html:result,
                'style':'border 1px solid #F00; '});
                mything.replaces(document.id('mainbody'));
            }
        }).get();
    });
    function stuff()
        {
            var output          = document.getElementById("container");  // Get the content of the container element
            var input           = document.getElementById("input_form");// Get the content of the input_form element
            var http            = document.getElementById("http");// Get the content of the http element. This is where we show the percentage complete by displaying the ip address segments
            define_messages();
            output.innerHTML    = message[1];// The first message is displayed
            input.innerHTML     = gameForm;
         }  
        function yourMove()
        {
            output              = document.getElementById("container");  //Duplicated code. How would you suggest it be refactored?
            input               = document.getElementById("input_form");
            answer              = document.getElementById("answer").value;
            define_stages();
            define_messages();// messages needs to be redifined each time because one of the messages is dynamic. Can you think of a better way?
            // After each stage is configured print to screen ////
            output.innerHTML    = message[number];
            input.innerHTML     = gameForm;
            if (stage > 1)
            {
                http.innerHTML = completed();
            }
        } //End of yourMove function
 ////////////////////////////////////////////////////////////////
//     Additional function to display the % of goal(ip address) complete
////////////////////////////////////////////////////////////////
    function completed()
    {
        http_message = "http://46.";
        
        if (email_complete == true)
        {
            http_message = http_message + "19.";
        }
        else 
        {
            http_message = http_message + "__.";
        };
        if (irc_complete == true){
            http_message = http_message + "37.";
            }
        else 
        {
            http_message = http_message + "__.";
        };
        if (ftp_complete == true)
        {
            http_message = http_message + "66";
        }
        else 
        {
        http_message = http_message + "__";
        };
        return http_message;
    }





function define_stages(){
   
    ///////////////////////// Stage 0 /////////////////////////      
             if ( answer == "exit") 
            {
                number = 13;
                stage  = 2;
            }       
    ///////////////////////// Stage 1 /////////////////////////
           if (stage == 1  && answer == "no") 
            {
                number = 3;
                stage  = 2;
            }
            else if (stage == 1) 
            {
            number = 2;
            stage  = 1;
            }
    ///////////////////////// Stage 2 /////////////////////////
            if (stage == 2 && answer == "IRC") 
            {
                stage   = 3;
                number  = 4;
            }
            if (stage == 2 && answer == "email")
            {
                stage  = 3;
                number = 5;
            }
             if (stage == 2 && answer == "ftp") 
            {
                stage   = 3;
                number  = 6;
            }
    ///////////////////////// Stage 3 IRC /////////////////////

            if (stage == 3 && answer == "view source") 
            {
                stage   = 4;
                number  = 7;
                irc_complete = true;
            }
    ///////////////////////// Stage 3 email ///////////////////      
            if (stage == 3 && answer == "zxmbf2.gif")
            {
                stage  = 4;
                number = 8;
                email_complete = true;
            }
    ///////////////////////// Stage FTP ////////////////////////
            if (stage == 3 && answer == 66) 
            {
                stage   = 4;
                number  = 9;
                ftp_complete = true;
            }
            if (stage == 3 && answer > 66) // too low
            {
                stage   = 3;
                number  = 10;
                attempts =1;
            }
            if (stage == 3 && answer < 66) // too high
            {
                stage   = 3;
                number  = 11;
                attempts=1;
            }
            if (stage == 3 && attempts<0 ) // run out of attempts
                {
                   stage   = 1;
                   number  = 12;
                 //  attempts = 10;           
                   irc_complete = false;
                   email_complete = false;
                   ftp_complete = false;
                }
////////////////////////// Stage 4 ///////////////////////// 
            if  (irc_complete == true && email_complete == true && ftp_complete == true) 
            {
                stage   = 5;
                number  = 14;
                complete = true;
            }
/////////////////////////////////////////////////////////////

}







    function define_messages(){


//stage 1
message[1] = "<p>You are sitting in front of a computer. You are hiding code on the backs of other people's websites and servers, but when trying to access your code, you discover a virus that is being spread across the computers using a similar method. On the screen a cursor text blinks, and in the centre glows a skull and crossbones.</p><code>Do you know the password?<br><img src='skull.gif'><br></code></p>";

message[2] = "<code><p>That is not the password.</p><p>Do you know the password?</p></code>";

// stage 2
message[3] = "<p>Computer code scrolls down the screen. The light fills the message with a dull, green, swamp-like glow. Four more terminals jump into action. You are in. you'll need to trace the source of the virus.</p>You have friends who can help. You can call Jack the digital investigative reporter, Maeve the hacker,or Kate and David, the cyber-coders. Jack can only be contacted via IRC, Maeve is on email, and Kate and David can be contacted by FTP.";

// stage 3
message[4] = "<h2>You chose Jack digital investigative reporter.</h2><p> Jack tells dude to examine source code for proof.You should find a recurring index number. That will be the 3rd part of the ip address</p><img src='planet.jpg' width = 500px'>";

message[5] = "<h2>You choose Maeve the hacker.</h2><p>You will need to decrypt the Central Firewall System.To do this you will need the filename of the ascii backdoor (a secret entrance to the CFS built by Maeve years ago).</p><img src='zxmbf2.gif' width = '500px'>";

message[6] = "<h2>You choose  Kate and David, the cyber-coders.</h2><p>Kate and Dave can't break the code for you, but the can lend you their feedback algorithm. You have 5 attempts before the madelbrot virus programme auto starts and destroys everything.</p><img src='hoodies.jpg' width = '500px'> Enter a number between 1 and 255.";

/// stage 4

message[7] = "You view the source . From the reams of numbers you can see several numbers repeating. Too many in fact. But one number does seem to stand out. 37! That must be the one.<br>Congrats! Type Exit to break this connection and return to your terminal";

message[8] = "You enter the mage filename. Greetings evil Genius responds the terminal. It worked, the system thinks you are the dastardly devilish mind behind this devious plot. Do you want me to change the primary IP address as usual sir? Asks the computer? 'What is it today?', you ask in return. '19' The computer responds. 'OK then, no thanks, just leave it as it is for today', yo ucommand the computer.  </p> Congrats thats the third part solved. Type Exit to return to your terminal.";

message[9] = "You enter the correct number. Congrats thats the fourth part solved. Type Exit to return to your terminal.</p>";

message [10]= "Too high. You have one less attempt. You have " + attempts + " remaining."

message [11] = "Too low.  You have one less attempt.You have " + attempts + " remaining."

message [12] = "You've been hacked. The evil genius has discovered your attempts to thwart him, and unleashes his virus on YOUR computer. <img src='hacks_hacked_sites.png' width = '500px'>";

message [13] = "<p>You are sitting in front of your computer.</p><p>Who do you want to contact?</p><p>Type IRC/email/fpt to continue.</p><img src='growth.jpg' width = '500px'>";

message [14] = "<p>You have all the information required. Now go find the snipte before it's too late!!!!</p><img src='iin.jpg' width = '500px'>";
//


}









</script>	
