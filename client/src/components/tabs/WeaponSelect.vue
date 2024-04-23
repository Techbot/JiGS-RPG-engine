<template>
  <div class="weapon">
    <div class="weapon--picked">
      <label>Weapon</label>
      <span class="weapon-value">
        {{ picked }}
      </span>
    </div>

    <div class="weapon--select">
      <div class="weapon-value">
        <label for="sword">Sword</label>
        <input type="radio" id="sword" value="Sword" v-model="picked">
      </div>
      <div class="weapon-value">
        <label for="gun">Gun</label>
        <input type="radio" id="gun" value="Gun" v-model="picked">
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'WeaponSelect'

}
</script>

<style>
.weapon label {
  margin-inline-end: 0.5rem;
}
.weapon label::after  {
  content:': '
}

.weapon {
  background: #111;
  padding: 1rem 2rem;
}

.weapon--picked,
.weapon--select {
  margin-bottom: 0.5rem;
}

.weapon--select {
  display: flex;
  gap: 1rem;
}

.weapon--select .weapon-value {
  flex: 1 0 auto;
  padding: 1rem;
  border: 2px solid transparent;
}

.weapon--select .weapon-value:hover {
  border: 2px solid red;
  background: #222;
}

.weapon--select .weapon-value {
  border: 2px solid var(--emc-black);
  box-shadow: 0px 0px 0px 5px #111111, inset 0px 10px 27px -8px #141414, inset 0px -10px 27px -8px var(--emc-black), 5px 5px 15px 5px rgba(0,0,0,0);
}
/* .weapon--select .weapon-value:first-child {
  border: 2px solid red;
  box-shadow: 0px 0px 0px 5px #111111, inset 0px 10px 27px -8px #141414, inset 0px -10px 27px -8px #A31925, 5px 5px 15px 5px rgba(0,0,0,0);
} */

</style>
