import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';

export class MessageScene extends Phaser.Scene {
  jigs: any;

  constructor() {
    super({ key: "MessageScene" });
    this.jigs = useJigsStore();
  }

  preload() {
  }

  create() {

    if (this.jigs.missionCompleteDialog !== "Blank") {

      var content = this.jigs.missionCompleteDialog;
      console.log(this.jigs.missionCompleteDialog);

     // const missionCompleteTitle = this.add.text(100, 300, this.jigs.missionCompleteDialog.title, { font: 'bold 24px Roboto', backgroundColor: 'rgba(0, 0, 0, 0.8)', color: '#ffffff' }).setPadding({ left: 16, right: 16, top: 8, bottom: 8 });

      let noti_bg = this.add.rectangle(200, 100, 600, 400, 0x000000, .5).setDisplayOrigin(0, 0);
      const missionCompleteHeader = this.add.text(100, 200, 'Mission Complete!', { font: 'bold 32px Roboto', backgroundColor: 'rgba(0, 0, 0, 0.8)', color: '#ffffff' }).setPadding({ left: 16, right: 16, top: 8, bottom: 8 }).setDisplayOrigin(0, 0);
      Phaser.Display.Align.In.TopCenter(missionCompleteHeader, noti_bg);
      // let noti_txt = this.add.text(0, 0, 'Magic is not ready yet\n\nwait a sec', { align: 'center' });

      const text = this.add.text(0, 0, content, { font: 'bold 16px Roboto', backgroundColor: 'rgba(0, 0, 0, 0.8)', color: '#ffffff' }).setPadding({ left: 16, right: 16, top: 8, bottom: 8 }).setDisplayOrigin(0,0);
      text.setWordWrapWidth(500, false);

      Phaser.Display.Align.In.Center(text, noti_bg);
      const missionCompleteReward = this.add.text(300, 200, 'Reward', { font: 'bold 24px Roboto', backgroundColor: 'rgba(25, 83, 95, 0.8)', color: '#ffffff' }).setPadding({ left: 16, right: 16, top: 8, bottom: 8 });

      Phaser.Display.Align.In.BottomCenter(missionCompleteReward, noti_bg);

      this.add.image(350, 400, 'icon01');
      this.add.image(450, 400, 'icon02');
      this.add.image(550, 400, 'icon03');
      this.add.image(650, 400, 'icon04');

      this.jigs.missionCompleteDialog = "Blank";

      const helloButton = this.add.text(100, 100, 'Close', { color: '#0f0' });
      helloButton.setInteractive();
      helloButton.on('pointerdown', () => {
        // this.scene.stop();
        this.scene.switch('HudScene');
      });
    }
  }

  update() { }
}
