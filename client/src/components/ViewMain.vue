<script>
import GamePhaser    from './GamePhaser.vue';
import GameWeb  from './GameWeb.vue';

import { useJigsStore } from "../stores/jigs";

export default {
  components: {
    GameWeb,
    GamePhaser
  },
  setup() {
    const jigs = useJigsStore();
    return {
      jigs,
    };
  },
  props: {
    msg: String
  }
}
</script>

<template>
<div class="main">
<component :is=msg />
</div>
</template>


