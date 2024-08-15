import { Scene } from 'phaser'
import { useJigsStore } from '../../stores/jigs'
import Mission from '../entities/mission'
import WebFont from '../../assets/WebFont'

export class HudScene extends Scene {
  jigs: any;
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
  content: string;
  thing: any;
  timedEvent: any;
  mission: any;
  npc: any;

  constructor() {
    super({ key: 'HudScene', active: true });
    this.jigs = useJigsStore();
    this.mission = new Mission();
    this.content = `Phaser is a fast, free, and fun open source HTML5 game framework that offers WebGL and Canvas rendering across desktop and mobile web browsers. Games can be compiled to iOS, Android and native apps by using 3rd party tools. You can use JavaScript or TypeScript for development.`;

    this.credits = this.jigs.playerStats.credits;

    const COLOR_PRIMARY = 0x4e342e;
    const COLOR_LIGHT = 0x7b5e57;
    const COLOR_DARK = 0x260e04;
  }

  preload() {

    this.load.addFile(new WebFont(this.load, ['Roboto', 'Neutron Demo']))
    this.load.image('nextPage', '/assets/images/assets/images/gui/arrow-down-left.png');
    // this.load.atlas('avatar', '/assets/images/assets/images/gui/psibot-head.png', '/assets/images/assets/images/gui/avatar.json');
    // this.load.image('avatar', '/assets/images/assets/images/gui/' + this.npc + '.png');
  }
  create() {
    // Dialogue.
    this.thing = this.createTextBox(this, 10, 380, {
      wrapWidth: 500,
    }).setDisplayOrigin(0, 0).start(this.jigs.content, 50).setDepth(7);

    // Grab a reference to the Game Scene
    let ourGame = this.scene.get('MainScene');

    ourGame.events.on('Mission', function (response, npc) {
      this.mission.dialog(this, npc, response);
    }, this);

    ourGame.events.on('addScore', function () {
      this.score += 10;
    }, this);

    ourGame.events.on('content', function () {
      this.thing.destroy();
      this.thing = this.createTextBox(this, 10, 500, {
        wrapWidth: 600,
      }).start(this.jigs.content, 50).setDepth(7)
    }, this);

    ourGame.events.on('cutscene', function () {
      if (this.jigs.cutscene[this.jigs.cutscenePosition]) {
        this.thing.destroy();
        this.thing = this.createDialogTextBox(
          this, 10, 500, {
          wrapWidth: 600,
          iconText: this.jigs.cutscene[this.jigs.cutscenePosition].npc,
        }).start(this.jigs.cutscene[this.jigs.cutscenePosition].dialog_line, 50).setDepth(7);
        this.jigs.cutscenePosition++;
      }
    },
      this);

    this.events.on('cutscene', function () {
      if (this.jigs.cutscene[this.jigs.cutscenePosition]) {
        this.thing.destroy();
        this.thing = this.createDialogTextBox(
          this, 10, 500, {
          wrapWidth: 600,
          iconText: this.jigs.cutscene[this.jigs.cutscenePosition].npc,
        }).start(this.jigs.cutscene[this.jigs.cutscenePosition].dialog_line, 50).setDepth(7);
        this.jigs.cutscenePosition++;
      }
    },
      this);

    ourGame.events.on('position', function (x: number, y: number) {
      this.x = x;
      this.y = y;
      info.setText('Credits: ' + this.jigs.playerStats.credits);
    }, this);


    ourGame.events.on('missionComplete', function () {
      this.scene.switch('MessageScene');
    }, this);

    //  Our Text object to display the Score
    let info = this.add.text(15, 15, 'Credits: ', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud2 = this.add.text(15, 30, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud3 = this.add.text(15, 45, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud4 = this.add.text(15, 60, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud5 = this.add.text(15, 75, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud11 = this.add.text(15, 90, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud12 = this.add.text(15, 105, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud6 = this.add.text(735, 15, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud7 = this.add.text(735, 30, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud8 = this.add.text(735, 45, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud9 = this.add.text(735, 60, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
    this.hud10 = this.add.text(735, 75, '', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
  }
  update() {

    // HUD1
    this.hud2.setText('State: ' + this.jigs.gameState);
    this.hud3.setText('Node: ' + this.jigs.userMapGrid);
    this.hud4.setText('TileMap: ' + this.jigs.tiled);
    this.hud5.setText('Title: ' + this.jigs.nodeTitle);
    this.hud11.setText('Name: ' + this.jigs.playerName);
    this.hud12.setText('Id: ' + this.jigs.playerId);

    // HUD2
    this.hud6.setText('X: ' + parseInt(this.x) + ' Y: ' + parseInt(this.y));

    if (this.jigs.portalsArray[0]) {
      this.hud7.setText('P1 X: ' + this.jigs.portalsArray[0].x + ' P1 Y: ' + this.jigs.portalsArray[0].y);
    }

    if (this.jigs.portalsArray[1]) {
      this.hud8.setText('P2 X: ' + this.jigs.portalsArray[1].x + ' P2 Y: ' + this.jigs.portalsArray[1].y);
    }

    if (this.jigs.portalsArray[2]) {
      this.hud9.setText('P3 X: ' + this.jigs.portalsArray[2].x + ' P3 Y: ' + this.jigs.portalsArray[2].y);
    }

    this.hud10.setText('City: ' + this.jigs.city);
  }

  GetValue = Phaser.Utils.Objects.GetValue;

  createTextBox = function (scene, x, y, config) {
    var wrapWidth = this.GetValue(config, 'wrapWidth', 0);
    var fixedWidth = this.GetValue(config, 'fixedWidth', 0);
    var fixedHeight = this.GetValue(config, 'fixedHeight', 0);
    var titleText = this.GetValue(config, 'title', undefined);

    var textBox = scene.rexUI.add.textBox({
      x: 10,
      y: 460,
      text: this.getBBcodeText(scene, wrapWidth, fixedWidth, fixedHeight),
      action: scene.add.image(0, 0, 'nextPage').setVisible(false),
      title: (titleText) ? scene.add.text(0, 0, titleText, { font: 'bold 24px Neutron Demo', fill: '#ffffff' }) : undefined,
      // icon: scene.rexUI.add.transitionImagePack({
      //   width: 40, height: 40,
      //   key: 'avatar', frame: 'A-smile'
      //  }),
      // icon: (this.npc) ? scene.add.image(0, 0, 'avatar').setVisible(true) : undefined,
      align: {
        title: 'left'
      }
    }).setDisplayOrigin(0, 0);

    textBox
      .setInteractive()
      .on('pointerdown', function () {
        var arrow = this.getElement('action').setVisible(false);
        this.resetChildVisibleState(arrow);
        if (this.isTyping) {
          this.stop(true);
        } else if (!this.isLastPage) {
          this.typeNextPage();
        } else {
          textBox.destroy();
        }
      }, textBox)
      .on('pageend', function () {
        if (this.isLastPage) {
          return;
        }

        var arrow = this.getElement('action').setVisible(true);
        this.resetChildVisibleState(arrow);
        arrow.y -= 30;
        var tween = scene.tweens.add({
          targets: arrow,
          y: '+=30', // '+=100'
          ease: 'Bounce', // 'Cubic', 'Elastic', 'Bounce', 'Back'
          duration: 500,
          repeat: 0, // -1: infinity
          yoyo: false
        });
      }, textBox)
      .on('complete', function () {
        console.log('all pages typing complete')
      })
    return textBox;
  }

  ////////////////////////////////////////////////////////////////////////////////

  createDialogTextBox = function (scene, x, y, config) {
    var wrapWidth = this.GetValue(config, 'wrapWidth', 0);
    var fixedWidth = this.GetValue(config, 'fixedWidth', 0);
    var fixedHeight = this.GetValue(config, 'fixedHeight', 0);
    var titleText = this.GetValue(config, 'title', undefined);
    var iconText = this.GetValue(config, 'iconText', undefined);

    var textBox = scene.rexUI.add.textBox({
      x: 10,
      y: 460,
      text: this.getBBcodeText(scene, wrapWidth, fixedWidth, fixedHeight),
      action: scene.add.image(0, 0, 'nextPage').setVisible(false),
      title: (titleText) ? scene.add.text(0, 0, titleText, { font: 'bold 24px Neutron Demo', fill: '#ffffff' }) : undefined,
      // icon: scene.rexUI.add.transitionImagePack({
      //   width: 40, height: 40,
      //   key: 'avatar', frame: 'A-smile'
      //  }),
      // icon: (this.npc) ? scene.add.image(0, 0, 'avatar').setVisible(true) : undefined,
      icon: scene.add.text(0, 0, iconText.toUpperCase() + ': ', { font: 'bold 14px Roboto', fill: '#ffffff', backgroundColor: 'rgba(25, 83, 95, 0.8)' }).setPadding({ left: 16, right: 16, top: 8, bottom: 8 }),

      align: {
        title: 'left'
      }
    }).setDisplayOrigin(0, 0);

    textBox
      .setInteractive()
      .on('pointerdown', function () {
        var arrow = this.getElement('action').setVisible(false);
        this.resetChildVisibleState(arrow);
        if (this.isTyping) {
          this.stop(true);
        } else if (!this.isLastPage) {
          this.typeNextPage();
        } else {
          textBox.destroy();
        }
      }, textBox)
      .on('pageend', function () {
        if (this.isLastPage) {
          return;
        }

        var arrow = this.getElement('action').setVisible(true);
        this.resetChildVisibleState(arrow);
        arrow.y -= 30;
        var tween = scene.tweens.add({
          targets: arrow,
          y: '+=30', // '+=100'
          ease: 'Bounce', // 'Cubic', 'Elastic', 'Bounce', 'Back'
          duration: 500,
          repeat: 0, // -1: infinity
          yoyo: false
        });
      }, textBox)
      .on('complete', function () {
        if (scene.jigs.cutscenePosition < scene.jigs.cutscene.length) {
          console.log("more");

          setTimeout(() => {
            scene.events.emit('cutscene');
          }, 1000);
        }

      })
    return textBox;
  }

  getBBcodeText = function (scene, wrapWidth, fixedWidth, fixedHeight) {
    return scene.rexUI.add.BBCodeText(0, 0, '', {
      // fontFamily: 'Neutron Demo',
      fontWeight: 'bold',
      fontSize: '24px',
      fill: 'white',
      backgroundColor: 'rgba(0, 0, 0, 0.6)',
      wrap: {
        mode: 'word',
        width: 660
      },
      maxLines: 6,
    }).setShadow(2, 2, '#000000', 2, false, true).setPadding({ left: 5, right: 5, top: 5, bottom: 5 })
  }
}

var createLabel = function (scene, text) {
  return scene.rexUI.add.label({
    width: 40, // Minimum width of round-rectangle
    height: 40, // Minimum height of round-rectangle
    background: scene.rexUI.add.roundRectangle(0, 0, 100, 40, 20, 'rgba(0, 0, 0, 0.6)'),
    text: scene.add.text(0, 0, text, {
      font: '12px Roboto'
    }),

    space: {
      left: 10,
      right: 10,
      top: 10,
      bottom: 10
    }
  });
}


