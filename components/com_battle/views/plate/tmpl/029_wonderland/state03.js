
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

    }

};


