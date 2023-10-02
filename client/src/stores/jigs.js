// stores/counter.js
import { defineStore } from "pinia";
import axios from "axios";

export const useJigsStore = defineStore("jigs", {
  state: () => ({
    playerName: "Blank",

    playerId: 0,

    leave: 0,

    /** @type {{ level: number, health: number, strength: number, stamina: number, losses: number, wins: number, xp: number, credits: number, skill: array, inventory : array ,mission: array}[]} */
    playerStats: [],

    /** @type {{ text: string, x: number, y: number, sprite: number }[]} */
    npcArray: [],

    /** @type {{ name: string, x: number, y: number, sprite: number, type: string, health:number }[]} */
    mobArray: [],

    /** @type {{ text: string, x: number, y: number, sprite: number }[]} */
    rewardsArray: [],

    /** @type {{ text: string }[]} */
    city: "Blank",

    /** @type {{ text: string }[]} */
    gameState: "Character",

    /** @type {{ text: string }[]} */
    playerGameState: "GamePhaser",

    /** @type {{ text: string }[]} */
    playerState: "dormant",

    nodeID: 0,

    nodeTitle: "Blank",

    // type will be automatically inferred to number
    userMapGrid: 1,

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
  },
  actions: {
    // any amount of arguments, return a promise or not
    addTodo(text) {
      // you can directly mutate the state
      this.todos.push({ text, id: this.nextId++, isFinished: false });
    },
  },
});
