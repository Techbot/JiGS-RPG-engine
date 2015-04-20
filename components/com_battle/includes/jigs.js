////////////////////////////////////////
// Joomla interactive Game System
////////////Set up the variables ///////////////////////////////
var active = 1;
var PosX = '';
var PosY = '';
var grid = '';
var map = '';
var portal_array = new Array();
var to_x = new Array();
var to_y = new Array();
var to_map = new Array();
var to_grid = new Array();
var dir = new Array();
var from_x = new Array();
var from_y = new Array();
var from_map = new Array();
var from_grid = new Array();


document.onkeydown = check;
mycells = new Array(8);
cell = new Array(8);

for ( var i = 0; i < 8; i++)
{
    cell[i] = new Array(8);
    for ( var j = 0; j < 8; j++)
    {
        cell[i][j] = '';
    }
}

// Beginning of initialise process via json calls
window.addEvent('domready',function()
{




    var a = new Request.JSON({
        url : "index.php?option=com_battle&format=raw&task=action&action=get_player",
        onSuccess : function(result){
            PosX = result[0]['posx'];
            console.log(PosX);
            PosY = result[0]['posy'];
            console.log(PosY);
            grid = result[0]['grid'];
            map = result[0]['map'];
            pX = PosX * 50;
            pY = PosY * 50;
            // // Now we have player co-ordinates we can
            // // get the proper map cells
            var a = new Request.JSON({
                url : "index.php?option=com_battle&format=raw&task=action&action=get_cells&map=" + map,
                onSuccess : function(result) {
                    for (i = 0; i < 8; i++)
                    mycells[i] = new Array(8);
                    mycells[0] = result[0]['row0'].split(',');
                    mycells[1] = result[0]['row1'].split(',');
                    mycells[2] = result[0]['row2'].split(',');
                    mycells[3] = result[0]['row3'].split(',');
                    mycells[4] = result[0]['row4'].split(',');
                    mycells[5] = result[0]['row5'].split(',');
                    mycells[6] = result[0]['row6'].split(',');
                    mycells[7] = result[0]['row7'].split(',');
                    // Assign each cell from the
                    // json rows
                    for (y = 0; y <= 7; y++)
                    {
                        for (x = 0; x <= 7; x++)
                        {
                            cell[x][y] = mycells[y][x];
                        }
                    }
                    // Are there any portals?
                    // Loop through json object
                    // containing arrays.

                    var a = new Request.JSON({
                        url : "index.php?option=com_battle&format=raw&task=action&action=get_portals&map=" + map,
                        onSuccess : function(result)
                        {
                            portal_array = result;
                            for (i = 0; i <= portal_array.length-1; i++)
                            {
                                dir[i]			=       portal_array[i].direction;
                                from_x[i]		=		portal_array[i].from_x;
                                from_y[i]		=		portal_array[i].from_y;
                                from_map[i]		=		portal_array[i].from_map;
                                from_grid[i]	=		portal_array[i].from_grid;
                                to_x[i]			=		portal_array[i].to_x;
                                to_y[i]			=		portal_array[i].to_y;
                                to_map[i]		=		portal_array[i].to_map;
                                to_grid[i]		=		portal_array[i].to_grid;
                            }
                        }
                    }).get();
                    // End of portals json call
                }
            }).get();
        }
    }).get();




});
// End of initialise process




function show_world(){
    document.getElementById("npc").hide();
    document.getElementById("player").hide();
    document.getElementById("building").hide();
    document.getElementById("world").show();
    document.getElementById("terminal").hide();
    document.getElementById("twines").hide();
    document.getElementById("plates").hide();
    game.state.start('next');
}

// Init the little green buttons at the top left of each json view
function loadUp() {
    var x = document.getElementsByClassName('mid');
   for (i=0;i<x.length;i++) {
       x[i].addEventListener("click", show_world);
   }
}

// Standard Function to test for keypresses
function check(e)
{

    if (active==1)
    {

            if (!e)
                var e = window.event;
            (e.keyCode) ? key = e.keyCode : key = e.which;
            try
            {
                switch (key)
                {
                    case 38:
                        MoveUp();
                        break;
                    case 39:
                        MoveRight();
                        break;
                    case 40:
                        MoveDown();
                        break;
                    case 37:
                        MoveLeft();
                        break;
                }
            }
            catch (Exception)
            {
            }
    }	
}

// ////////////////////////////////////////////////////////
function MoveRight()
{
    direction = 'R';
    Portal_Check(direction);
    var right1 = parseInt(PosX) + 1;

    if (PosX == 7)
    {
        PosX = 0;
        map++;
        jump();
        return;
    }

    if (cell[right1][PosY] <= 0)
    {
        PosX++;
        pX = pX + 50;
        Move_Player();
        return;
    }
    else
    {
        walls_alert();
    }
}
// //////////////////////////////////////////////////////////
function MoveLeft()
{	
    direction = 'L';
    Portal_Check(direction);
    var left1 = parseInt(PosX) - 1;
    if (PosX == 0)
    {
        PosX = 7;
        map--;
        jump();
        return;
    }
    if (cell[left1][PosY] <= 0)
    {
        PosX--;
        pX = pX - 50;
        Move_Player();
        return;
    }
    else
    {
        walls_alert();
    }
}

// //////////////////////////////////////////////////////////
function MoveUp()
{
    direction = 'U';
    Portal_Check(direction);
    var up = parseInt(PosY) - 1;
    if (PosY == 0)
    {
        PosY = 7;
        map = map - grid_index;
        jump();
        return;
    }
    if (cell[PosX][up] <= 0)
    {
        PosY--;
        pY = pY - 50;
        Move_Player();
        return false;
    }
    else
    {
        walls_alert();
    }
}

// /////////////////////////////////////////////////////////
function MoveDown()
{
    direction = 'D';
    Portal_Check(direction);
    var down = parseInt(PosY) + 1;
    // first check if portal
    // check if player is at edge of current map
    if (parseInt(PosY) == 7)
    {
        PosY = 0;
        map = parseInt(map) + parseInt(grid_index);
        jump();
        return;
    }
    if (cell[PosX][down] <= 0)
    {
        PosY++;
        pY = pY + 50;
        Move_Player();
        return false;
    }
    else
    {
        walls_alert();
    }
}

function walls_alert()
{
    alert('You cant walk through walls...... Yet!');
}

function safety_check()
{
    if (grid == 0 || map == 0)
    {
        grid = 1;
        map = 1;
        PosX = 1;
        PosY = 1;
    }
    return;
}

function jump()
{
    safety_check();
    location.href = 'index.php?option=com_battle&view=phaser';
}

function Move_Player()
{
    safety_check();
    var a = new Request.JSON({
        url : "index.php?option=com_battle&format=raw&task=action&action=save_coordinate&posx=" +
        PosX + "&posy=" + PosY + "&grid=" + grid + "&map=" + map,
        onSuccess : function()
        {
            var mover = new Fx.Move(document.id('demo'),
            {
                relativeTo : document.getElementById('screen_grid'),
                position : 'upperLeft',
                edge : 'upperLeft',
                offset : {x : pX, y : pY}
            });
            mover.start(); //moves to the new location
        }
    }).get();
}

function Portal_Check(direction)
{

    // alert (portal_array.length);
    for (i = 0; i < portal_array.length; i++)
    {
        // alert(to_grid[i]);
        if (PosX == from_x[i] && PosY == from_y[i] && direction == dir[i] )
        {
            PosX = to_x[i];
            PosY = to_y[i];
            map = to_map[i];
            grid = to_grid[i];
            jump();
        }
    }
}



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

        function reload()
        {

                var a = new Request.JSON(
                {
                    url: "index.php?option=com_battle&format=raw&task=action&action=reload",
                    onSuccess: function(result)
                    {
                    //	alert(result[2] + ' me: ' + result[0].health + '   Him: ' + result[1].health);
                    myElement= document.id('magazine');

                    myElement.set('html', result);
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

function punch_character(character_id){
    
    var d = document.getElementById('punch');
    var a = new Request.JSON({
            url: "index.php?option=com_battle&format=raw&task=action&action=attack_character&type=punch&character=" + character_id,
            onSuccess: function(result){

            text_message = (result[2]);
            var new_message = new Element('p',{
            'display':'table-row',
            'html': text_message });

            new_message.inject('message_table','top');

                 npc_health = result[1];

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

 function do_stuff(){
      //  var paper = Raphael('diagram', 60, 60), rad = 43, defaultText = 'Stats', speed = 250;
      var paper = Raphael('diagram', 60, 60);
 alert(npc_health);

paper.circle(30, 30, npc_health).attr({ stroke: 'none', fill: '#193340' });
//var circle = paper.circle(50, 40, 10);
 //  circle.attr("fill", "#f00");
 //  circle.attr("stroke", "#fff");
}
   
//var circle2 = paper.circle(50, 40, 10);
//   circle.attr("fill", "#f00");
//   circle.attr("stroke", "#fff");
//}
  // do_stuff();

function moo(){
    myElement.setStyle(property, value);
}


