<script>
import axios from "axios";
import { useJigsStore } from "../../stores/jigs";
import * as coreui from '@coreui/coreui'
export default {
  components: {
    coreui
  },
  setup() {
    const jigs = useJigsStore();
    return {
      jigs,
    };
  },
  data() {
    return {
      playerQuests: [],
    };
  },
  mounted() {
     this.jigs = useJigsStore();
    axios
      .get("/mymissions?_wrapper_format=drupal_ajax")
      .then((response) => {
        this.jigs.playerQuests = response.data[0].value["playerMissions"];
        console.log(this.jigs.playerQuests)
      });
  }
}
</script>

<template>
  <div class="quests">
    <img src="/assets/images/header2.png" />
    <div class="accordion accordion-flush" id="accordionFlushExample" v-for="quest in jigs.playerQuests.quests" :key="quest.id">
      <div class="quest accordion-item">
        <img class="quest__thumbnail" src="/assets/images/System/quest.png" alt="quest type thumbnail" />
        <h2 class="accordion-header">
          <button class="quest__heading accordion-button collapsed" type="button"
            data-coreui-toggle="collapse" data-coreui-target="#flush-collapseOne"
            aria-expanded="false" aria-controls="flush-collapseOne">
              {{ quest.id }}: {{ quest.title ? quest.title : 'Quest Title' }}
          </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse"
          data-coreui-parent="#accordionFlushExample">
          <div class="accordion-body">{{ quest.content ? quest.content : 'Content of the quest.' }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
  .quest__heading {
    color: #fff;
    background-color: var(--emc-black);
    font-family: Neutron Demo;
    font-size: 1.5rem;
    font-weight: 700;
  }

  .quests .quest {
    background: var(--emc-black);
    color: white;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
  }

  .quest__thumbnail {
    flex: 0 1 34px;
    margin-right: 0.25rem;
  }

  .quests .accordion-button {
    background: var(--emc-black);
    border: 4px solid transparent;
    color: white;
  }

  .accordion.accordion-flush {
    margin-bottom: 2rem;
  }

  .accordion-collapse {
    flex: 1 0 100%;
  }

  .accordion-body {
    background-color: var(--emc-black-rich);
  }

  .accordion-button:hover,
  .accordion-button:focus {
    border: 4px solid var(--emc-teal-dark-alt);
  }

  .accordion-button:focus {
    border-color: var(--emc-teal-alt);
    outline: 0;
  }

  .accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
  }

  .accordion-button:not(.collapsed) {
    color: white !important;
    background-color: var(--emc-black) !important;
    box-shadow: none;
  }

  .accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
  }

</style>
