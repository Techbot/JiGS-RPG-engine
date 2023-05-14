// stores/counter.js
import { defineStore } from "pinia";
import axios from "axios";

export const useCounterStore = defineStore("counter", {
  state: () => ({
    /** @type {{ text: string, id: number, isFinished: boolean }[]} */
    todos: [],

    /** @type {'all' | 'finished' | 'unfinished'} */
    filter: "all",

    // type will be automatically inferred to number
    nextId: 0,

    /** @type {{ text: string }[]} */
    city: "Blank",

    /** @type {{ text: string }[]} */
    gameState: "Bank",

    nodeID: 0,

    nodeTitle: "Blank",

    // type will be automatically inferred to number
    userMapGrid: 1,

    tiled: 0,

    Blobby: 10,

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
