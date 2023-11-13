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
          id: "Skills",
          label: "Skills",
          treeNodeSpec: {
            expandable: true,
            selectable: true,
            deletable: true,
            input: {
              type: 'checkbox',
              name: 'checkbox1'
            },
            state: {
              expanded: false,
              selected: false,
              input: {
                value: false,
                disabled: false
              }
            }
          },
          children: [
            {
              id: 1,
              label: "Lock Picking",
                treeNodeSpec: {
                expandable: true,
                selectable: true,
                deletable: true,
                input: {
                  type: 'checkbox',
                  name: 'checkbox1'
                },
                state: {
                  expanded: false,
                  selected: false,
                  input: {
                    value: false,
                    disabled: false
                  }
                }
              },
              children: [
                { id: 1, label: "Level One" }, { id: 1, label: "Level Two" },
                { id: 1, label: "Level Three" }, { id: 1, label: "Level Four" }
              ]
            },

            {
              id: "node2",
              label: "Melee",
              treeNodeSpec: {
                expandable: true,
                selectable: true,
                deletable: true,
                input: {
                  type: 'checkbox',
                  name: 'checkbox1'
                },
                state: {
                  expanded: false,
                  selected: false,
                  input: {
                    value: false,
                    disabled: false
                  }
                }
              },
              children: [
                { id: 1, label: "Level One" }, { id: 1, label: "Level Two" },
                { id: 1, label: "Level Three" }, { id: 1, label: "Level Four" }
              ]
            },
            {
              id: 1,
              label: "Range",
              treeNodeSpec: {
                expandable: true,
                selectable: true,
                deletable: true,
                input: {
                  type: 'checkbox',
                  name: 'checkbox1'
                },
                state: {
                  expanded: false,
                  selected: false,
                  input: {
                    value: false,
                    disabled: false
                  }
                }
              },
              children: [
                { id: 1, label: "Level One" }, { id: 1, label: "Level Two" },
                { id: 1, label: "Level Three" }, { id: 1, label: "Level Four" }
              ]
            },
            {
              id: "node2", label: "Heal", treeNodeSpec: {
                state: {
                  expanded: false,
                }
              },
              children: [
                { id: 1, label: "Level One" }, { id: 1, label: "Level Two" },
                { id: 1, label: "Level Three" }, { id: 1, label: "Level Four" }
              ],
            }
          ]
        }
      ]
    }
  }
}
</script>

<template>
  <tree-view id="my-tree" :initial-model="dataModel"></tree-view>
</template>
