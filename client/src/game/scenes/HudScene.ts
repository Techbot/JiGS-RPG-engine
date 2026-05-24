import { Scene } from 'phaser'
import { useJigsStore } from '../../stores/jigs'
import Mission from '../entities/mission'
import WebFont from '../../assets/WebFont'

export class HudScene extends Scene {
  jigs: any;
  score: number;
  x: any;
  y: any;
  info: any;
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
  currentDialog: any;
  timedEvent: any;
  mission: any;
  npc: any;
  dialogOpen: boolean = false;

  constructor() {
    super({ key: 'HudScene', active: true });
    this.jigs = useJigsStore();
    this.mission = new Mission();

    this.credits = this.jigs.playerStats.credits;
    this.score = 0;

    const COLOR_PRIMARY = 0x4e342e;
    const COLOR_LIGHT = 0x7b5e57;
    const COLOR_DARK = 0x260e04;
  }

  preload() {
    this.load.addFile(new WebFont(this.load, ['Roboto', 'Neutron Demo']))
    this.load.image('nextPage', '/assets/images/gui/arrow-down-left.png');
    // this.load.atlas('avatar', '/assets/images/gui/psibot-head.png', '/assets/images/gui/avatar.json');
    // this.load.image('avatar', '/assets/images/gui/' + this.npc + '.png');
  }

  closeDialog() {
    if (this.currentDialog) {
      // Stop typing animation before destroying
      if (this.currentDialog.isTyping) {
        this.currentDialog.stop(true);
      }
      if (this.currentDialog.destroy) {
        this.currentDialog.destroy(true);
      }
    }
    this.currentDialog = null;
    this.dialogOpen = false;
  }

  createTextBox = function (
    scene,
    config,
    {
      icon,
      onCompletePage,
      onLastPage,
    }: {
      icon?: any,
      onCompletePage?: Function,
      onLastPage?: Function,
    } = {}
  ) {
    const wrapWidth = this.GetValue(config, 'wrapWidth', 0);
    const fixedWidth = this.GetValue(config, 'fixedWidth', 0);
    const fixedHeight = this.GetValue(config, 'fixedHeight', 0);
    const titleText = this.GetValue(config, 'title', undefined);

    const textBox = scene.rexUI.add.textBox({
      x: 10,
      y: 460,

      text: this.getBBcodeText(
        scene,
        wrapWidth,
        fixedWidth,
        fixedHeight
      ),

      action: scene.add.image(0, 0, 'nextPage').setVisible(false),

      title: titleText
        ? scene.add.text(0, 0, titleText, {
            font: 'bold 24px Neutron Demo',
            fill: '#ffffff'
          })
        : undefined,

      icon,

      align: {
        title: 'left'
      }
    }).setDisplayOrigin(0, 0);

    scene.currentDialog = textBox;
    scene.dialogOpen = true;

    textBox
      .setInteractive()
      .on('pointerdown', function () {
        const arrow = this.getElement('action').setVisible(false);
        this.resetChildVisibleState(arrow);

        if (this.isTyping) {
          this.stop(true);
          return;
        }

        if (!this.isLastPage) {
          this.typeNextPage();
          return;
        }

        textBox.destroy();

        if (onLastPage) {
          onLastPage(scene);
        }
      }, textBox)

      .on('pageend', function () {
        if (this.isLastPage) {
          return;
        }

        const arrow = this.getElement('action').setVisible(true);
        this.resetChildVisibleState(arrow);
        arrow.y -= 30;
        scene.tweens.add({
          targets: arrow,
          y: '+=30',
          ease: 'Bounce',
          duration: 500,
          repeat: 0,
          yoyo: false
        });

        if (onCompletePage) {
          onCompletePage(this);
        }
      }, textBox)

      .on('complete', function () {
        console.log('all pages typing complete');
      }, textBox)

      .on('destroy', function () {
        scene.dialogOpen = false;
        scene.currentDialog = null;
      });

    return textBox;
  }

  create() {
    // Intro text.
    this.currentDialog = this.createIntroTextBox(this, 10, 380, {
      wrapWidth: 500,
    }).setDisplayOrigin(0, 0).start(this.jigs.content, 50);
    this.dialogOpen = true;

    // Intro text disappears after 6 seconds if no interaction.
    this.time.delayedCall(6000, () => {
      if (this.currentDialog && this.currentDialog.visible) {
        this.currentDialog.destroy();
      }
    });

    // Grab a reference to the Game Scene
    let ourGame = this.scene.get('main');

    // Remove only HUD listeners (if previously attached)
    ourGame.events.off('Mission', this.onMission, this);
    ourGame.events.off('addScore', this.onAddScore, this);
    ourGame.events.off('content', this.onContent, this);
    ourGame.events.off('cutscene', this.onCutscene, this);
    ourGame.events.off('position', this.onPosition, this);

    // Add listeners for events emitted by the Game Scene.
    // Trigger methods to update the display.
    ourGame.events.on('Mission', this.onMission, this);
    ourGame.events.on('addScore', this.onAddScore, this);
    // NPC handler barks and/or mission response data.
    ourGame.events.on('content', this.onContent, this);
    ourGame.events.on('cutscene', this.onCutscene, this);
    ourGame.events.on('position', this.onPosition, this);

    //  Our Text object to display the Score
    this.info = this.add.text(15, 15, 'Credits: ', { font: '12px Roboto', fill: '#ffffff', backgroundColor: 'rgba(0, 0, 0, 0.6)' }).setPadding({ left: 4, right: 4, top: 2, bottom: 2 });
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
    if (!this.hud2) { return; }
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

  onMission(response: any, npc: any) {
    this.closeDialog();
    this.mission.dialog(this, npc, response);
  }

  onAddScore() {
    this.score += 10;
  }

  onContent() {
    this.closeDialog();
    this.currentDialog = this.createIntroTextBox(this, 10, 500, {
      wrapWidth: 600,
    }).start(this.jigs.content, 50);
  }

  onCutscene() {
    console.log('Cutscene event fired');
    console.log('cutscenePosition:', this.jigs.cutscenePosition);
    console.log('cutscene array:', this.jigs.cutscene);
    console.log('current entry:', this.jigs.cutscene[this.jigs.cutscenePosition]);

    this.closeDialog();
    if (this.jigs.cutscene[this.jigs.cutscenePosition]) {
      const currentEntry = this.jigs.cutscene[this.jigs.cutscenePosition];
      const npc = currentEntry.npc || 'Narrator';
      const dialogLine = currentEntry.dialog_line || 'The story continues...';

      console.log('Creating dialog with npc:', npc, 'and line:', dialogLine);

      this.currentDialog = this.createDialogTextBox(
        this, 10, 500, {
          wrapWidth: 600,
          iconText: npc,
        }).start(dialogLine, 50);
      this.jigs.cutscenePosition++;
    } else {
      console.warn('No cutscene entry at position:', this.jigs.cutscenePosition);
    }
  }

  onPosition(x: number, y: number) {
    this.x = x;
    this.y = y;
    if (this.info) {
      this.info.setText('Credits: ' + this.jigs.playerStats.credits);
    }
  }

  GetValue = Phaser.Utils.Objects.GetValue;

  // Intro text box.
  createIntroTextBox = function (scene, x, y, config) {
    return this.createTextBox(scene, config);
  }

  // Cutscene dialog text box.
  createDialogTextBox = function (scene, x, y, config) {
    const iconText = this.GetValue(config, 'iconText', 'Narrator');

    const safeIconText =
      iconText && String(iconText).length > 0
        ? String(iconText)
        : 'Narrator';

    const icon = scene.add.text(
      0,
      0,
      safeIconText.toUpperCase() + ': ',
      {
        font: 'bold 14px Roboto',
        fill: '#ffffff',
        backgroundColor: 'rgba(25, 83, 95, 0.8)'
      }
    ).setPadding({
      left: 16,
      right: 16,
      top: 8,
      bottom: 8
    });

    return this.createTextBox(scene, config, {
      icon,

      onLastPage: (scene) => {
        console.log(
          'Dialog complete - cutscene position:',
          scene.jigs.cutscenePosition,
          'cutscene length:',
          scene.jigs.cutscene.length
        );

        if (scene.jigs.cutscenePosition < scene.jigs.cutscene.length) {
          console.log('Emitting next cutscene');

          scene.scene.get('main').events.emit('cutscene');
        } else {
          console.log('Cutscene complete - no more entries');
        }
      }
    });
  }

  // Helper function to create BBCodeText with consistent styling.
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

const createLabel = function (scene, text) {
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
