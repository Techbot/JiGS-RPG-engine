<script >
import axios from 'axios'
import { useCounterStore } from '@/stores/counter'
import BuildingMain from '@/components/BuildingMain';
import PhaserGame from '@/components/PhaserGame'

export default {
  components: {
    BuildingMain,
    PhaserGame
  },
  setup() {
    const counter = useCounterStore()
    return {
      counter
    }
  },

  data() {
    return {
      gameState: []
      }
    },
  mounted() {
    this.counter = useCounterStore()

    axios
      .get('https://www.eclecticmeme.com/mystate?_wrapper_format=drupal_ajax')
      .then((response) => {
        this.counter.gameState = response.data[0].value[0]
        this.counter.userMapGrid = response.data[0].value[1]
        //this.gameState = response.data[0].value[0]
        //this.userMapGrid = response.data[0].value[1]
      })
  },

  methods: {
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;
      axios.get('https://www.eclecticmeme.com/mystate?_wrapper_format=drupal_ajax', {
        name: this.name,
        description: this.description
      })
        .then(function (response) {
          currentObj.counter.gameState = response.data[0].value[0]
          currentObj.counter.userMapGrid = response.data[0].value[1]
        })
        .catch(function (error) {
          currentObj.counter.output = error;
        });
    },
    fight(e) {
      e.preventDefault();
      this.counter.gameState = 'PlayerMain';
      console.log('PlayerMain');
      console.log(this.counter.userMapGrid);
      console.log(this.counter.gameState);

    },
    bank(e) {
      e.preventDefault();
      this.counter.gameState = 'Bank';
      console.log(this.counter.userMapGrid);
      console.log(this.counter.gameState);
    },
    outpost(e) {
      e.preventDefault();
      this.counter.gameState = 'Outpost';
      console.log(this.counter.userMapGrid);
      console.log(this.counter.gameState);
    },
    temple(e) {
      e.preventDefault();
      this.counter.gameState = 'Temple';
      console.log(this.counter.userMapGrid);
      console.log(this.counter.gameState);
    },
    shop(e) {
      e.preventDefault();
      this.counter.gameState = 'Shop';
      console.log(this.counter.userMapGrid);
      console.log(this.counter.gameState);
    },
    hanger(e) {
      e.preventDefault();
      this.counter.gameState = 'Hanger';
      console.log(this.counter.gameState);
      console.log(this.counter.userMapGrid);
    },
    armoury(e) {
      e.preventDefault();
      this.counter.gameState = 'Armoury';
      console.log(this.counter.gameState);
      console.log(this.counter.userMapGrid);
    },
   }
};
</script>

<template>
  <div>
  <PhaserGame />
  <div>

  <form @submit="formSubmit">
    <BuildingMain :msg="counter.gameState" />
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
  </div>
</template>
