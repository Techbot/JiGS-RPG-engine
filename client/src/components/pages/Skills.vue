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
              expanded: true,
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

<style>
  /* Skills tree */
  .grtv-wrapper.grtv-default-skin > .grtv {
    margin: 0;
    padding: 0;
    list-style: none;
    background-color: #111;
    padding: 1rem;
    font-size: 1.25rem;
  }

  /* Everything's in a .grtv-wrapper (embedded CSS is the 'grtv-default-skin' skin) */
  .grtv-wrapper.grtv-default-skin {
    --baseHeight: 2rem;
    --itemSpacing: 2rem;
  }

  /* The node, including its content and children list */
  .grtv-wrapper.grtv-default-skin .grtvn {
    padding-left: 0;
  }

  .grtv-wrapper.grtv-default-skin .grtvn:first-child {
    margin-top: 0;
  }

  /* ARIA styles */
  .grtv-wrapper.grtv-default-skin .grtvn[role="treeitem"]:focus {
    outline: 0;
  }

  /* .grtv-wrapper.grtv-default-skin .grtvn[role="treeitem"]:focus >.grtvn-self {
    outline: black dotted 1px;
  } */

  /* The node's content, excluding the list of child nodes */
  .grtv-wrapper.grtv-default-skin .grtvn-self {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-items: center;
    gap: 1rem;
    /* line-height: 2rem; */
    margin-bottom: 1rem;
  }
  .grtv-wrapper.grtv-default-skin .grtvn-children .grtvn-children .grtvn-self {
    margin-bottom: 0;
  }
  /* Drag and Drop styles */
  .grtv-wrapper.grtv-default-skin .grtvn-dragging .grtvn-self {
    opacity: 0.5;
  }

  .grtv-wrapper.grtv-default-skin .grtvn-self-drop-target {
    flex-wrap: wrap;
  }

  .grtv-wrapper.grtv-default-skin .grtvn-self-drop-target.grtvn-self-child-drop-target {
    opacity: .5;
  }

  .grtv-wrapper.grtv-default-skin .grtvn-self-drop-target .grtvn-self-sibling-drop-target {
    width: 100%;
    height: 7px;
    background-color: #dddddd;
  }

  .grtv-wrapper.grtv-default-skin .grtvn-self-drop-target .grtvn-self-sibling-drop-target.grtvn-self-sibling-drop-target-hover {
    background-color: #bbbbbb;
  }

  /* The expander button and indicator content */
  .grtv-wrapper.grtv-default-skin .grtvn-self-expander {
    /* padding: 0; */
    /* background: none; */
    /* border: none; */
    /* height: var(--baseHeight); */
  }

  .grtv-wrapper.grtv-default-skin .grtvn-self-expander i.grtvn-self-expanded-indicator {
    font-style: normal;
    color: white;
  }

  .grtv-wrapper.grtv-default-skin .grtvn-self-expander i.grtvn-self-expanded-indicator::before {
    content: '+';
  }

  .grtv-wrapper.grtv-default-skin .grtvn-self-expander.grtvn-self-expanded i.grtvn-self-expanded-indicator::before {
    content: '-';
  }

  /* The styling for when the node is selected */
  .grtv-wrapper.grtv-default-skin .grtvn-self-selected {
    background-color: #f0f0f8;
  }

  /* Spacing */
  .grtv-wrapper.grtv-default-skin .grtvn-self-expander,
  .grtv-wrapper.grtv-default-skin .grtvn-self-checkbox,
  .grtv-wrapper.grtv-default-skin .grtvn-self-radio,
  /* .grtv-wrapper.grtv-default-skin .grtvn-self-spacer, */
  .grtv-wrapper.grtv-default-skin .grtvn-self-action {
    min-width: 1rem;
    flex: 0 1 2rem;
    background-color: var(--emc-teal-alt);
    font-weight: 700;
    font-size: 1.5rem;
    padding: 0.5rem;
    border: 4px solid transparent;
  }

  .grtvn-self-expander:hover,
  .grtvn-self-expander:focus {
    border: 4px solid var(--emc-teal-dark-alt);
  }
  .grtvn-self-expander:focus {
    border-color: var(--emc-teal-alt);
  }

  .grtv-wrapper.grtv-default-skin .grtvn-self-expander,
  .grtv-wrapper.grtv-default-skin .grtvn-self-spacer {
    margin: 0;
  }

  .grtv-wrapper.grtv-default-skin .grtvn-self-checkbox,
  .grtv-wrapper.grtv-default-skin .grtvn-self-radio {
    /* margin: 0 0 0 calc(-1 * var(--itemSpacing)); */
    width: 1.5rem;
    height: 1.5rem;
  }

  .grtv-wrapper.grtv-default-skin .grtvn-self-text,
  .grtv-wrapper.grtv-default-skin .grtvn-self-label {
    /* margin-left: var(--itemSpacing); */
  }

  .grtvn-self-label {
    font-family: "Neutron Demo";
    font-size: 1.75rem;
  }

  /* Action buttons section */
  .grtv-wrapper.grtv-default-skin .grtvn-self-action {
    /* padding: 0; */
    /* background: none; */
    /* border: none; */
    /* height: var(--baseHeight); */
  }

  /* Action buttons (add, delete, etc) */
  .grtv-wrapper.grtv-default-skin i.grtvn-self-add-child-icon {
    font-style: normal;
  }

  .grtv-wrapper.grtv-default-skin i.grtvn-self-add-child-icon::before {
    content: '+';
  }

  .grtv-wrapper.grtv-default-skin i.grtvn-self-delete-icon {
    font-style: normal;
    color: white;
  }

  .grtv-wrapper.grtv-default-skin i.grtvn-self-delete-icon::before {
    content: 'x';
  }

  .grtv-wrapper.grtv-default-skin .grtvn-children-wrapper {
    margin: 0 0 0 calc(1rem + var(--itemSpacing));
  }

  /* The node's child list */
  .grtv-wrapper.grtv-default-skin .grtvn-children {
    padding: 0;
    list-style: none;
    margin-bottom: 2rem;
  }

  .grtv-wrapper.grtv-default-skin .grtvn.grtvn-hidden {
    display: none;
  }

  .grtvn-children-wrapper > ul > li > .grtvn-children-wrapper > .grtvn-children {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-column-gap: 1rem;
    grid-row-gap: 1rem;
    grid-template-areas:s
      "level1 level2 level3 level4"
  }

  .grtvn-children-wrapper > ul > li > .grtvn-children-wrapper > .grtvn-children > li {
    background-color: var(--emc-dark);
  }
  .grtv-wrapper.grtv-default-skin .grtvn-self-action {
    background-color: var(--emc-black);
  }
  .grtvn-self-action:hover,
  .grtvn-self-action:focus {
    border: 4px solid var(--emc-black-rich);
  }
  .grtvn-self-action:focus {
    border-color: var(--emc-teal-alt);
  }



</style>
