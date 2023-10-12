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
    /*     axios
          .get("/mystorage?_wrapper_format=drupal_ajax")
          .then((response) => {
         // this.jigs.playerStorage = response.data[0].value["playerStorage"].storeItems;
          }); */
    this.jigs.myInventory();
  },
  computed: {
    draggingInfo() {
      return this.dragging ? "under drag" : "";
    }
  },
  methods: {
    add: function () {
      this.list.push({ name: "Juan " + id, id: id++ });
    },
    replace: function () {
      this.list = [{ name: "Edgard", id: id++ }];
    },
    addToStorage: function () {
      axios
        .get("/tostorage?_wrapper_format=drupal_ajax&id=" +  this.jigs.item)
        .then((response) => {
          this.jigs.divideInventory(response);
        });
      console.log("Storage : " +  this.jigs.item);
    },
    addToBackpack: function () {
      axios
        .get("/tobackpack?_wrapper_format=drupal_ajax&id=" +  this.jigs.item)
        .then((response) => {
          this.jigs.divideInventory(response);
        });
      console.log("Backpack : " +  this.jigs.item);
    },
    updateItem(e){
      this.jigs.item = e.draggedContext.element.id;
    },
  }
};
</script>

<template>
  <div>
    <img src="/assets/images/header.png" />
    <div class="row">
      <div class="col-3">
        <h3>Storage</h3>
        <draggable class="list-group" :list="jigs.listStorage" group="people"
          @change="log" @end="addToBackpack" :move="updateItem" itemKey="name">
          <template #item="{ element, index }">
            <div class="list-group-item">{{ element.name }} {{ index }}</div>
          </template>
        </draggable>
      </div>
      <div class="col-3">
        <h3>Backpack</h3>
        <draggable class="list-group" :list="jigs.listBackpack" group="people"
          @change="log" itemKey="name" @end="addToStorage" :move="updateItem" >
          <template #item="{ element, index }">
            <div class="list-group-item">{{ element.name }} {{ index }}</div>
          </template>
        </draggable>
      </div>
    </div>
  </div>
</template>
