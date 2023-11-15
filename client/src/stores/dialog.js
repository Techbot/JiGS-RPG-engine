// stores/counter.js
import { defineStore } from "pinia";
import axios from "axios";

export const useJialogStore = defineStore("jigs", {
  state: () => ({


    dialogTitle: "Bob",
    dialogContent: `The Evil Wizard has stolen the Balls of Loveliness. \n
Without the Balls there can be no loveliness across the land. \n
Will you find my Balls?`,

    dialogChoices:
      [
        { text: 'Yes I will find your balls.', value: '433' }, // { text: 'A', value: 10 },
        { text: 'No I am not ready.', value: 0 }, // { text: 'B', value: 20 },
        // 'C', // { text: 'C', value: 30 },
        // 'D', // { text: 'D', value: 40 },
        // 'E', // { text: 'E', value: 50 },
        // 'F', // { text: 'F', value: 60 },
        // 'G', // { text: 'G', value: 70 },
        // 'H', // { text: 'H', value: 80 },
        // 'I', // { text: 'I', value: 90 },
        // 'J', // { text: 'J', value: 100 },
        // 'K', // { text: 'K', value: 110 },
      ],

  
  }),
  getters: {
    finishedTodos(state) {
      // autocompletion! ✨
      return state.todos.filter((todo) => todo.isFinished);
    },
    unfinishedTodos(state) {
      return state.todos.filter((todo) => !todo.isFinished);
    },
    /**
     * @returns {{ text: string, id: number, isFinished: boolean }[]}
     */
    filteredTodos(state) {
      if (this.filter === "finished") {
        // call other getters with autocompletion ✨
        return this.finishedTodos;
      } else if (this.filter === "unfinished") {
        return this.unfinishedTodos;
      }
      return this.todos;
    },
    hydrateState(state) {
      return (incMob) => this.hydrate(incMob);
    }
  },
  actions: {
    // any amount of arguments, return a promise or not
    myInventory() {
      axios
        .get("/myinventory?_wrapper_format=drupal_ajax")
        .then((response) => {
          this.divideInventory(response);
        });
    },
    divideInventory(response) {
      this.playerInventory = response.data[0].value["playerInventory"].items;
      this.listBackpack = [];
      this.listStorage = [];

      let i = 0;
      while (i < this.playerInventory.length) {
        if (this.playerInventory[i].location == 'Backpack') {
          this.listBackpack.push(this.playerInventory[i]);
        }
        if (this.playerInventory[i].location == 'Storage') {
          this.listStorage.push(this.playerInventory[i]);
        }
        i++;
      }
    },
    hydrate(incMob) {
      axios
        .get("/mystate?_wrapper_format=drupal_ajax")
        .then((response) => {

          this.playerStats = response.data[0].value["player"];
          this.playerId = parseInt(response.data[0].value["player"]["id"]);
          this.playerName = response.data[0].value["player"]["name"];

          this.gameState = response.data[0].value["player"]["userState"];
          this.userMapGrid = parseInt(response.data[0].value["player"]["userMG"]);

          this.tiled = parseInt(response.data[0].value["MapGrid"]["tiled"]);
          this.mapWidth = parseInt(response.data[0].value["MapGrid"]["mapWidth"]);
          this.mapHeight = parseInt(response.data[0].value["MapGrid"]["mapHeight"]);
          this.portalsArray = response.data[0].value["MapGrid"]["portalsArray"];
          this.npcArray = response.data[0].value["MapGrid"]["npcArray"];
          if (incMob) {
            this.mobArray = response.data[0].value["MapGrid"]["mobArray"];
          }
          this.rewardsArray = response.data[0].value["MapGrid"]["rewardsArray"];
          this.nodeTitle = response.data[0].value["MapGrid"]["name"];

          this.tilesetArray_1 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_1"];
          this.tilesetArray_2 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_2"];
          this.tilesetArray_3 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_3"];
          this.tilesetArray_4 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_4"];

          this.city = response.data[0].value["City"];

          // Regex replaces close/open p with \n new line
          // And replaces all other html tags with null.
          this.debug = parseInt(response.data[0].value["gameConfig"]["Debug"]);
          this.content = response.data[0].value["gameConfig"]["Body"].replaceAll('</p><p>', '\n').replaceAll(/(<([^>]+)>)/ig, '');
        })
    },
  },
});
