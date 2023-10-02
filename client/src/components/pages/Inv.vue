<script>
import { useJigsStore } from "../../stores/jigs";
import * as coreui from '@coreui/coreui'
import draggable from 'vuedraggable';
export default {
  components: {
    draggable, coreui
  },
  data() {
    return {
         list1: [
        { name: "John", id: 1 },
        { name: "Joao", id: 2 },
        { name: "Jean", id: 3 },
        { name: "Gerard", id: 4 },
        { name: "John", id: 8 },
        { name: "Joao", id: 9 },
        { name: "Jean", id: 10 },
        { name: "Gerard", id: 11 }
      ],
      list2: [
        { name: "Juan", id: 5 },
        { name: "Edgard", id: 6 },
        { name: "Johnson", id: 7 }
      ],
    };
  }
}
</script>


<template>
  <div>
    <img src="/assets/images/header.png" />
    <div class="row">
      <div class="col-3">
        <h3>Storage</h3>
        <draggable class="list-group" :list="list1" group="people" @change="log"
          itemKey="name">
          <template #item="{ element, index }">
            <div class="list-group-item">{{ element.name }} {{ index }}</div>
          </template>
        </draggable>
      </div>
      <div class="col-3">
        <h3>Backpack</h3>
        <draggable class="list-group" :list="list2" group="people" @change="log"
          itemKey="name">
          <template #item="{ element, index }">
            <div class="list-group-item">{{ element.name }} {{ index }}</div>
          </template>
        </draggable>
      </div>

      <rawDisplayer class="col-3" :value="list1" title="List 1" />
      <rawDisplayer class="col-3" :value="list2" title="List 2" />
    </div>
  </div>
</template>
