// stores/counter.js
import { defineStore } from "pinia";
import axios from "axios";

export const useJigsStore = defineStore("jigs", {
  state: () => ({
    playerName: "Blank",

    playerId: 0,

    debug: 0,

    leave: 0,

    /** @type {{ level: number, health: number, strength: number, stamina: number, losses: number, wins: number, xp: number, credits: number, skill: array, inventory : array ,mission: array}[]} */
    playerStats: [],

    title: "Bob",

    content: `The Evil Wizard has stolen the Balls of Loveliness. \n
Without the Balls there can be no loveliness across the land. \n
Will you find my Balls?`,

    choice:
      [
        { text: 'Yes I will find your balls.', value: 433 }, // { text: 'A', value: 10 },
        { text: 'No I am not ready.', value: 0 }, // { text: 'B', value: 20 },
      ],

    playerStorage: [],

    playerInventory: [],

    listBackpack: [],

    listStorage: [],

    playerQuests: [],

    backpackItem: 0,

    item: 0,

    /** @type {{ text: string, x: number, y: number, sprite: number, isHandler: boolean}[]} */
    npcArray: [],

    /** @type {{ target:number, name: string, x: number, y: number, sprite: number, type: string, health: number, following: number}[]} */
    mobArray: [],

    /** @type {{ text: string, x: number, y: number, sprite: number}[]} */
    rewardsArray: [],

    /** @type {{ text: string }[]} */
    city: "Blank",

    /** @type {{ text: string }[]} */
    gameState: "GamePhaser",

    /** @type {{ text: string }[]} */
    playerGameState: "GamePhaser",

    /** @type {{ text: string }[]} */
    playerState: "dormant",

    nodeID: 0,

    nodeTitle: "Blank",

    // type will be automatically inferred to number
    userMapGrid: 1,

    mapWidth: 120,

    mapHeight: 120,

    tiled: 0,

    /** @type {{ text: string }[]} */
    content: "Blank",

    npc: 0,

    /** @type {{ text: string }[]} */
    mobClick: '0',

    /** @type {{ text: string }[]} */
    mobShoot: '0',

    tilesetArray_1: [],
    tilesetArray_2: [],
    tilesetArray_3: [],
    tilesetArray_4: [],
    tilesetArray_5: [],

    portalsArray: [],
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
