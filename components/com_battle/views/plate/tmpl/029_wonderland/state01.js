// defining a single global object (wonderland) and adding some functions in to its prototype (eg preload, create functions)

var wonderland = {};

wonderland.State001 = function (game) {

};

wonderland.State001.prototype = {

    preload: function () {

        this.load.image('bg', 'wonderland.jpg');
    },

    create: function () {

        bg = this.add.sprite(0, 0, 'bg');
    }

}



