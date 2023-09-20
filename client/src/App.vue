<script>
import axios from "axios";
import * as coreui from '@coreui/coreui'
import { useJigsStore } from "./stores/jigs";
import ViewTabs from "./components/ViewTabs";
import ViewMain from "./components/ViewMain";
import '@coreui/coreui/dist/css/coreui.min.css'
import 'bootstrap/dist/css/bootstrap.min.css'

export default {
  components: {
    ViewTabs,
    ViewMain
  },
  setup() {
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
    this.jigs = useJigsStore();
    axios
      .get("/mystate?_wrapper_format=drupal_ajax")
      .then((response) => {
        this.jigs.playerName     = response.data[0].value["playerName"];
        this.jigs.playerStats    = response.data[0].value["playerStats"];
        this.jigs.playerId       = parseInt( response.data[0].value["playerId"]);
        this.jigs.gameState      = response.data[0].value["userGamesState"];
        this.jigs.userMapGrid    = parseInt( response.data[0].value["userMapGrid"]);
        this.jigs.tiled          = parseInt(response.data[0].value["Tiled"]);
        this.jigs.portalsArray   = response.data[0].value["portalsArray"];
        this.jigs.npcArray       = response.data[0].value["NpcArray"];
        this.jigs.mobArray       = response.data[0].value["MobArray"];
        this.jigs.rewardsArray   = response.data[0].value["rewardsArray"];
        this.jigs.nodeTitle      = response.data[0].value["Name"];
        this.jigs.city           = response.data[0].value["City"];
        this.jigs.tilesetArray_1 = response.data[0].value["tilesetArray_1"];
        this.jigs.tilesetArray_2 = response.data[0].value["tilesetArray_2"];
        this.jigs.tilesetArray_3 = response.data[0].value["tilesetArray_3"];
        this.jigs.tilesetArray_4 = response.data[0].value["tilesetArray_4"];
        this.jigs.content        = response.data[0].value["content"];
        // this.jigs.tilesetArray_5 = response.data[0].value["tilesetArray_5"];
        // this.gameState = response.data[0].value[0]
        // this.userMapGrid =  parseInt(response.data[0].value[1])
      });
  },
  methods: {
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;
      axios.get("/mystate?_wrapper_format=drupal_ajax",
          {
            name: this.name,
            description: this.description,
          }).then(function (response) {
          currentObj.jigs.playerName     = response.data[0].value["playerName"];
          currentObj.jigs.playerStats    = response.data[0].value["playerStats"];
          currentObj.jigs.playerId       = parseInt( response.data[0].value["playerId"]);
          currentObj.jigs.gameState      = response.data[0].value["userGamesState"];
          currentObj.jigs.userMapGrid    = parseInt( response.data[0].value["userMapGrid"]);
          currentObj.jigs.tiled          = parseInt( response.data[0].value["Tiled"]);
          currentObj.jigs.portalsArray   = response.data[0].value["portalsArray"];
          currentObj.jigs.npcArray       = response.data[0].value["NpcArray"];
          currentObj.jigs.mobArray       = response.data[0].value["MobArray"];
          currentObj.jigs.rewardsArray   = response.data[0].value["rewardsArray"];
          currentObj.jigs.nodeTitle      = response.data[0].value["Name"];
          currentObj.jigs.city           = response.data[0].value["City"];
          currentObj.jigs.content        = response.data[0].value["content"];
          currentObj.jigs.tilesetArray_1 = response.data[0].value["tilesetArray_1"];
          currentObj.jigs.tilesetArray_2 = response.data[0].value["tilesetArray_2"];
          currentObj.jigs.tilesetArray_3 = response.data[0].value["tilesetArray_3"];
          currentObj.jigs.tilesetArray_4 = response.data[0].value["tilesetArray_4"];
     //   currentObj.counter.tilesetArray_5 = response.data[0].value["tilesetArray_5"];
        })
        .catch(function (error) {
          currentObj.jigs.output = error;
        });
    },
    fight(e) {
      e.preventDefault();
      this.jigs.gameState = "PlayerMain";
      console.log("PlayerMain");
      console.log(this.jigs.userMapGrid);
      console.log(this.jigs.gameState);
      console.log(this.jigs.tiled);
      console.log(this.jigs.portalsArray);
    },
    char(e) {
      e.preventDefault();
      this.jigs.gameState = "Character";
      console.log(this.jigs.userMapGrid);
      console.log(this.jigs.tiled);
      console.log(this.jigs.gameState);
    },
    outpost(e) {
      e.preventDefault();
      this.jigs.gameState = "Outpost";
      console.log(this.jigs.userMapGrid);
      console.log(this.jigs.tiled);
      console.log(this.jigs.gameState);
    },
    temple(e) {
      e.preventDefault();
      this.jigs.gameState = "Temple";
      console.log(this.jigs.userMapGrid);
      console.log(this.jigs.tiled);
      console.log(this.jigs.gameState);
    },
    shop(e) {
      e.preventDefault();
      this.jigs.gameState = "Shop";
      console.log(this.jigs.userMapGrid);
      console.log(this.jigs.tiled);
      console.log(this.jigs.gameState);
    },
    hanger(e) {
      e.preventDefault();
      this.jigs.gameState = "Hanger";
      console.log(this.jigs.gameState);
      console.log(this.jigs.tiled);
      console.log(this.jigs.userMapGrid);
    },
    armoury(e) {
      e.preventDefault();
      this.jigs.gameState = "Armoury";
      console.log(this.jigs.gameState);
      console.log(this.jigs.tiled);
      console.log(this.jigs.userMapGrid);
    },
  },
};
</script>

<template>
  <div class="layout-container">
    <ViewMain :msg="jigs.playerGameState"/>
    <div class="sidebar-2">
      <form @submit="formSubmit" class="tabs">
        <ViewTabs :msg="jigs.gameState" />
        <div class="tab-buttons">
          <CButton @click="char" component="button" color="primary" shape="rounded-pill" size="sm">Char </CButton>
          <CButton @click="outpost" component="button" color="primary" shape="rounded-pill" size="sm">Inv </CButton>
          <CButton @click="hanger" component="button" color="primary" shape="rounded-pill" size="sm">Skills </CButton>
          <CButton @click="armoury" component="button" color="primary" shape="rounded-pill" size="sm">Quests </CButton>
          <CButton @click="fight" component="button" color="primary" shape="rounded-pill" size="sm">Log </CButton>
        </div>
      </form>
    </div>
  </div>
</template>
