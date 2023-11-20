// stores/counter.js
import { defineStore } from "pinia";
import axios from "axios";

export const useDialogStore = defineStore("dialogs", {
  state: () => ({
    title: "Bob",
    content: `The Evil Wizard has stolen the Balls of Loveliness. \n
Without the Balls there can be no loveliness across the land. \n
Will you find my Balls?`,

    choices:
      [
        { text: 'Yes I will find your balls.', value: '433' }, // { text: 'A', value: 10 },
        { text: 'No I am not ready.', value: 0 }, // { text: 'B', value: 20 },
      ],

  }),
  getters: {

  },
  actions: {
    hydrate() {
      axios
        .get("/mymission?_wrapper_format=drupal_ajax")
        .then((response) => {
          this.title = response.data[0].value["dialogTitle"];
          this.content = parseInt(response.data[0].value["dialogContent"]);
          this.choice = response.data[0].value["dialogChoice"];
        })
    },
  },
});
