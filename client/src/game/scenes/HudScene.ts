import { Scene } from 'phaser'
import { useCounterStore } from '../../stores/counter'

export class HudScene extends Scene {
    counter: any;
    score: number;
    x: string;
    y: string;
    add: any;
    scene: any;
    hud2: any;
    hud3: any;
    hud4: any;
    hud5: any;
    hud11: any;
    hud12: any;
    hud6: any;
    hud7: any;
    hud8: any;
    hud9: any;
    hud10: any;
    credits: any;

    constructor ()
    {
        super({ key: 'HudScene', active: true });
        this.counter = useCounterStore();
        this.credits = this.counter.playerStats.credits;
    }

    create ()
    {
        var r1 = this.add.rectangle(80, 60, 260, 100, 0x6666ff).setBlendMode(Phaser.BlendModes.MULTIPLY);
        var r2 = this.add.rectangle(560, 60, 260, 100, 0x6666ff).setBlendMode(Phaser.BlendModes.MULTIPLY);

        //  Our Text object to display the Score
        let info = this.add.text(10, 10, 'Credits: ', { font: '12px Arial', fill: '#ffffff' });

        //  Grab a reference to the Game Scene
        let ourGame = this.scene.get('main');
        //  Listen for events from it

        ourGame.events.on('addScore', function () {
            this.score += 10;
        }, this);

        ourGame.events.on('position', function (x : number, y: number) {
            this.x = x;
            this.y = y;
            info.setText('Credits: ' + this.counter.playerStats.credits);

        }, this);

       // this.hud1 = this.add.text(10, 16, '', { fontSize: '24px', fill: '#111111' });
        this.hud2  = this.add.text(10, 28, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud3  = this.add.text(10, 46, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud4  = this.add.text(10, 66, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud5  = this.add.text(10, 86, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud11 = this.add.text(10, 106, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud12 = this.add.text(10, 126, '', { font: '12px Arial', fill: '#ffffff' });

        this.hud6  = this.add.text(460,  28, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud7  = this.add.text(460,  46, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud8  = this.add.text(460,  66, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud9  = this.add.text(460,  86, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud10 = this.add.text(460, 106, '', { font: '12px Arial', fill: '#ffffff' });

    }
    update(){
       // this.hud1.setText('Blue: ' +  this.counter.Blobby);
        this.hud2.setText('State: '   + this.counter.gameState);
        this.hud3.setText('Node: '    + this.counter.userMapGrid);
        this.hud4.setText('TileMap: ' + this.counter.tiled);
        this.hud5.setText('Title: '   + this.counter.nodeTitle);
        this.hud6.setText('X: ' + this.x + 'Y: ' + this.y);

        if (this.counter.portalsArray[0]){
        this.hud7.setText('P1 X: '  + this.counter.portalsArray[0].x + 'P1 Y: ' + this.counter.portalsArray[0].y);
        }

        if (this.counter.portalsArray[1]) {
        this.hud8.setText('P2 X: '  + this.counter.portalsArray[1].x + 'P2 Y: ' + this.counter.portalsArray[1].y);
        }

        if (this.counter.portalsArray[2]) {
        this.hud9.setText('P3 X: '  + this.counter.portalsArray[2].x + 'P3 Y: ' + this.counter.portalsArray[2].y);
        }

        this.hud10.setText('City: ' + this.counter.city);
        this.hud11.setText('Name: ' + this.counter.playerName);
        this.hud12.setText('Id: ' + this.counter.playerId);
    }
}
