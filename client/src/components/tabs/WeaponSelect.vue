<template>
  <form class="weapons">
    <strong>Weapon: {{ weaponName }} / {{event.weapon}}</strong>
    <div class="weapon__thumb" v-if="event.weapon === 0">
      <img src="/assets/images/gui/weapon_sword.png" alt="sword thumbnail" />
    </div>
    <div class="weapon__thumb" v-if="event.weapon === 1">
      <img src="/assets/images/gui/weapon_gun.png" alt="gun thumbnail" />
    </div>

    <div class="weapons--select">
      <BaseRadioGroup
        v-model="event.weapon"
        name="weapon"
        :options="weaponOptions"
      />

    </div>
  </form>
</template>
<script>

import { ref } from 'vue'
import { useJigsStore } from "../../stores/jigs";
import BaseRadioGroup from './BaseRadioGroup.vue';

export default {
  name: 'WeaponSelect',
  components: {
    BaseRadioGroup
  },
  setup() {
    const jigs = ref(useJigsStore());
    return {
      jigs,
    };
  },
  data() {
    return {
      weaponOptions: [
        { value: 0, label: "Sword", image: "/assets/images/gui/weapon_sword.png"},
        { value: 1, label: "Gun", image: "/assets/images/gui/weapon_gun.png" },
      ],
      event: {
        weapon: 1,
        label: '',
        value: '',
      },
      selectedWeapon: 1
    }
  },
  computed: {
    weaponName() {
      // Only works for 2 weapons.
      return this.event.weapon === 0 ? 'Sword' : 'Gun'
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
