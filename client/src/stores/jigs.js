// stores/counter.js
import { defineStore } from "pinia";
import axios from "axios";

export const useJigsStore = defineStore("jigs", {
  state: () => ({

    room: {},

    playerName: "Blank",

    playerId: 0,

    profileId: 0,

    debug: 0,

    leave: 0,

    /** @type {{ level: number, health: number, strength: number, stamina: number, losses: number, wins: number, xp: number, credits: number, skill: array, inventory : array , mission: array }[]} */
    playerStats: [],

    playerSwitches: [],

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

    missionCompleteDialog: "Blank",
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

    /** @type {{ target:number, name: string, x: number, y: number, type: string, health: number, field_frame_width_value: number, field_frame_height_value: number,}[]} */
    bossesArray: [],

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

    soundtrack: 'blank',

    weapon: 0,

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
    switchesArray: [],
    missionSwitchesArray: [],
    dialogueArray: [],
    firesArray: [],
    fireBarrelsArray: [],
    leversArray: [],
    machineArray: [],
    crystalArray: [],
    questsArray: [],
    foliosArray: [],
    folioClicked: 0,
    wallsArray: [
      //    { x: 260, y: 440, width: 360, height:  10 },
      //    { x: 440, y: 190, width:  10, height: 480 },
      //   { x: 180, y: 540, width:  10, height: 180 },
      //   { x: 140, y: 680, width:  10, height: 160 },
      //    { x: 100, y: 600, width: 120, height:  10 },
    ],
    cutscene: [],
    cutscenePosition: 0,
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
  },
});
