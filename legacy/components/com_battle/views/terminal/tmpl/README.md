
template010
===========
simple text adventure game in javascript.


 No proper loop or game engine. A simple text input element a submit button and text that is chosen from a single array.

with full CSS by [left23]

http://kata.coderdojo.com/wiki/The_basics_of_a_javascript_adventure_game

 This template is part of a the Dojogame resources . 
 For more info see: http://kata.coderdojo.com/wiki/dojogame
 For more information on the Coderdojo movement see : http://coderdojo.com 

 http://techbot.github.io 2013


index.php
<html>
    <head>
    <!-- script type="text/javascript"-->
    
    var message = [];
    var gameForm = ' Your Input:<input type="text" id="answer"> <input type ="button" id ="enter" onclick="yourMove()" value = "enter">';
    var stage = 1;
    var number = 1;
        
    function stuff(){

    //stage 1
    message[1] = "Do you want to play a game?";
    //stage 2
    message[2] = " You are sitting in front of a computer On the screen a cursor blinks: 'Do you know tha password?' glows in the centre beneath a skull and crossbones";
    message[3] = "That is not the password - Do you know tha password?";
    
    //stage 3
    message[4] = " <p>Computer code scrolls down the screen the light fills the message with a dull green swamplike glow. Four more terminals jump into action. You are in. </p> <p>You will need help. You can call Jack and Maeve ,the hackers or Kate and David the cyper-coders. Jack can only be contacted via irc and will take a few hours. He's less likely to be detected but could take hours. </p><p>Kate specialises in encryption but she is ore likely to be watchged by the enemy.</p> <p> Type IRC or email to continue.</p> ";
    
    //stage4
  
    message[5] = "You chose the hackers. You will need to access the mainframe, by creating a madelbrot virus programe.";
    message[6] = "You choose the coders. You will ned to decript the Central Firewall System.";
    
// Setup everything and write the first message

    var respond = document.getElementById("container");
    var input = document.getElementById("input_form");
    respond.innerHTML = message[1];
    input.innerHTML = gameForm;
    
}

// This might be considered the engine of the game, it reads the context of the tex element and depeding on the 'stage' of the game, it writes the correct response to the div. Amore sophisticated engine for this text input  might be made alongside a sweries of other "state machines".


    function yourMove()
    {
    
        respond = document.getElementById("container");
        input = document.getElementById("input_form");
        answer = document.getElementById("answer").value;

///////////////////////////////////////////////

        if (stage == 1 && answer == "yes")
        {
            number = 2;
            stage = 2 ;
            
        }
        else if( stage=="no"){
        
            number = 3;
        
        }
//////////////////////////////////////////////////
       if (stage == 2 && answer == "no")
       {
            number = 4;
            stage = 4;
            
        }

        if (stage == 4 && answer == "IRC")
      {
            stage = 5;
            number = 5;
  
      }
      
      if (stage == 4 && answer == "email")
      {
            stage = 5;
            number = 6;
       }
   
     respond.innerHTML = message[number];
     input.innerHTML= gameForm;
    }
  
    </script>
 
    </head>
    <body onload = "stuff()">

        <div id = "container" style = "border : red 1px solid;
                                       width : 598px;
                                       margin: 0 auto;
                                      ">
                                   
        </div>
        <div id = "input_form" style = "border : blue 1px solid;
width : 598px;
margin: 0 auto;
"> </div>

    </body>
</html>
