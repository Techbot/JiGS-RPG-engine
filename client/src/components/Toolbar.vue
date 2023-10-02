
<script>
import { useJigsStore } from "../stores/jigs";

export default {
  mounted() {
    this.jigs = useJigsStore();
  },
  methods: {
    formSubmit(e) {
     e.preventDefault();
      },

    PhaserGame(e) {
      e.preventDefault();
      this.jigs.playerGameState = "GamePhaser";

    },
    WebGame(e) {
      e.preventDefault();
      this.jigs.playerGameState = "GameWeb";
      this.jigs.leave = 1;
    },
  },
};
</script>
<template>
      <form @submit="formSubmit">
        <div id="Toolbar">
          <button id="textButton" @click="WebGame">HQ</button>
        </div>
      </form>
</template>

<style>

#textButton{
    background:none;
    border:none;
}
#textButton:hover{
    background-color: green;
}
</style>
