EPT.Preloader = function(game) {};
EPT.Preloader.prototype = {
	preload: function() {
		var preloadBG = this.add.sprite((this.world.width), (this.world.height), 'loading-background');
        var preloadProgress = this.add.sprite((this.world.width-540)*0.5, (this.world.height+170)*0.5, 'loading-progress');		this.load.setPreloadSprite(preloadProgress);
		this._preloadResources();
	},
	_preloadResources() {
		var pack = EPT.Preloader.resources;
		for(var method in pack) {
			pack[method].forEach(function(args) {
				var loader = this.load[method];
				loader && loader.apply(this.load, args);
			}, this);
		}
	},
	create: function() {
		this.state.start('MainMenu');
	}
};
EPT.Preloader.resources = {
	'image': [
		['background', 'img/bonsanto-state001.png'],
		['title', 'img/title.png'],
		//['logo-emc', 'img/fnord_128x128.png'],
		['logo-emc', 'img/pyramid_24.png'],
		['clickme', 'img/clickme.png'],
		['overlay', 'img/overlay.png'],
        ['plateBgState001', 'img/bonsanto-state001.png'],
        ['plateBgState002', 'img/bonsanto-state002.jpg'],
        ['bono', 'img/bono.png'],
        ['bono60', 'img/bono-60.png'],
        ['evilBono', 'img/evil-bono.png'],
        ['clickMe', 'img/clickMe.png']
	],
	'spritesheet': [
		//['button-start', 'img/button-start.png', 180, 180],
		['button-start', 'img/hand.png', 252, 380],
		//['button-start', 'img/Meffert_Pyraminx_Mixed.png', 180, 180],
		//['button-continue', 'img/button-continue.png', 180, 180],
        ['button-continue', 'img/Meffert_Pyraminx.png', 180, 180],
		['button-mainmenu', 'img/button-mainmenu.png', 180, 180],
		['button-restart', 'img/button-tryagain.png', 180, 180],
		['button-achievements', 'img/button-achievements.png', 110, 110],
		['button-pause', 'img/button-pause.png', 80, 80],
		['button-audio', 'img/button-sound.png', 80, 80],
		['button-back', 'img/button-back.png', 70, 70]
	],
	'audio': [
		['audio-click', ['sfx/audio-button.m4a','sfx/audio-button.mp3','sfx/audio-button.ogg']]
	]
};
