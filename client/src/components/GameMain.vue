<script>
import axios from 'axios'
import BuildingMain from './BuildingMain.vue';
export default {
  components: {
    BuildingMain

  },
  props: {
    msg: String
  }  ,
  data() {
    return {
      gameState: []
    }
  },
  mounted() {
    axios
      .get('https://www.eclecticmeme.com/gameState?_wrapper_format=drupal_ajax')
      .then((response) => {
        this.gameState = response.data[0].value
      })
  },
  methods: {
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;
      axios.get('https://www.eclecticmeme.com/gameState?_wrapper_format=drupal_ajax', {
        name: this.name,
        description: this.description
      })
        .then(function (response) {
          currentObj.gameState = response.data[0].value
        })
        .catch(function (error) {
          currentObj.output = error;
        });
    },
    fight(e) {
      e.preventDefault();
      this.gameState = ['PlayerMain'];
      console.log('fight');
      console.log(this.gameState);

    },
    bank(e) {
      e.preventDefault();
      this.gameState = ['BankBuilding'];
      console.log('bank')
      console.log(this.gameState);
    },
    outpost(e) {
      e.preventDefault();
      this.gameState = ['OutpostBuilding'];
      console.log('outpost')
      console.log(this.gameState);
    },
    temple(e) {
      e.preventDefault();
      this.gameState = ['TempleBuilding'];
      console.log('temple');
      console.log(this.gameState);
    },
    shop(e) {
      e.preventDefault();
      this.gameState = ['ShopBuilding'];
      console.log('shop');
      console.log(this.gameState);

    },
    hanger(e) {
      e.preventDefault();
      this.gameState = ['HangerBuilding'];
      console.log('hanger');
      console.log(this.gameState);
    },
    armoury(e) {
      e.preventDefault();
      this.gameState = ['ArmouryBuilding'];
      console.log('armoury');
      console.log(this.gameState);
    },
  }
}
</script>

<template>
<div>
    <form @submit="formSubmit">
<component :is="msg" :msg="gameState" />
      <div id="Game">
        <button @click="bank">Bank</button>
        <button @click="outpost">Outpost</button>
        <button @click="temple">Temple</button>
        <button @click="shop">Shop</button>
        <button @click="hanger">Hanger</button>
        <button @click="armoury">Armoury</button>
        <button @click="fight">Fight</button>
      </div>

    </form>
</div>
</template>


