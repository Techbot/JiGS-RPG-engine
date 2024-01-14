<script>
import axios from "axios";
import { useJigsStore } from "../../stores/jigs";
import * as coreui from '@coreui/coreui'
export default {
  components: {
    coreui
  }, setup() {
    const jigs = useJigsStore();
    return {
      jigs,
    };
  },
  data() {
    return {
      playerQuests: [],
    };
  },
  mounted() {
     this.jigs = useJigsStore();
    axios
      .get("/mymissions?_wrapper_format=drupal_ajax")
      .then((response) => {
        this.jigs.playerQuests = response.data[0].value["playerMissions"];
      });
  }
}
</script>

<template>
  <div class="quests">
    <!-- <img src="/assets/images/header2.png" /> -->
    <div class="accordion accordion-flush" id="accordionFlushExample" v-for="quest in jigs.playerQuests.quests" :key="quest.id">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button"
            data-coreui-toggle="collapse" data-coreui-target="#flush-collapseOne"
            aria-expanded="false" aria-controls="flush-collapseOne">
              Id: {{ quest.id }} => Name: {{ quest.title ? quest.title : 'Quest Title' }}
          </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse"
          data-coreui-parent="#accordionFlushExample">
          <div class="accordion-body">{{ quest.content ? quest.content : 'Content of the quest.' }}</div>
        </div>
      </div>
    </div>
  </div>
</template>
