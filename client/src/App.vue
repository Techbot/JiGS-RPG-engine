<script>
import axios from "axios";
import * as coreui from '@coreui/coreui'
import { CButton } from '@coreui/vue'
import { useJigsStore } from "./stores/jigs";
// import ViewTabs from "./components/ViewTabs";
import Character from './components/tabs/Character.vue';
import ViewMain from "./components/ViewMain";
import { Room, Client } from "colyseus.js";
import { BACKEND_URL } from "./game/backend";

export default {
  components: {
    Room,
    Character,
    ViewMain,
    coreui,
    CButton
  },
  setup() {
    // this.room = new Room;
    const jigs = useJigsStore();
    return {
      jigs,
    };
  },
  data() {
    return {
      gameState: [],
    };
  },
  mounted() {
    this.room = new Room;
    this.client = new Client(BACKEND_URL);
    this.jigs = useJigsStore();
    this.jigs.hydrateState(1);
  },
  methods: {
    formSubmit(e) {
      e.preventDefault();
      this.jigs.hydrate(1);
    },
    toggleClass(e) {
      const nav = document.querySelectorAll('.tab-buttons .btn');
      nav.forEach(navItem => {
        navItem.classList.remove('active');
        if (!e.target.classList.contains('active')) {
          e.target.classList.add('active');
        }
      });
    },
    log(e) {
      e.preventDefault();
      this.toggleClass(e);
      this.jigs.gameState = "Log";
      console.log(this.jigs.userMapGrid);
      console.log(this.jigs.gameState);
      console.log(this.jigs.tiled);
      console.log(this.jigs.portalsArray);
      this.room.leave();
    },
    char(e) {
      e.preventDefault();
      this.toggleClass(e);
      this.jigs.gameState = "Character";
      console.log(this.jigs.userMapGrid);
      console.log(this.jigs.tiled);
      console.log(this.jigs.gameState);
      this.room.leave();
    },
    inventory(e) {
      e.preventDefault();
      this.toggleClass(e);
      this.jigs.gameState = "Inventory";
      console.log(this.jigs.userMapGrid);
      console.log(this.jigs.tiled);
      console.log(this.jigs.gameState);
      this.room.leave();
    },

    skills(e) {
      e.preventDefault();
      this.toggleClass(e);
      this.jigs.gameState = "Skills";
      console.log(this.jigs.gameState);
      console.log(this.jigs.tiled);
      console.log(this.jigs.userMapGrid);
      this.room.leave();
    },
    quests(e) {
      e.preventDefault();
      this.toggleClass(e);
      this.jigs.gameState = "Quests";
      console.log(this.jigs.gameState);
      console.log(this.jigs.tiled);
      console.log(this.jigs.userMapGrid);
      this.room.leave();
    },
    game(e) {
      e.preventDefault();
      this.toggleClass(e);
      location.reload();
      //this.jigs.gameState = "GamePhaser";
      console.log(this.jigs.gameState);
      console.log(this.jigs.tiled);
      console.log(this.jigs.userMapGrid);
    },
  },
};
</script>
<template>
  <div class="layout-container">
    <form @submit="formSubmit" class="tabs">
      <div class="tab-buttons">
        <CButton @click="game" component="button" color="primary"
          shape="rounded-pill" size="lg" active>Game</CButton>
        <CButton @click="char" component="button" color="primary"
          shape="rounded-pill" size="sm">Char</CButton>
        <CButton @click="inventory" component="button" color="primary"
          shape="rounded-pill" size="sm">Inv</CButton>
        <CButton @click="skills" component="button" color="primary"
          shape="rounded-pill" size="sm">Skills</CButton>
        <CButton @click="quests" component="button" color="primary"
          shape="rounded-pill" size="sm">Quests</CButton>
        <CButton @click="log" component="button" color="primary"
          shape="rounded-pill" size="sm">Log</CButton>
      </div>
    </form>
    <ViewMain :msg="jigs.gameState" />
    <div class="sidebar-2">
      <div class="tab-panels">
        <Character />
    </div>
  </div>
</div></template>
