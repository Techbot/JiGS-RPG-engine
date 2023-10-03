<script>
import axios from "axios";
import { useJigsStore } from "../../stores/jigs";
import * as coreui from '@coreui/coreui'
import draggable from 'vuedraggable';

export default {
  components: {
    draggable, coreui
  },
     setup() {
    const jigs = useJigsStore();
    return {
      jigs,
    };
  },
  data() {
    return {
      playerStorage: [],
      playerInventory: [],
    };
  },
  mounted() {
    this.jigs = useJigsStore();
    axios
      .get("/mystorage?_wrapper_format=drupal_ajax")
      .then((response) => {
      this.jigs.playerStorage = response.data[0].value["playerStorage"].storeItems;
      });

    axios
      .get("/myinventory?_wrapper_format=drupal_ajax")
      .then((response) => {
        this.jigs.playerInventory = response.data[0].value["playerInventory"].items;
      });
    }
}
</script>

<template>
  <div>
    <img src="/assets/images/header.png" />
    <div class="row">
      <div class="col-3">
        <h3>Storage</h3>
        <draggable class="list-group" :list="jigs.playerStorage" group="people" @change="log"
          itemKey="name">
          <template #item="{ element, index }">
            <div class="list-group-item">{{ element.name }} {{ index }}</div>
          </template>
        </draggable>
      </div>
      <div class="col-3">
        <h3>Backpack</h3>
        <draggable class="list-group" :list="jigs.playerInventory" group="people" @change="log"
          itemKey="name">
          <template #item="{ element, index }">
            <div class="list-group-item">{{ element.name }} {{ index }}</div>
          </template>
        </draggable>
      </div>
    </div>
  </div>
</template>
