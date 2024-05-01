<template>
  <div class="weapons">
    <strong>Weapon: {{ selected }}</strong>
    <div class="weapon__thumb" v-if="selected === 'Sword'">
      <img src="/assets/images/System/weapon_sword.png" alt="sword thumbnail" />
    </div>
    <div class="weapon__thumb" v-if="selected === 'Gun'">
      <img src="/assets/images/System/weapon_gun.png" alt="gun thumbnail" />
    </div>

    <div class="weapons--select">
      <div class="weapon" :class="{ active: weapon.name === selected }" v-for="weapon in weapons" :key="weapon.id">
        <label>
          <input class="visually-hidden" type="radio" name="weapon-input" :value="weapon.name" :id="weapon.name" v-model="selected" />
          <img :src="weapon.image" :alt="weapon.name" />
          <span>{{ weapon.name }}</span>
        </label>
      </div>
    </div>
  </div>
</template>
<script>

import { ref } from 'vue'
import { useJigsStore } from "../../stores/jigs";

export default {
  name: 'WeaponSelect',
  setup() {
    const jigs = ref(useJigsStore());
    return {
      jigs,
    };
  },
  data() {
    return {
      weapons: [
        { id: 0, name: "Sword", image: "/assets/images/System/weapon_sword.png" },
        { id: 1, name: "Gun", image: "/assets/images/System/weapon_gun.png" },
      ],
      selected: "Gun",
    }
  }
}
</script>

<style>
/* .weapons label {
  margin-inline-end: 0.5rem;
} */
/* .weapon label::after {
  content:': '
} */

.weapons {
  background: #111;
  padding: 1rem;
}
.weapon__thumb {
  text-align: center;
}

.weapon__thumb img {
  margin: 0 auto 1rem;
  width: 4rem;
}

.weapons--select {
  /* margin-bottom: 0.5rem; */
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  font-size: 12px;
  font-weight: bold;
  text-transform: uppercase;
}

.weapons--select .weapon {
  flex: 0 1 auto;
  min-width: 25%;
}

.weapons--select input {
  margin-top: 0;
  margin-bottom: 0;
}

.weapons--select .weapon label {
  padding: 0.5rem;
  border: 2px solid transparent;
  display: block;
  text-align: center;
  border: 2px solid var(--emc-black);
  box-shadow: 0px 0px 0px 5px #111111, inset 0px 10px 27px -8px #141414, inset 0px -10px 27px -8px var(--emc-black), 5px 5px 15px 5px rgba(0,0,0,0);
}

.weapons--select .weapon label img {
  width: 2rem;
  margin: 0.25rem auto 0;
}

.weapons--select .weapon label:hover {
  border: 2px solid red;
  background: #222;
}

.weapons--select .weapon.active label {
  border: 2px solid red;
  box-shadow: 0px 0px 0px 5px #111111, inset 0px 10px 27px -8px #141414, inset 0px -10px 27px -8px #A31925, 5px 5px 15px 5px rgba(0,0,0,0);
}
</style>
