// defining a single global object (consumer) and adding some functions in to its prototype (eg preload, create functions)
var x  =550;
var y = 82;
var y2 = 82;

var consumer = {};
consumer.State001 = function (game) {
};

consumer.State001.prototype = {

    preload: function () {
        this.load.image('bg', 'bg.jpg');
        this.load.image('tile', 'tile.jpg');
        this.load.spritesheet('fighter01',
            '/components/com_battle/images/assets/chars/halflings/001-Fighter01.png',
            32,
            48,
            12);
        this.load.atlas('sprite', 'sprite.png', 'sprite.json');
    },

    create: function () {
        //  This creates a simple sprite that is using our loaded image and
        //  displays it on-screen and assign it to a variable
        var image = this.add.sprite(game.world.centerX, game.world.centerY, 'bg');
        //  This simply creates a sprite using the mushroom image we loaded above and positions it at 200 x 200
        obj001 = this.add.sprite(222, 327, 'sprite', 'object001');
        obj002 = this.add.sprite(-27, 122, 'sprite', 'object002');
        hand = this.add.sprite(x, y, 'sprite', 'object003');
        hand2 = this.add.sprite(250,y2, 'sprite', 'object003');
       // hand2.anchor.setTo(.5, -1); //so it flips around its middle
        hand2.scale.x = -1; //facing default direction sprite.scale.x = -1; //flipped


        tile   = this.add.sprite(421, 82, 'tile');
        obj004 = this.add.sprite(27, 390, 'fighter01');
        obj004.animations.add('left',[11,10,9],3,true);
        obj004.animations.add('right',[1,2,3],3);
        obj004.animations.play('left');
        //  Moves the image anchor to the middle, so it centers inside the game properly
        image.anchor.set(0.5);
        ////////////////////////////////////////////////////////////////////
        //                  Input
        /////////////////////////////////////////////////////////////////
        cursors = this.input.keyboard.createCursorKeys();
        text = this.add.text(20, 20, '', { fill: '#ffffff', font: "14px Arial", });
        //game.input.onDown.add(moveBall, this);
        //  In this example we'll create 4 specific keys (up, down, left, right) and monitor them in our update function
        upKey = game.input.keyboard.addKey(Phaser.Keyboard.UP);
        downKey = game.input.keyboard.addKey(Phaser.Keyboard.DOWN);
        leftKey = game.input.keyboard.addKey(Phaser.Keyboard.LEFT);
        rightKey = game.input.keyboard.addKey(Phaser.Keyboard.RIGHT);
        fireButton = game.input.keyboard.addKey(Phaser.Keyboard.SPACEBAR);

        // Control Panel image click
        obj001.inputEnabled = true;
        obj001.events.onInputDown.add(listener, this);


        tile.name ='tile long tooltip title';
        tile.inputEnabled = true;


        obj004.name ='obj004';
        obj004.inputEnabled = true;

        tile.events.onInputOver.add(tooltip, this);
        tile.events.onInputOut.add(killTooltip, this);

        obj004.events.onInputOver.add(tooltip, this);
        obj004.events.onInputOut.add(killTooltip, this);
        // var style = { font: "bold 32px Arial", fill: "#fff", boundsAlignH: "center", boundsAlignV: "middle" };
        // the Text is positioned at 0, 100
        //text = game.add.text(0, 0, "phaser 2.4 text bounds", style);
        this.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;
    },
   update:function(){
        if (upKey.isDown)
        {
         //   sprite.loadTexture('hero');
            y--;
            y2++;
          //  sprite.animations.add('walk_up',[36,37,38,39,40,41,42,43]);
          //  sprite.animations.play('walk_up', 6);
            hand.y =y;
            hand2.y =y2;
          //  circle_core.y =y;
          //  circle_core.angle = -90;
        }
        else if (downKey.isDown)
        {
           // sprite.loadTexture('hero');
           // sprite.animations.add('walk_down',[0,1,2]);
            y++;
            y2--
            //sprite.animations.play('walk_down', 6);
            hand.y =y;
            hand2.y =y2;
            //circle_core.y =y;
            //circle_core.angle = 90;
        }
    }
}

function p(pointer) {
    console.log(pointer.event);
}

function listener () {
    var counter;
    counter++;
    text.text = "You clicked " + counter + " times!";
    changeFrame();
}

function changeFrame() {
    hand.frameName = 'Marilyn';
}

function tooltip(thing) {

    var rectWidth = tile.name.length + 40;
    var rectHeight = 80;

    ///////////////////////////
    //bar = game.add.graphics();
    //bar.beginFill(0x000000, 0.2);
    //bar.drawRect(thing.x-20, thing.y-20, rectWidth, rectHeight);

    console.log(thing.name, rectWidth, typeof bar);

    var style = { font: '14px Arial', fill: 'white', align: 'left', wordWrap: true };
    //var style = { font: '14px Arial', fill: 'white', align: 'left', backgroundColor: 'black', boundsAlignH: "center", boundsAlignV: "middle" };
    text = this.add.text(0, 0, thing.name, style);
    text.padding.set(0, 0);
    text.setShadow(3, 3, 'rgba(0,0,0,0.9)', 2);

    text.setTextBounds(thing.x-20, thing.y-20, rectWidth, rectHeight);

}

function killTooltip(thing) {

    text.destroy();
    //bar.destroy();

}


// defining a single global object (are_you_insane) and adding some functions in to its prototype (eg preload, create functions)

var are_you_insane = {};


are_you_insane.State001 = function (game) {


};