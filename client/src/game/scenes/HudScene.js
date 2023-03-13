
import { Scene } from 'phaser'
import { useCounterStore } from '@/stores/counter'

export default class HudScene extends Scene {

    constructor ()
    {
        super({ key: 'HudScene', active: true });
        this.counter = useCounterStore()
        this.score = 0;
    }

    create ()
    {
        //  Our Text object to display the Score
        let info = this.add.text(10, 10, 'Score: 0', { font: '24px Arial', fill: '#111111' });
        //  Grab a reference to the Game Scene
        let ourGame = this.scene.get('PlayScene');
        //  Listen for events from it
        ourGame.events.on('addScore', function () {
            this.score += 10;
            info.setText('Score: ' + this.score);
        }, this);

       // this.hud1 = this.add.text(10, 16, '', { fontSize: '24px', fill: '#111111' });
        this.hud2 = this.add.text(10, 38, '', { font: '24px Arial', fill: '#111111' });
        this.hud3 = this.add.text(10, 66, '', { font: '24px Arial', fill: '#111111' });
    }
    update(){
       // this.hud1.setText('Blue: ' +  this.counter.Blobby);
        this.hud2.setText('State:' + this.counter.gameState);
        this.hud3.setText('Map:' + this.counter.userMapGrid);
    }
}
