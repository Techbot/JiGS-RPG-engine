// defining a single global object (bonsanto) and adding some functions in to its prototype (eg preload, create functions)

var bonsanto = {};

    bonsanto.State001 = function (game) {

};

bonsanto.State001.prototype = {

    create: function () {

        this.add.sprite(0, 0, 'plateBgState001');
        this.add.sprite(204, 13, 'bono');

        // button
        obj001 = this.add.sprite(28, 170, 'clickMe');

        clickMeText = this.add.text(0, 0, 'Free Seeds', {
            font: '26px Arial',
            fill: 'white',
            align: 'center',
            wordWrap: true,
            wordWrapWidth: obj001.width
        });
        clickMeText.anchor.set(0.5);
        clickMeText.setShadow(3, 3, 'rgba(0,0,0,0.5)', 2);
        centerText();

        cursors = this.input.keyboard.createCursorKeys();

        // Control Panel image click
        obj001.inputEnabled = true;
        obj001.events.onInputDown.add(listener, this);

        uiOverlay();
        removeChapter();

        var buttonBack = this.add.button(this.world.width-20, game.world.height-20, 'button-back', this.clickBack, this, 1, 0, 2);
        buttonBack.anchor.set(1,1);
        buttonBack.x = this.world.width+buttonBack.width+20;
        this.add.tween(buttonBack).to({x: this.world.width-20}, 500, Phaser.Easing.Exponential.Out, true);

    },
    clickBack: function() {
        if(EPT._audioStatus) {
            EPT._soundClick.play();
        }
        this.game.state.start('MainMenu');
    }

}


function listener () {

    obj001.events.onInputDown.remove(listener, this);

    this.add.tween(obj001).to({alpha: 0}, 2000, "Linear", true);

    // initiate second state onInputDown in create function
    this.state.start('State002');

}


function centerText() {

    clickMeText.x = Math.floor(obj001.x + obj001.width / 2);
    clickMeText.y = Math.floor(obj001.y + obj001.height / 2);

}
