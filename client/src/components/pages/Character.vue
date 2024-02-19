<script>
import { useJigsStore } from "../../stores/jigs";
</script>

<template>

  <div class="emc-layout emc-char">

    <div class="emc-char__left">

      <div class="emc-char__item">
        <div class="emc-char__heading">Headgear</div>
        <select>
          <option>Helmet</option>
          <option>Viser</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Weapon</div>
        <select>
          <option>Gun</option>
          <option selected>Sword</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Bionics</div>
        <select>
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
            </div>
            <div class="emc-char__part head">
              <img src="/assets/psibot-head.png" width="256" height="128"/>
            </div>
            <div class="emc-char__part implant">
              <div class="emc-char__heading">Implant</div>
            </div>
            <div class="emc-char__part armour">
              <div class="emc-char__heading">Armour</div>
            </div>
            <div class="emc-char__part weapon_left">
              <div class="emc-char__heading">Weapon</div>
            </div>
            <div class="emc-char__part weapon_right">
              <div class="emc-char__heading">Weapon</div>
            </div>
            <div class="emc-char__part bionics">
              <div class="emc-char__heading">Bionics</div>
            </div>
            <div class="emc-char__part footwear">
              <div class="emc-char__heading">Footwear</div>
            </div>
          </div>
    </div>

    <div class="emc-char__right">
      <div class="emc-char__item">
        <div class="emc-char__heading">Implant</div>
        <select>
          <option>Eye</option>
          <option>Brain</option>
          <option>Skin</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Weapon</div>
        <select>
          <option>Gun</option>
          <option>Sword</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Armour</div>
        <select>
          <option>Suit of aromour</option>
          <option>Kevlar vest</option>
        </select>
      </div>

      <div class="emc-char__item">
        <div class="emc-char__heading">Footwear</div>
        <select>
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
