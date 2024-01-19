/**
 * ------- Mission Dialog ---------
 */
import axios from "axios";

export default class Mission {
  constructor() {
  }

  dialog(self, npc) {
    const COLOR_PRIMARY = 0x333333;
    const COLOR_LIGHT = 0xffffff;
    const COLOR_DARK = 0x111111;
    var print = self.add.text(0, 0, '').setDepth(1);
    var choicesType = 'radio';
    var style = {
      width: 300,
      space: {
        left: 20, right: 20, top: 20, bottom: 20,
        title: 20,
        content: 30,
        choices: 30, choice: 10,
      },

      background: {
        color: COLOR_PRIMARY,
        strokeColor: COLOR_LIGHT,
        radius: 20,
      },

      title: {
        space: { left: 5, right: 5, top: 5, bottom: 5 },
        text: {
          fontSize: 16
        },
        background: {
          color: COLOR_DARK
        }
      },

      content: {
        space: { left: 5, right: 5, top: 5, bottom: 5 },
        text: {
          fontSize: 14
        },
      },

      buttonMode: 1,
      button: {
        space: { left: 10, right: 10, top: 10, bottom: 10 },
        background: {
          color: COLOR_DARK,
          strokeWidth: 0,
          radius: 10,
          'hover.strokeColor': 0xffffff,
          'hover.strokeWidth': 2,
          'disable.color': 0x333333,
        }
      },

      choicesType: choicesType,
      choice: {
        space: { left: 10, right: 10, top: 10, bottom: 10 },
        background: {
          color: COLOR_DARK,
          strokeWidth: 0,
          radius: 10,
          'hover.strokeColor': 0xffffff,
          'hover.strokeWidth': 2,
          'active.color': 'red',
        }
      },

      align: {
        actions: 'right'
      },
    }

    var dialog = self.rexUI.add.confirmDialog(style)
      .setPosition(400, 300)
      .setDraggable('title')
      .setDraggable('content')
      .resetDisplayContent({
        title: self.jigs.missionTitle,
        content: self.jigs.missionHandlerDialog,
        choices: self.jigs.missionChoice,
        buttonA: 'Ok'
      })
      .layout()

    // Disable action button until first clicking of any choice button
    dialog
      .setActionEnable(0, false)
      .once('choice.click', function () {
        dialog.setActionEnable(0);
      })

    dialog
      .modalPromise()
      .then(function (data) {
        if (data.value > 0) {
          sendPositive(data);
        }
        print.text = `\
index: ${data.index}
text : ${data.text}
value : ${data.value}`
      })
  }

  updateHandler(npc) {
    console.log("this is me an NPC " + npc[0]);
    this.loadMission(npc[6]);
  }

  loadMission(npc) {
  }
}

function sendPositive(data) {
  console.log("this is me sending a value: " + data.value);
  axios
    .get("/addmission?_wrapper_format=drupal_ajax&id=" + data.value)
    .then((response) => {
      console.log("this is me receiving a value: " + response);
    });
}
