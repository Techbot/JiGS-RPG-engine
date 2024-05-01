<script>
import { useJigsStore } from "../../stores/jigs";

export default {
  name: 'Character Page',
  setup() {
    const jigs = ref(useJigsStore());
    return {
      jigs,
    };
  },
  data() {
    return {
      headgear: [
        { id: 0, name: "None", image: "/assets/images/System/weapon_sword.png" },
        { id: 1, name: "Helmet", image: "/assets/images/System/weapon_gun.png" },
        { id: 2, name: "Visor", image: "/assets/images/System/weapon_gun.png" },
      ],
      weapons: [
        { id: 0, name: "Sword", image: "/assets/images/System/weapon_sword.png" },
        { id: 1, name: "Gun", image: "/assets/images/System/weapon_gun.png" },
      ],
      bionics: [
        { id: 0, name: "None" },
        { id: 1, name: "Fire" },
        { id: 2, name: "Ice" },
      ],
      implant: [
        { id: 0, name: "None" },
        { id: 1, name: "Eye" },
        { id: 2, name: "Brain" },
        { id: 3, name: "Skin" },
      ],
      armour: [
        { id: 0, name: "None" },
        { id: 1, name: "Suit of armour" },
        { id: 2, name: "Kevlar vest" },
      ],
      footwear: [
        { id: 0, name: "None" },
        { id: 1, name: "Steel toe boots" },
        { id: 2, name: "Magnetic boots" },
      ],
      selectedHeadgear: "None",
      selectedWeapon: "Gun",
      selectedBionics: "None",
      selectedImplant: "None",
      selectedArmour: "None",
      selectedFootwear: "None"
    }
  }
}

</script>

<template>

  <div class="emc-layout emc-char">

    <div class="emc-char__left">

      <div class="emc-char__item">
        <div class="emc-char__heading">Headgear</div>
        <select v-model="selectedHeadgear">
          <option>None</option>
          <option>Helmet</option>
          <option>Visor</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Weapon</div>
        <select v-model="selectedWeapon">
          <option>None</option>
          <option>Sword</option>
          <option>Gun</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Bionics</div>
        <select v-model="selectedBionics">
          <option>None</option>
          <option>Fire</option>
          <option>Ice</option>
        </select>
      </div>

    </div>

      <div class="emc-char__center">
          <!-- <div class="emc-char__heading">Character</div> -->
          <div class="emc-char__body">
            <div class="emc-char__part headgear">
              <div class="emc-char__heading">Headgear</div>
              {{ selectedHeadgear }}
            </div>
            <div class="emc-char__part head">
              <img v-if="selectedHeadgear === 'None'" src="/assets/psibot-head.png" width="256" height="128"/>
              <img v-if="selectedHeadgear === 'Helmet'" src="/assets/psibot-head-helmet.png" width="256" height="128"/>
              <img v-if="selectedHeadgear === 'Visor'" src="/assets/psibot-head-visor.png" width="256" height="128"/>
            </div>
            <div class="emc-char__part implant">
              <div class="emc-char__heading">Implant</div>
              {{ selectedImplant }}
            </div>
            <div class="emc-char__part armour">
              <div class="emc-char__heading">Armour</div>
              {{ selectedArmour }}
            </div>
            <div class="emc-char__part weapon_left">
              <div class="emc-char__heading">Weapon</div>
              <strong>{{ selectedWeapon }}</strong>
              <div class="weapon__thumb" v-if="selectedWeapon === 'Sword'">
                <img src="/assets/images/System/weapon_sword.png" alt="sword thumbnail" />
              </div>
              <div class="weapon__thumb" v-if="selectedWeapon === 'Gun'">
                <img src="/assets/images/System/weapon_gun.png" alt="gun thumbnail" />
              </div>
            </div>
            <div class="emc-char__part weapon_right">
              <div class="emc-char__heading">Weapon</div>
              {{ selectedWeapon }}
            </div>
            <div class="emc-char__part bionics">
              <div class="emc-char__heading">Bionics</div>
              {{ selectedBionics }}
            </div>
            <div class="emc-char__part footwear">
              <div class="emc-char__heading">Footwear</div>
              {{ selectedFootwear}}
            </div>
          </div>
    </div>

    <div class="emc-char__right">
      <div class="emc-char__item">
        <div class="emc-char__heading">Implant</div>
        <select v-model="selectedImplant">
          <option>None</option>
          <option>Eye</option>
          <option>Brain</option>
          <option>Skin</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Weapon</div>
        <select v-model="selectedWeapon">
          <option>Sword</option>
          <option>Gun</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Armour</div>
        <select v-model="selectedArmour">
          <option>None</option>
          <option>Suit of armour</option>
          <option>Kevlar vest</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Footwear</div>
        <select v-model="selectedFootwear">
          <option>None</option>
          <option>Steel toe boots</option>
          <option>Magnetic boots</option>
        </select>
      </div>
    </div>

  </div>
</template>

<style>
/* Chatacter */
.emc-layout.emc-char {
    display: flex;
    flex-wrap: nowrap;
    gap: 1rem;
    align-items: center;
  }

  .emc-char__center {
    flex: 1 0 50%;
  }

  .emc-char select {
    width: 100%;
    min-width: 15ch;
    max-width: 30ch;
    border: 1px solid var(--emc-teal-dark-alt);
    border-radius: 0.25em;
    padding: 0.25em 0.5em;
    cursor: pointer;
    line-height: 1.1;
    background-color: var(--emc-black-rich);
    background-image: linear-gradient(to top, var(--emc-black-rich), var(--emc-black) 33%);
    color: white;
  }

  .emc-char select:focus {
    border: 1px solid var(--emc-teal);
  }

  .emc-layout.emc-char > div {
    flex: 0 1 33%;
    width: 33%;
    padding: 1rem;
    border: 6px solid var(--emc-black-rich);
    min-height: 450px;
    text-align: center;
  }

  .emc-layout.emc-char > .emc-char__center {
    flex: 1 0 50%;
    width: 50%;
    background-color: var(--emc-black);
    border-width: 8px;
    min-height: 600px;
    padding: 3rem 1rem;
  }

  .emc-char__item {
    margin-bottom: 2rem;
    border: 3px solid var(--emc-black);
  }

  .emc-char__heading {
    text-transform: uppercase;
    color: white;
    background-color: var(--emc-black);
    font-family: 'Neutron Demo';
    font-size: 1rem;
    font-weight: bold;
    margin-bottom: 1rem;
  }

  .emc-char__part .emc-char__heading {
    background-color: var(--emc-black);
    font-family: 'Roboto';
    font-size: 1rem;
    font-weight: bold;
    margin-bottom: 1rem;
  }

  .emc-char__body {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(7, 1fr);
    grid-column-gap: 1rem;
    grid-row-gap: 1rem;
    grid-template-areas:
      ". head ."
      "headgear head implant"
      ". armour . "
      "weapon_left armour weapon_right"
      "weapon_left armour weapon_right"
      "bionics footwear ."
      ". footwear .";
  }

  .emc-char__body > div {
    background: black;
    border: 4px solid black;
    box-shadow: 0px 0px 0px 5px #111111, inset 0px 10px 27px -8px #141414, inset 0px -10px 27px -8px #042A2B, 5px 5px 15px 5px rgba(0,0,0,0);
    cursor: pointer;
  }

  .emc-char__body > div:hover,
  .emc-char__body > div:focus {
    border: 4px solid var(--emc-teal-dark-alt);
    box-shadow: 0px 0px 0px 5px #111111, inset 0px 10px 27px -8px #141414, inset 0px -10px 27px -8px #19535F, 5px 5px 15px 5px rgba(0,0,0,0);
  }

  .emc-char__body > div:focus {
    border: 4px solid var(--emc-teal-alt);
  }

  .emc-char__body .headgear {
    grid-area: 1 / 1 / 3 / 2;
  }

  .emc-char__body .head {
    grid-area: 1 / 2 / 3 / 3;
  }

  .emc-char__body .head img {
    object-position: 50% 50%;
    object-fit: cover;
  }

  .emc-char__body .implant {
    grid-area: 2 / 3 / 4 / 4;
  }

  .emc-char__body .armour {
    grid-area: 3 / 2 / 6 / 3;
  }

  .emc-char__body .weapon_left {
    grid-area: 4 / 1 / 6 / 2;
  }

  .emc-char__body .weapon_right {
    grid-area: 4 / 3 / 6 / 4;
  }

  .emc-char__body .bionics {
    grid-area: 6 / 1 / 8 / 2;
  }

  .emc-char__body .footwear {
    grid-area: 6 / 2 / 8 / 3;
  }

</style>
