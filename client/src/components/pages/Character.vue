<script>
import { useJigsStore } from "../../stores/jigs";
</script>

<template>


  <div class="emc-layout emc-char">

    <div class="emc-char__left">
      <div class="emc-char__item">
        <h2>Weapon</h2>
        <select>
          <option>Gun</option>
          <option>Sword</option>
        </select>
      </div>

      <div class="emc-char__item">
        <h2>Ammo</h2>
        <select>
          <option>Fire</option>
          <option>Ice</option>
        </select>
      </div>

    </div>

    <div class="emc-char__center">

    </div>

    <div class="emc-char__right">

      <div class="emc-char__item">
        <h2>Implant</h2>
        <select>
          <option>Eye</option>
          <option>Brain</option>
          <option>Skin</option>
        </select>
      </div>

      <div class="emc-char__item">
        <h2>Armour</h2>
        <select>
          <option>Suit of aromour</option>
          <option>Kevlar vest</option>
        </select>
      </div>
    </div>

  </div>
</template>

<style scoped>
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
