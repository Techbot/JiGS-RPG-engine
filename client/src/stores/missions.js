import { defineStore } from "pinia";
import axios from "axios";

export const useMissionStore = defineStore("missions", {
  state: () => ({
    missionTitle: "Bob",
    missionHandlerDialog: `The Evil Wizard has stolen the Balls of Loveliness. \n
Without the Balls there can be no loveliness across the land. \n
Will you find my Balls?`,
    missionChoice:
      [
        { text: 'Yes I will find your balls.', value: 582 }, // { text: 'A', value: 10 },
        { text: 'No I am not ready.', value: 0 }, // { text: 'B', value: 20 },
      ],
    missionValue: 0,
  }),
  getters: {

  },
  actions: {

   },
});
