<script>
import axios from "axios";
import { useJigsStore } from "../../stores/jigs";
export default {
  setup() {
    const jigs = useJigsStore();
    return {
      jigs,
    };
  },
  data() {
    return {
      // playerLogs: [],
      playerLogs: [
        { id: 0, title: "Log One" },
        { id: 1, title: "Log Two" },
        { id: 2, title: "Log Three" },
      ],
      timestamp: "",
    };
  },
  created() {
      setInterval(this.getNow, 1000);
  },
  methods: {
    getNow: function() {
      const today = new Date();
      const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
      const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      const dateTime = date +' '+ time;
      this.timestamp = dateTime;
    }
  }
  // mounted() {
  //    this.jigs = useJigsStore();
  //   axios
  //     .get("/mylogs?_wrapper_format=drupal_ajax")
  //     .then((response) => {
  //       this.jigs.playerLogs = response.data[0].value["playerLogs"];
  //     });
  // }
}
</script>

<template>
  <div class="logs">
    <div class="log" v-for="log in playerLogs" :key="log.id">
      <img class="log__thumbnail" src="/gui/log.png" alt="log type thumbnail" />
      <h2 class="log__heading">
          {{ log.id }}: {{ log.title ? log.title : 'Log Title' }}
      </h2>
      <div class="log__body">
        {{ log.content ? log.content : 'Content of the log.' }}
        <small> {{ timestamp }}</small>
      </div>
    </div>
  </div>
</template>

<style>
  .log {
    background: var(--emc-black);
    color: white;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    margin-bottom: 1rem;
  }

  .log__heading {
    color: #fff;
    background-color: var(--emc-black);
    font-family: Neutron Demo;
    font-size: 1.5rem;
    font-weight: 700;
  }

  .log__thumbnail {
    flex: 0 1 34px;
    margin-right: 0.25rem;
  }

  .log__body {
    background-color: var(--emc-black-rich);
    flex: 1 0 100%;
  }

</style>
