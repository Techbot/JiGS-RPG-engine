<script>
import { reactive } from 'vue'
// Import all of CoreUI's JS
import * as coreui from '@coreui/coreui'
import draggable from 'vuedraggable';
import { useJigsStore } from "../stores/jigs";

import Inventory from "./pages/Inventory.vue";
import Character from "./pages/Character.vue";
import Crafting from "./pages/Crafting.vue";
import Maps from "./pages/Maps.vue";
import Skills from "./pages/Skills.vue";
import Quests from "./pages/Quests.vue";
import Logs from "./pages/Logs.vue";
import GamePhaser from './pages/GamePhaser.vue';
import Messenger from '../components/messenger/Messenger.vue';


export default {
  components: {
    draggable,
    Crafting,
    Maps,
    Skills,
    Inventory,
    Character,
    Logs,
    Quests,
    coreui,
    GamePhaser,
    Messenger
  },
  data() {
    return {
      gameState: [],
   //   tabPaneActiveKey: 1
    };

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

    <section class="messenger">
      <Messenger />
    </section>

  </div>
  </template>

