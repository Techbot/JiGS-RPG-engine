import Phaser from "phaser";
import { useJigsStore } from '../../stores/jigs';
import axios from "axios";

const COLOR_PRIMARY = 0x0A0908;
const COLOR_LIGHT = 0x009999;
const COLOR_DARK = 0x0B3C49;

export class CutScene extends Phaser.Scene {

  jigs: any;
 // thisBox: Phaser.GameObjects.DOMElement;
  data: any;
  constructor() {

    super({ key: "CutScene" });
    this.jigs = useJigsStore();

  }

  create() {
    console.log('blob');

    this.jigs.foliosArray.forEach(element => {
      if (element.id == this.jigs.folioClicked) {
        this.data = element.nodeBody;
        //  this.addDom(this.data);
        this.blobby(this);
           }
    });

    this.events.on(Phaser.Scenes.Events.WAKE, function () {
    //  this.thisBox.setVisible(false);
      this.jigs.foliosArray.forEach(element => {
        if (element.id == this.jigs.folioClicked) {
          this.data = element.nodeBody;
          this.blobby(this);
        }
      });

    }, this);
  }

  update() {
    // console.log('hi');
    // this.thisBox.setPosition(450, this.jigs.scroll * 100);

  }

  blobby(scene) {
    var scrollablePanel = scene.rexUI.add.scrollablePanel({
      x: 425,
      y: 300,
      width: 700,
      height: 500,
      scrollMode: 0,
      background: scene.rexUI.add.roundRectangle(0, 0, 2, 2, 10, COLOR_PRIMARY),
      panel: {
        child: this.CreatePanel(scene),

        mask: {
          padding: 1
        },
      },
      slider: {
        track: scene.rexUI.add.roundRectangle(0, 0, 20, 10, 10, COLOR_DARK),
        thumb: scene.rexUI.add.roundRectangle(0, 0, 0, 0, 13, COLOR_LIGHT),
      },

      space: {
        left: 10,
        right: 10,
        top: 10,
        bottom: 10,

        panel: 10,
      }
    })
      .layout()

    this.AddDragCornerController(scrollablePanel)

    scene.add.text(0, 580, 'Drag top-left or bottom-right corner. Click here to close')
    .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
    .on('pointerdown', this.onCutsceneDown.bind(this));

  }

  onCutsceneDown() {
    this.game.scene.switch("CutScene", "main");
  }
  hydrateCutscene(response) {

  }

  texty(data) {

    this.add.text(200, 100, data, { fontFamily: 'Georgia, "Goudy Bookletter 1911", Times, serif' })
      .setWordWrapWidth(600)
      .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
      .on('pointerdown', this.onCutsceneDown.bind(this));
  }

  addDom(data) {
/*     this.thisBox = this.add.dom(450, 280, 'div', ' width: 820px; height: 300px; font: 14px Arial', data)
      .setInteractive({ cursor: 'url(/assets/images/cursors/speak.cur), pointer' })
      .on('pointerdown', this.onCutsceneDown.bind(this)); */
  }



  CreatePanel(scene) {
    var sizer = scene.rexUI.add.fixWidthSizer({
      space: {
        left: 3,
        right: 3,
        top: 3,
        bottom: 3,
        item: 8,
        line: 8,
      }
    })
    var lines = this.data.split('\n');
    for (var li = 0, lcnt = lines.length; li < lcnt; li++) {
      var words = lines[li].split(' ');
      for (var wi = 0, wcnt = words.length; wi < wcnt; wi++) {
        sizer.add(
          scene.add.text(0, 0, words[wi], {
            fontSize: 18
          })
        );
      }
      if (li < (lcnt - 1)) {
        sizer.addNewLine();
      }
    }

    return sizer;
  }


  AddDragCornerController(sizer) {
    var scene = sizer.scene;

    var bottomRighterController = scene.add.rectangle(sizer.right, sizer.bottom, 30, 30, 0x333333);
    var topLeftController = scene.add.rectangle(sizer.left, sizer.top, 30, 30, 0x333333)

    bottomRighterController
      .setInteractive({ draggable: true })
      .on('drag', function (pointer, dragX, dragY) {
        var topX = sizer.left,
          topY = sizer.top;
        var width = dragX - topX,
          height = dragY - topY;

        sizer.setChildPosition(bottomRighterController, dragX, dragY);
        sizer.setChildPosition(topLeftController, topX, topY);

        sizer.setMinSize(width, height).layout();

        sizer.left = topX;
        sizer.top = topY;
      })

    sizer.pin(bottomRighterController)

    topLeftController
      .setInteractive({ draggable: true })
      .on('drag', function (pointer, dragX, dragY) {
        sizer.x += dragX - topLeftController.x;
        sizer.y += dragY - topLeftController.y;
      })

    sizer.pin(topLeftController)

  }


}

var CreateHorizontalScrollBar = function (scene) {
  return scene.rexUI.add.scrollBar({
    width: 400,
    orientation: 'x',

    background: scene.rexUI.add.roundRectangle(0, 0, 0, 0, 0, COLOR_DARK),

    buttons: {
      left: scene.rexUI.add.triangle(0, 0, 20, 20, COLOR_PRIMARY).setDirection('left'),
      right: scene.rexUI.add.triangle(0, 0, 20, 20, COLOR_PRIMARY).setDirection('right'),
    },

    slider: {
      thumb: scene.rexUI.add.roundRectangle(0, 0, 40, 20, 10, COLOR_LIGHT),
    },

    space: {
      left: 5, right: 5, top: 5, bottom: 5, item: 5
    }
  })
}

var CreateVerticalScrollBar = function (scene) {
  return scene.rexUI.add.scrollBar({
    height: 400,
    orientation: 'y',

    background: scene.rexUI.add.roundRectangle(0, 0, 0, 0, 0, COLOR_DARK),

    buttons: {
      left: scene.rexUI.add.triangle(0, 0, 20, 20, COLOR_PRIMARY).setDirection('up'),
      right: scene.rexUI.add.triangle(0, 0, 20, 20, COLOR_PRIMARY).setDirection('down'),
    },

    slider: {
      thumb: scene.rexUI.add.roundRectangle(0, 0, 20, 40, 10, COLOR_LIGHT),
    },

    space: {
      left: 5, right: 5, top: 5, bottom: 5, item: 5
    }
  })
}





