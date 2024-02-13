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
  <div class="inventory">
    <img src="/assets/images/header.png" />
    <div class="row">
      <div class="col">
        <h3>Storage</h3>
        <draggable class="list-group" :list="jigs.listStorage" group="people"
          @change="log" @end="addToBackpack" :move="updateItem" itemKey="name">
          <template #item="{ element, index }">
            <div class="list-group-item">{{ element.name }} {{ index }}</div>
          </template>
        </draggable>
      </div>
      <div class="col">
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
<style>
/* Inventory */
.inventory h3 {
  margin-top: 1rem;
}

.inventory img {
  margin-bottom: 1rem;
}

.list-group {
  display: flex;
  padding: 0.5rem;
  gap: 0.5rem;
  flex-wrap: wrap;
  flex-direction: row;
  align-content: flex-start;
  height: 100%;
  min-height: 184px; /* Two rows */
  background-color: #111;
}

.list-group-item {
  max-width: 20%;
  min-height: 80px;
  flex: 1 0 20%;
  border: 0 none;
  border-radius: 0;
  text-align: center;
  font-size: 0.75rem;
  padding: 0.25rem;
  background-color: #000;
}

.list-group-item:hover,
.list-group-item.sortable-chosen {
  border: 2px solid red;
  background: #222;
}
.list-group-item.sortable-chosen {
  box-shadow: 0px 0px 0px 5px #111111, inset 0px 10px 27px -8px #141414, inset 0px -10px 27px -8px #A31925, 5px 5px 15px 5px rgba(0,0,0,0);
}

.list-group-item:first-child,
.list-group-item:last-child {
  border-radius: 0;
}
</style>
