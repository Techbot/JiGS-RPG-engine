<script>
import axios from 'axios'
export default {
  data() {
    return {
      posts: []
    }
  },
  mounted() {
    axios
      .get('https://www.eclecticmeme.com/mydata?_wrapper_format=drupal_ajax')
      .then((response) => {
        this.posts = response.data[0].value
      })
  },
  methods: {
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;
      axios.get('https://www.eclecticmeme.com/mydata?_wrapper_format=drupal_ajax', {
        name: this.name,
        description: this.description
      })
        .then(function (response) {
          currentObj.posts = response.data[0].value
        })
        .catch(function (error) {
          currentObj.output = error;
        });
    }
  }
}
</script>

<template>
  <div id="app">
    <div id="phaser-game"></div>
    <form @submit="formSubmit">
      <div class="action-name">name : {{ posts.name }}</div>
      <div id="player">
        <div>Player Level : {{ posts.player_level }}</div>
        <div id="left">
          <div>Strength : {{ posts.player_strength }}</div>
          <div>Dice : {{ posts.player_dice1 }}</div>
          <div>Attack : {{ posts.player_attack }}</div>
        </div>
        <div id="right">
            <div>Stamina : {{ posts.player_stamina }}</div>
            <div>Dice2 : {{ posts.player_dice2 }}</div>
            <div>Defense : {{ posts.player_defense }}</div>
            <div>Health : {{ posts.player_health }}</div>
         </div>
       </div>

      <div id="npc">
        <div>NPC Level : {{ posts.npc_level }}</div>
        <div>NPC Strength : {{ posts.npc_strength }}</div>
        <div>NPC Dice : {{ posts.npc_dice1 }}</div>
        <div>NPC Attack : {{ posts.npc_attack }}</div>
        <div>NPC Stamina : {{ posts.npc_stamina }}</div>
        <div>NPC Dice2 : {{ posts.npc_dice2 }}</div>
        <div>NPC Defense : {{ posts.npc_defense }}</div>
        <div>NPC Health : {{ posts.npc_health }}</div>
      </div>
      <button @click="fight">Fight</button>
    </form>
  </div>
</template>

<style >
#app >form{

  display: flex;
  flex-wrap: wrap;

}
.action-name{

  flex:1 0 100%;

}
#player, #npc {

  flex: 1 0 50%;
  width: 200px;
  border: 3px solid #73AD21;
  padding: 10px;

}
 #left, #right {
   width: 90px;
   flex: 1 0 50%;
   border: 3px solid #73AD21;
   padding: 10px;
 }
</style>
