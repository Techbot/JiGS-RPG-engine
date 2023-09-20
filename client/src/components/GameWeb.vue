<script>
import { reactive } from 'vue'
// Import all of CoreUI's JS
import * as coreui from '@coreui/coreui'
import draggable from 'vuedraggable';
import { useJigsStore } from "../stores/jigs";
import Crafting from "./pages/Crafting.vue";
import Maps from "./pages/Maps.vue";
import Skills from "./pages/Skills.vue";

export default {
  components: {
    draggable, Crafting, Maps, Skills
  },
  data() {
    return {
      coreui,
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
      tabPaneActiveKey: 1,
    };
  },
  methods: {
    add: function () {
      this.list.push({ name: "Juan" });
    },
    replace: function () {
      this.list = [{ name: "Edgard" }];
    },
    clone: function (el) {
      return {
        name: el.name + " cloned"
      };
    },
    log: function (evt) {
      window.console.log(evt);
    }
    ,
    setup() {
      d3.csv(
        'https://raw.githubusercontent.com/bumbeishvili/sample-data/main/org.csv'
      ).then((dataFlattened) => {
        dataFlattened.forEach((d) => {
          const val = Math.round(d.name.length / 2);
          d.progress = [...new Array(val)].map((d) => Math.random() * 25 + 5);
        });
        new OrgChart()
          .container('.skills')
          .data(dataFlattened) //
          .render();
      });
      const jigs = useCounterStore();
      return {
        jigs,
      };
    },
    props: {
      msg: String
    }
  }
}
</script>

<template>
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-profile-tab"
        data-coreui-toggle="tab" data-coreui-target="#nav-profile" type="button"
        role="tab" aria-controls="nav-profile" aria-selected="false">Char</button>
      <button class="nav-link" id="nav-inv-tab" data-coreui-toggle="tab"
        data-coreui-target="#nav-inv" type="button" role="tab"
        aria-controls="nav-inv" aria-selected="true">Inv</button>
      <button class="nav-link" id="nav-skill-tab" data-coreui-toggle="tab"
        data-coreui-target="#nav-skills" type="button" role="tab"
        aria-controls="nav-skills" aria-selected="false">Skills</button>
      <button class="nav-link" id="nav-contact-tab" data-coreui-toggle="tab"
        data-coreui-target="#nav-contact" type="button" role="tab"
        aria-controls="nav-contact" aria-selected="false">Quests</button>
      <button class="nav-link" id="nav-logs-tab" data-coreui-toggle="tab"
        data-coreui-target="#nav-logs" type="button" role="tab"
        aria-controls="nav-logs" aria-selected="false">Logs</button>
      <button class="nav-link" id="nav-crafting-tab" data-coreui-toggle="tab"
        data-coreui-target="#nav-crafting" type="button" role="tab"
        aria-controls="nav-crafting" aria-selected="false">Crafting</button>
      <button class="nav-link" id="nav-maps-tab" data-coreui-toggle="tab"
        data-coreui-target="#nav-maps" type="button" role="tab"
        aria-controls="nav-maps" aria-selected="false">Maps</button>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">

    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
      aria-labelledby="nav-profile-tab" tabindex="0">
      <video width="640" height="480" controls="false" autoplay="true"
        playsinline="true" muted="" loop="">
        <source src="/assets/images/Skeleton_All_SD.mp4" type="video/mp4">
      </video>
    </div>
    <div class="tab-pane fade " id="nav-inv" role="tabpanel"
      aria-labelledby="nav-inv-tab" tabindex="0">
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

    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
      aria-labelledby="nav-contact-tab" tabindex="0">
      <img src="/assets/images/header2.png" />

      <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
              data-coreui-toggle="collapse"
              data-coreui-target="#flush-collapseOne" aria-expanded="false"
              aria-controls="flush-collapseOne">
              Accordion Item #1
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse"
            data-coreui-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder content for this accordion,
              which is intended to demonstrate the <code>.accordion-flush</code>
              class. This is the first item's accordion body.</div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
              data-coreui-toggle="collapse"
              data-coreui-target="#flush-collapseTwo" aria-expanded="false"
              aria-controls="flush-collapseTwo">
              Accordion Item #2
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse"
            data-coreui-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder content for this accordion,
              which is intended to demonstrate the <code>.accordion-flush</code>
              class. This is the second item's accordion body. Let's imagine this
              being filled with some actual content.</div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
              data-coreui-toggle="collapse"
              data-coreui-target="#flush-collapseThree" aria-expanded="false"
              aria-controls="flush-collapseThree">
              Accordion Item #3
            </button>
          </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse"
            data-coreui-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder content for this accordion,
              which is intended to demonstrate the <code>.accordion-flush</code>
              class. This is the third item's accordion body. Nothing more
              exciting happening here in terms of content, but just filling up the
            space to make it look, at least at first glance, a bit more
            representative of how this would look in a real-world application.
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="tab-pane fade" id="nav-logs" role="tabpanel"
    aria-labelledby="nav-logs-tab" tabindex="0">
    <img src="/assets/images/header2.png" />
    Logs
  </div>

  <div class="tab-pane fade" id="nav-skills" role="tabpanel"
    aria-labelledby="nav-skills-tab" tabindex="0">
    <Skills />
  </div>


  <div class="tab-pane fade" id="nav-maps" role="tabpanel"
    aria-labelledby="nav-maps-tab" tabindex="0">
    <Maps />
  </div>

  <div class="tab-pane fade" id="nav-crafting" role="tabpanel"
    aria-labelledby="nav-crafting-tab" tabindex="0">
    <Crafting />
  </div>

</div>

</template>
