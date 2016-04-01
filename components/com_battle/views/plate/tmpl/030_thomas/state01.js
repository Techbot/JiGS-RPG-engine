// defining a single global object (tirnanog) and adding some functions in to its prototype (eg preload, create functions)

var thomas = {};

thomas.State001 = function (game) {

};

thomas.State001.prototype = {

    preload: function () {

        this.load.image('bg', 'thomas-livingroom.jpg');
    },

    create: function () {

        starBg = this.add.sprite(0, 0, 'bg');

    }

}



