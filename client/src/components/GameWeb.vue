<script>
import { reactive } from 'vue'
// Import all of CoreUI's JS
import * as coreui from '@coreui/coreui'
import draggable from 'vuedraggable';
import { useJigsStore } from "../stores/jigs";

import Inv from "./pages/Inv.vue";
import Char from "./pages/Char.vue";
import Crafting from "./pages/Crafting.vue";
import Maps from "./pages/Maps.vue";
import Skills from "./pages/Skills.vue";
import Quests from "./pages/Quests.vue";
import Logs from "./pages/Logs.vue";

export default {
  components: {
    draggable, Crafting, Maps, Skills, Inv, Char, Logs, Quests, coreui
  },
  data() {
    return {
      tabPaneActiveKey: 1
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
  <div>
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-profile-tab"
          data-coreui-toggle="tab" data-coreui-target="#nav-profile" type="button"
          role="tab" aria-controls="nav-profile"
          aria-selected="false">Char</button>
        <button class="nav-link" id="nav-inv-tab" data-coreui-toggle="tab"
          data-coreui-target="#nav-inv" type="button" role="tab"
          aria-controls="nav-inv" aria-selected="true">Inv</button>
        <button class="nav-link" id="nav-skill-tab" data-coreui-toggle="tab"
          data-coreui-target="#nav-skills" type="button" role="tab"
          aria-controls="nav-skills" aria-selected="false">Skills</button>
        <button class="nav-link" id="nav-quests-tab" data-coreui-toggle="tab"
          data-coreui-target="#nav-quests" type="button" role="tab"
          aria-controls="nav-quests" aria-selected="false">Quests</button>
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

    <!-- //  Tab Holder -->
    <div class="tab-content" id="nav-tabContent">

      <!-- //  Tab  -->
      <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
        aria-labelledby="nav-profile-tab" tabindex="0">
        <Char />
      </div>

      <!-- //  Tab  -->
      <div class="tab-pane fade " id="nav-inv" role="tabpanel"
        aria-labelledby="nav-inv-tab" tabindex="0">
        <Inv />
      </div>

      <!-- //  Tab  -->
      <div class="tab-pane fade" id="nav-quests" role="tabpanel"
        aria-labelledby="nav-quests-tab" tabindex="0">
        <Quests />
      </div>

      <!-- //  Tab  -->
      <div class="tab-pane fade" id="nav-logs" role="tabpanel"
        aria-labelledby="nav-logs-tab" tabindex="0">
        <Logs />
      </div>

      <!-- //  Tab  -->
      <div class="tab-pane fade" id="nav-skills" role="tabpanel"
        aria-labelledby="nav-skills-tab" tabindex="0">
        <Skills />
      </div>

      <!-- //  Tab  -->
      <div class="tab-pane fade" id="nav-maps" role="tabpanel"
        aria-labelledby="nav-maps-tab" tabindex="0">
        <Maps />
      </div>

      <!-- //  Tab  -->
      <div class="tab-pane fade" id="nav-crafting" role="tabpanel"
        aria-labelledby="nav-crafting-tab" tabindex="0">
        <Crafting />
      </div>
    </div>
    <!-- //  Tab Holder -->
  </div>
</template>
