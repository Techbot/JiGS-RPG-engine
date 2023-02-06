<script >
import axios from 'axios'
import { useCounterStore } from '@/stores/counter'
import GameMain from './components/GameMain.vue'
import PhaserGame from '@/components/PhaserGame'

export default {
  components: {
    GameMain,
    PhaserGame
  },
  data() {
    return {
      page: "BuildingMain",
      posts: []
      }
    },
  mounted() {
    axios
      .get('https://www.eclecticmeme.com/myState?_wrapper_format=drupal_ajax')
      .then((response) => {
        this.posts = response.data[0].value
      })
  },
  setup() {
    const counter = useCounterStore()

    function makeCoffee() {
      counter.Blobby++
    }
    counter.increment()
    return {
      counter,
      makeCoffee
    }

  },
  };

</script>

<template>
  <div>
    <div>

      <div id = "_____________phaser-game"></div>


    <GameMain :msg="page"  />
    </div>
    <button @click="makeCoffee">
    {{ counter.Blobby }}
    </button>

  <PhaserGame />

  </div>
</template>
