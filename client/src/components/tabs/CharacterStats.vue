<template>
  <div class="character-stats">
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
  </div>

  <div class="character-stats__level">
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
  </div>

  <div class="character-stats__xp">
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
.character-stats,
.character-stats__level,
.character-stats__xp {
  column-count: 2;
  padding-left: 0.25rem;
  padding-right: 0.25rem;
}
.character-stats__level {
  background-color: var(--emc-teal-dark-rich);
}
.character-stats__xp {
  background-color: var(--emc-dark);
}

.character-gauge {
  margin-bottom: 0.5rem;

}
.character-gauge label {
  display: inline-block;
  font-size: 12px;
  font-weight: 700;
  margin-inline-end: 0.5rem;
  text-transform: uppercase;
}
.character-gauge label::after {
  content:': '
}
</style>
