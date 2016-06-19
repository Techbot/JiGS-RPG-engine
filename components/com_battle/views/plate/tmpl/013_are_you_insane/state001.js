// defining a single global object (consumer) and adding some functions in to its prototype (eg preload, create functions)

var consumer = {};


consumer.State001 = function (game) {


};

consumer.State001.prototype = {

    preload: function () {
        this.load.image('bg', 'bg.jpg');
        this.load.image('tile', 'tile.jpg');
        this.load.spritesheet('fighter01',
            '/components/com_battle/images/assets/chars/halflings/001-Fighter01.png',32,48,12);
        this.load.atlas('sprite', 'sprite.png', 'sprite.json');
    },

    create: function () {
        //  This creates a simple sprite that is using our loaded image and
        //  displays it on-screen and assign it to a variable
        var image = this.add.sprite(game.world.centerX, game.world.centerY, 'bg');
        //  This simply creates a sprite using the mushroom image we loaded above and positions it at 200 x 200
        obj001 = this.add.sprite(222, 327, 'sprite', 'object001');
        obj002 = this.add.sprite(-27, 122, 'sprite', 'object002');
        obj003 = this.add.sprite(391, 72, 'sprite', 'object003');
        tile   = this.add.sprite(421, 82, 'tile');
        obj004 = this.add.sprite(27, 390, 'fighter01');
        obj004.animations.add('left',[11,10,9],3,true);
        obj004.animations.add('right',[1,2,3,],3);
        obj004.animations.play('left');
        //  Moves the image anchor to the middle, so it centers inside the game properly
        image.anchor.set(0.5);
        ////////////////////////////////////////////////////////////////////
        //                  Input
        /////////////////////////////////////////////////////////////////
        cursors = this.input.keyboard.createCursorKeys();
        // Control Panel image click
        obj001.inputEnabled = true;
        text = this.add.text(20, 20, '', { fill: '#ffffff', font: "14px Arial", });
        obj001.events.onInputDown.add(listener, this);
        tile.name ='tile long tooltip title';
        obj004.name ='obj004';

        tile.inputEnabled = true;
        obj004.inputEnabled = true;

        tile.events.onInputOver.add(tooltip, this);
        tile.events.onInputOut.add(killTooltip, this);

        obj004.events.onInputOver.add(tooltip, this);
        obj004.events.onInputOut.add(killTooltip, this);

        // var style = { font: "bold 32px Arial", fill: "#fff", boundsAlignH: "center", boundsAlignV: "middle" };

        // the Text is positioned at 0, 100
        //text = game.add.text(0, 0, "phaser 2.4 text bounds", style);
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
    obj003.frameName = 'object004';
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