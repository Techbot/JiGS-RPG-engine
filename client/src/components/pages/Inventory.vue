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
        <draggable class="inventory__storage list-group" :list="jigs.listStorage" group="people"
          @change="log" @end="addToBackpack" :move="updateItem" itemKey="name">
          <template #item="{ element, index }">
            <div class="inventory__item list-group-item">
              <label>{{ element.name }}
                <!-- {{ index }} -->
              </label>
              <img src="/sites/default/files/weapons/W_Sword017.png" alt="" width="34" height="34"/>
            </div>
          </template>
        </draggable>
      </div>
      <div class="col">
        <h3>Backpack</h3>
        <draggable class="inventory__backpack list-group" :list="jigs.listBackpack" group="people"
          @change="log" itemKey="name" @end="addToStorage" :move="updateItem" >
          <template #item="{ element, index }">
            <div class="inventory__item list-group-item">
              <label>{{ element.name }}
                <!-- {{ index }} -->
              </label>
              <img src="sites/default/files/items/W_Gold_Mace.png" alt="" width="34" height="34"/>
            </div>
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

.inventory__item {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  max-width: 20%;
  min-height: 80px;
  flex: 1 0 20%;
  border: 2px solid transparent;
  border-radius: 0;
  text-align: center;
  font-size: 0.75rem;
  padding: 0.25rem;
  background-color: #000;
}

.inventory > img {
  margin-block-end: 1rem;
}

.inventory__item label {
  display: inline-block;
  font-size: 12px;
  font-weight: 700;
  margin-block-end: 0.5rem;
  text-transform: uppercase;
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

.inventory__item img {
  margin: 0 auto;
  margin-block-end: 0.5rem;
}

.inventory__item:hover,
.inventory__item.sortable-chosen {
  border: 2px solid red;
  background: #222;
}

.inventory__item.sortable-chosen {
  box-shadow: 0px 0px 0px 5px #111111, inset 0px 10px 27px -8px #141414, inset 0px -10px 27px -8px #A31925, 5px 5px 15px 5px rgba(0,0,0,0);
}

.inventory__item:first-child,
.inventory__item:last-child {
  border-radius: 0;
}
</style>
