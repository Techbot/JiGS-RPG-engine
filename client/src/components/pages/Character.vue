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

<style scoped>
/* These styles do not compile */
  .emc-layout.emc-char {
    display: flex;
    flex-wrap: nowrap;
    gap: 1rem;
    background: pink;
  }

  .emc-layout.emc-char > div {
    flex: 0 1 33%;
    width: 33%;
    padding: 1rem;
  }

  .emc-char__center {
    flex: 1 0 50%;
  }
  .emc-char__item {
    margin-bottom: 1rem;
  }

</style>
