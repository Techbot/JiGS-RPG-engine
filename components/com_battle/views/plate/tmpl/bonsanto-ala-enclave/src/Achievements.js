EPT.Achievements = function(game) {};


//  The Google WebFont Loader will look for this object, so create it before loading the script.
WebFontConfig = {
    //  The Google Fonts we want to load (specify as many as you like in the array)
    google: {
        families: ['Roboto:300,400,700']
    }

};


EPT.Achievements.prototype = {

	preload: function() {
        //  Load the Google WebFont Loader script
        game.load.script('webfont', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js');
    },

	create: function(){

        this.add.sprite(0, 0, 'background');
		var fontAchievements = { font: "32px Arial", fill: "#fff" };
		var textAchievements = this.add.text(100, 75, 'Seed reserve', fontAchievements);

        //textAchievements = game.add.text('Seed reserve');
        //textAchievements.font = 'Roboto';
        //textAchievements.fontSize = 32;
        textAchievements.fontWeight = 700;
        textAchievements.align = 'left';
        textAchievements.stroke = '#111';
        textAchievements.strokeThickness = 1;
        textAchievements.setShadow(2, 2, 'rgba(0,0,0,0.3)', 2);



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
};