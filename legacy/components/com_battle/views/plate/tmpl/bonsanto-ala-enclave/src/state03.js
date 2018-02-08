
bonsanto.State003 = function(game) {

    this.plateBgState001;
    this.bono60;
};

bonsanto.State003.prototype = {

    create: function() {

        console.log("State003");

        var plateBgState001 = this.add.sprite(0, 0, 'plateBgState001');

        this.add.sprite(204, 13, 'bono60');

        plateBgState001.alpha = 0;


        this.add.tween(plateBgState001).to({alpha: 1}, 300, Phaser.Easing.Linear.None, true, 0, 0, false);


        var buttonBack = this.add.button(this.world.width-20, game.world.height-20, 'button-back', this.clickBack, this, 1, 0, 2);
        buttonBack.anchor.set(1,1);
        buttonBack.x = this.world.width+buttonBack.width+20;
        this.add.tween(buttonBack).to({x: this.world.width-20}, 500, Phaser.Easing.Exponential.Out, true);

        uiOverlay2();

    },
    clickBack: function() {
        if(EPT._audioStatus) {
            EPT._soundClick.play();
        }
        this.game.state.start('MainMenu');
    }


};