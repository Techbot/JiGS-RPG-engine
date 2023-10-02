<script>
import { TreeView } from "@grapoza/vue-tree"

export default {
  components: {
    TreeView
  },
  data() {
    return {
      dataModel: [
        {
          id: "numberOrString",
          label: "Root Node",
          children: [
            {id: 1, label: "Child Node"},
            {id: "node2", label: "Second Child"}
          ]
        }
      ]
    }
  }
}
</script>


<template>
  <tree-view  id="my-tree" :initial-model="dataModel"></tree-view>
</template>
