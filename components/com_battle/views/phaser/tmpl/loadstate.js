/**
 * Created by techbot on 17/11/14.
 */

loadState = {
    init: function() {
        //Called as soon as we enter this state
    },
    preload: function() {


        game.load.image('space', 'assets/misc/starfield.jpg');
      //  game.load.image('fire1', 'assets/particles/fire1.png');
        //game.load.image('fire2', 'assets/particles/fire2.png');
     //   game.load.image('fire3', 'assets/particles/fire3.png');
        

        game.load.image('fighter001', 'assets/Battlers/001-Fighter01.png');

        game.load.image('smoke', 'assets/particles/smoke-puff.png');

        game.load.spritesheet('ball', 'assets/particles/plasmaball.png', 128, 128);

   
   
   
    },
    create: function(pointer) {
        game.physics.startSystem(Phaser.Physics.ARCADE);

        game.add.tileSprite(0, 0, game.width, game.height, 'space');

        sprite = game.add.sprite(300, 220, 'fighter001', 0);
        
        
        
        
        
        game.physics.arcade.enable(sprite);


        sprite.inputEnabled = true;
        sprite.events.onInputDown.add(onDown, this);
/*
        sprite.input.enableDrag();
        sprite.events.onDragStart.add(onDragStart, this);
        sprite.events.onDragStop.add(onDragStop, this);

        sprite.animations.add('pulse');
        sprite.play('pulse', 30, true);

        sprite.anchor.set(0.5);
*/


		
        createText(16, 16, 'If you can catch the fireball, drag it around');

    },

    update: function() {
        var px = sprite.body.velocity.x;
        var py = sprite.body.velocity.y;

        px *= -1;
        py *= -1;

   //     emitter.minParticleSpeed.set(px, py);
   //     emitter.maxParticleSpeed.set(px, py);

   //     emitter.emitX = sprite.x;
   //     emitter.emitY = sprite.y;

        // emitter.forEachExists(game.world.wrap, game.world);
        game.world.wrap(sprite, 64);
    },
    onDragStart:function(){
        sprite.body.moves = false;
    },
    onDragStop:function () {
    sprite.body.moves = true;
},
    render: function() {
        game.debug.spriteCoords(sprite, 32, 32);
// game.debug.cameraInfo(game.camera, 96, 64);
    }
};
function createText(x, y, string) {
    var text = game.add.text(x, y, string);
    // text.anchor.set(0.5);
    // text.align = 'center';
    //  Font style
    text.font = 'Arial Black';
    text.fontSize = 20;
    // text.fontWeight = 'bold';
    text.fill = '#ffffff';
    text.setShadow(2, 2, 'rgba(0, 0, 0, 0.7)', 2);
    return text;
}


function onDown(sprite, pointer) {

 
    game.state.start('play');





}
