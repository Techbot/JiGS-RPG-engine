<script>

import { ref } from 'vue';
import { useJigsStore } from "../../stores/jigs";
import AudioController from './AudioController.vue';
import CharacterGauge from './CharacterGauge.vue';
import CharacterStats from './CharacterStats.vue';
import CrystalSlider from './CrystalSlider.vue';
import WeaponSelect from './WeaponSelect.vue';

export default {
  components: {
    AudioController,
    CharacterGauge,
    CharacterStats,
    CrystalSlider,
    WeaponSelect
  },
  setup() {
    const jigs = ref(useJigsStore());
    return {
      jigs,
    };
  }
}
</script>

<template>

  <AudioController />

  <div class="character">
    <!-- <img src = "/assets/images/System/player-top.png"/> -->
    <CharacterGauge />
    <CharacterStats />
  </div>

  <CrystalSlider />

  <WeaponSelect />

</template>

<style>
.character {
  background: #111;
  padding: 1rem 1rem 0;
}

.vue-simple-progress,
.vue-simple-progress-bar {
  height: 1rem !important;
}

.character h3 {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  flex: 1 0 auto;
  text-transform: uppercase;
  color: white;
  background-color: #333;
  font-family: 'Neutron Demo';
  font-size: 1.25rem;
  font-weight: bold;
  height: 2rem;
  box-shadow: inset 0px 12px 25px 5px rgba(0, 0, 0, 0.4);
}
</style>
