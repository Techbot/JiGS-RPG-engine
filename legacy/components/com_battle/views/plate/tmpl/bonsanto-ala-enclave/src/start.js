// (function(){
	var game = new Phaser.Game(800, 500, Phaser.CANVAS,'world',null,true,true,null);
	var states = {
		'Boot': EPT.Boot,
		'Preloader': EPT.Preloader,
		'MainMenu': EPT.MainMenu,
		'Achievements': EPT.Achievements,
		'Story': EPT.Story,
		'Game': EPT.Game,
        'State001' : bonsanto.State001,
        'State002' : bonsanto.State002,
        'State003' : bonsanto.State003
	};
	for(var state in states)
		game.state.add(state, states[state]);
	    game.state.start('Boot');
// })();
