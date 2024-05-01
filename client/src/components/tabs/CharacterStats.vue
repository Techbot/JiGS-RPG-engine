<template>
  <div>
    <div class="character-gauge">
      <label>Intelligence</label>
      <span class="gauge-value">
        {{this.jigs.playerStats.intelligence}}
      </span>
    </div>

    <div class="character-gauge">
      <label>Strength</label>
      <span class="gauge-value">
        {{this.jigs.playerStats.strength}}
      </span>
    </div>

    <div class="character-gauge">
      <label>Dexterity</label>
      <span class="gauge-value">
        {{this.jigs.playerStats.dexterity}}
      </span>
    </div>

    <div class="character-gauge">
      <label>Endurance</label>
      <span class="gauge-value">
        {{this.jigs.playerStats.endurance}}
      </span>
    </div>

    <div class="character-gauge">
      <label>Charisma</label>
      <span class="gauge-value">
        {{this.jigs.playerStats.charisma}}
      </span>
    </div>

    <div class="character-gauge">
      <label>PSI</label>
      <span class="gauge-value">
        {{this.jigs.playerStats.psi}}
      </span>
    </div>

    <div class="character-gauge">
      <label>Level</label>
      <span class="gauge-value">
        {{this.jigs.playerStats.level}}
      </span>
    </div>

    <div class="character-gauge">
      <label>XP</label>
      <span class="gauge-value">
        {{this.jigs.playerStats.xp}}
      </span>
    </div>

    <div class="character-gauge">
      <label>Credits</label>
      <span class="gauge-value">
        {{ this.jigs.playerStats.credits }}
      </span>
    </div>

    <div class="character-gauge">
      <label>Nanites</label>
      <span class="gauge-value">
        {{ this.jigs.playerStats.nanites }}
      </span>
    </div>

  </div>
</template>
<script>
import { ref } from 'vue'
import { useJigsStore } from "../../stores/jigs";

export default {
  name: 'CharacterStats',
  setup() {
    const jigs = ref(useJigsStore());
    return {
      jigs,
    };
  },
  data() {
    return {
      value: this.jigs.playerStats.health
    };
  },
}
</script>
<style>

</style>
