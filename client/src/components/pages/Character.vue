<script>
import { ref } from 'vue'
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
        { id: 0, name: "None", image: "/assets/images/System/psibot-head.png" },
        { id: 1, name: "Helmet", image: "/assets/images/System/psibot-head-helmet.png" },
        { id: 2, name: "Visor", image: "/assets/images/System/psibot-head-visor.png" },
      ],
      weaponsLeft: [
        { id: 0, name: "Sword", image: "/assets/images/System/weapon_sword.png" },
        { id: 1, name: "Gun", image: "/assets/images/System/weapon_gun.png" },
      ],
      weaponsRight: [
        { id: 0, name: "Sword", image: "/assets/images/System/weapon_sword.png" },
        { id: 1, name: "Gun", image: "/assets/images/System/weapon_gun.png" },
      ],
      bionics: [
        { id: 0, name: "None", image: "/assets/images/System/psibot-bionics.png" },
        { id: 1, name: "Fire", image: "/assets/images/System/psibot-bionics-fire.png" },
        { id: 2, name: "Ice", image: "/assets/images/System/psibot-bionics-ice.png" },
      ],
      implant: [
        { id: 0, name: "None", image: "/assets/images/System/psibot-implant.png" },
        { id: 1, name: "Eye", image: "/assets/images/System/psibot-implant-eye.png" },
        { id: 2, name: "Brain", image: "/assets/images/System/psibot-implant-brain.png" },
        { id: 3, name: "Skin", image: "/assets/images/System/psibot-implant-skin.png" },
      ],
      armour: [
        { id: 0, name: "None", image: "/assets/images/System/psibot-body.png" },
        { id: 1, name: "Suit of armour", image: "/assets/images/System/psibot-body-suit-of-armour.png" },
        { id: 2, name: "Kevlar vest", image: "/assets/images/System/psibot-body-kevlar.png" },
      ],
      footwear: [
        { id: 0, name: "None", image: "/assets/images/System/psibot-footwear.png" },
        { id: 1, name: "Steel toe boots", image: "/assets/images/System/psibot-footwear.png" },
        { id: 2, name: "Magnetic boots", image: "/assets/images/System/psibot-footwear.png" },
      ],
      selectedHeadgear: "None",
      selectedWeaponLeft: "Gun",
      selectedWeaponRight: "Sword",
      selectedBionics: "None",
      selectedImplant: "None",
      selectedArmour: "None",
      selectedFootwear: "None"
    }
  },
  methods: {
    mouseover: function(){
      console.log('mouseover');
      console.log(this);
    },
    mouseleave: function(){
      console.log('mouseout')
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
          <option v-for="item in headgear">{{ item.name }}</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Weapon</div>
        <select v-model="selectedWeaponLeft">
          <option v-for="weapon in weaponsLeft">{{ weapon.name }}</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Footwear</div>
        <select v-model="selectedFootwear">
          <option v-for="item in footwear">{{ item.name }}</option>
        </select>
      </div>
    </div>

      <div class="emc-char__center">
          <!-- <div class="emc-char__heading">Character</div> -->
          <div class="emc-char__body">
            <div class="emc-char__part head" v-on:mouseover="mouseover" v-on:mouseleave="mouseleave">
              <img v-if="selectedHeadgear === 'None'" src="/assets/psibot-head.png" width="224" height="200" />
              <img v-if="selectedHeadgear === 'Helmet'" src="/assets/psibot-head-helmet.png" width="224" height="200" />
              <img v-if="selectedHeadgear === 'Visor'" src="/assets/psibot-head-visor.png" width="224" height="200" />
            </div>
            <div class="emc-char__part implant">
              <div class="emc-char__heading">Implant</div>
              <!-- {{ selectedImplant }} -->
              <img v-if="selectedImplant === 'None'" src="/assets/psibot-implant.png" width="64" height="64" />
              <img v-if="selectedImplant === 'Eye'" src="/assets/psibot-implant-eye.png" width="64" height="64" />
              <img v-if="selectedImplant === 'Brain'" src="/assets/psibot-implant-brain.png" width="64" height="64" />
              <img v-if="selectedImplant === 'Skin'" src="/assets/psibot-implant-skin.png" width="64" height="64" />
            </div>
            <div class="emc-char__part armour">
              <!-- <div class="emc-char__heading">Armour</div> -->
              <!-- {{ selectedArmour }} -->
              <img v-if="selectedArmour === 'None'" src="/assets/psibot-body.png" width="236" height="112" />
              <img v-if="selectedArmour === 'Suit of armour'" src="/assets/psibot-body-suit-of-armour.png" width="236" height="112" />
              <img v-if="selectedArmour === 'Kevlar vest'" src="/assets/psibot-body-kevlar.png" width="236" height="112" />
            </div>
            <div class="emc-char__part weapon_left">
              <div class="emc-char__heading">Weapon</div>
              <!-- <strong>{{ selectedWeaponLeft }}</strong> -->
              <div class="weapon__thumb" v-if="selectedWeaponLeft === 'Sword'">
                <img src="/assets/images/System/weapon_sword.png" alt="sword thumbnail" />
              </div>
              <div class="weapon__thumb" v-if="selectedWeaponLeft === 'Gun'">
                <img src="/assets/images/System/weapon_gun.png" alt="gun thumbnail" />
              </div>
            </div>
            <div class="emc-char__part bionics">
              <div class="emc-char__heading">Bionics</div>
              <!-- {{ selectedBionics }} -->
              <img v-if="selectedBionics === 'None'" src="/assets/psibot-bionics.png" width="68" height="68" />
              <img v-if="selectedBionics === 'Fire'" src="/assets/psibot-bionics-fire.png" width="68" height="68" />
              <img v-if="selectedBionics === 'Ice'" src="/assets/psibot-bionics-ice.png" width="68" height="68" />
            </div>
            <div class="emc-char__part footwear">
              <!-- <div class="emc-char__heading">Footwear</div> -->
              <!-- {{ selectedFootwear}} -->
              <img v-if="selectedFootwear === 'None'" src="/assets/psibot-foot.png" width="224" height="100" />
              <img v-if="selectedFootwear === 'Steel toe boots'" src="/assets/psibot-foot-steel-toe.png" width="224" height="100" />
              <img v-if="selectedFootwear === 'Magnetic boots'" src="/assets/psibot-foot-magnetic.png" width="224" height="100" />
            </div>
          </div>
    </div>

    <div class="emc-char__right">

      <div class="emc-char__item">
        <div class="emc-char__heading">Implant</div>
        <select v-model="selectedImplant">
          <option v-for="item in implant">{{ item.name }}</option>
        </select>
      </div>

      <!-- <div class="emc-char__item">
        <div class="emc-char__heading">Weapon</div>
        <select v-model="selectedWeaponRight">
          <option v-for="weapon in weaponsRight">{{ weapon.name }}</option>
        </select>
      </div> -->

      <div class="emc-char__item">
        <div class="emc-char__heading">Armour</div>
        <select v-model="selectedArmour">
          <option v-for="item in armour">{{ item.name }}</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Bionics</div>
        <select v-model="selectedBionics">
          <option v-for="item in bionics">{{ item.name }}</option>
        </select>
      </div>

    </div>

  </div>
</template>

<style>
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
    padding: 2rem 1rem;
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
    font-size: 12px;
    font-weight: bold;
    /* margin-bottom: 1rem; */
  }

  .emc-char__body {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(4, 1fr);
    grid-column-gap: 1rem;
    grid-row-gap: 1rem;
    /* grid-template-areas:
      ". head implant"
      ". head implant "
      "weapon_left armour bionics"
      "weapon_left footwear bionics" */
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

  .emc-char__body .head {
    grid-area: 1 / 2 / 3 / 3;
    align-self: flex-end;
  }

  .emc-char__body .head img {
    object-position: 50% 50%;
    object-fit: cover;
  }

  .emc-char__body img {
    object-position: 50% 50%;
    object-fit: cover;
    margin: 0 auto;
    display: block;
  }

  .emc-char__body .implant {
    grid-area: 1 / 3 / 3 / 4;
  }

  .emc-char__body .armour {
    grid-area: 3 / 2 / 4 / 3;
  }

  .emc-char__body .weapon_left {
    grid-area: 2 / 1 / 4 / 2;
  }

  .emc-char__body .bionics {
    grid-area: 3 / 3 / 5 / 4;
  }

  .emc-char__body .footwear {
    grid-area: 4 / 2 / 5 / 3;

  }
</style>
