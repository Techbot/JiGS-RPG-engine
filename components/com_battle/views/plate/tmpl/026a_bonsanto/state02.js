// We don't need to create the bonsanto object again, because we already did this in State001
// Instead all we do is create a new function on it called StateB and then set-up a single create function on its prototype

bonsanto.State002 = function(game) {
    this.plateBgState001;
    this.plateBgState002;
    this.evilBono;
}

bonsanto.State002.prototype = {

    create: function() {

        this.plateBgState001 = this.add.sprite(0, 0, 'plateBgState001');
        var plateBgState002 = this.add.sprite(320, 240, 'plateBgState002');
        plateBgState002.anchor.setTo(0.5, 0.5);
        plateBgState002.scale.setTo(1, 1);

        var evilBono = this.add.sprite(382, 242, 'evilBono');
        evilBono.anchor.setTo(0.5, 0.5);
        evilBono.scale.setTo(1, 1);

        //var tween = this.add.tween(this.plateBgState002).to( { x: -800 }, 8000, "Linear", true, 0, -1, true);

        plateBgState002.alpha = 1;
        evilBono.alpha = 1;

        // to( Map<String, num> properties, [int duration = 1000, double ease (double k) = null, bool autoStart = false, num delay = 0.0, int repeat = 0, bool yoyo = true])
        //this.add.tween(plateBgState002).to({alpha: 1}, 300, Phaser.Easing.Linear.None, true, 0, 0, true);
        this.add.tween(plateBgState002.scale).to({x: 1.5, y: 1.5}, 300, Phaser.Easing.Linear.None, true);
        this.add.tween(plateBgState002.anchor).to({x: 0.5, y: 0.5}, 300, Phaser.Easing.Linear.None, true);

        //this.add.tween(evilBono).to({alpha: 1}, 300, Phaser.Easing.Linear.None, true, 0, 0, true);
        //this.add.tween(evilBono).to( { angle: 45 }, 300, Phaser.Easing.Linear.None, true);
        this.add.tween(evilBono.scale).to({x: 2, y: 2}, 200, Phaser.Easing.Linear.None, true);
        this.add.tween(evilBono.anchor).to({x: 0.4, y: 0.5}, 200, Phaser.Easing.Linear.None, true);

        var tween = this.add.tween(evilBono).to({alpha: 0}, 100, Phaser.Easing.Linear.None, true, 200, 0, false);
        this.add.tween(plateBgState002).to({alpha: 0}, 100, Phaser.Easing.Linear.None, true, 200, 0, false);

        //tween.onStart.add(started, this);
        tween.onComplete.add(completed, this);
    }

};


function started() {

    console.log("tween started");

}

function completed() {

    console.log("tween complete");
    this.state.start('State003');

}