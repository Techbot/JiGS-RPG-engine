<template>
  <div class="crystals">
    <div class="crystal__header">
      <div>Attack</div>  <div>Defence</div>
    </div>

    <div class="crystal" v-for="crystal in crystals">
      <img :src="'/assets/images/gui/crystal-A-' + crystal.id + '-sm.png'" alt="" width="24" height="24" class="crystal__image" />
      <label class="crystal__label" :for="crystal.name">{{ crystal.name }}</label>
      <div class="crystal__total">{{ crystal.value }} : {{ crystal.total - crystal.value }} / {{ crystal.total }}</div>
      <input :id="crystal.id" class="crystal__slider" type="range" min="0" :max="crystal.total" :value="crystal.value"
      :style="{ backgroundColor: crystal.color, accentColor: crystal.color, borderColor: crystal.color , boxShadowColor: crystal.color }" v-model="crystal.value">
    </div>
  </div>

</template>

<script>
  export default {
    name: 'CrystalSlider',
    data() {
      return {
        crystalBg: '',
        crystals: [
          {
            name: 'Emerald',
            id: 'emerald',
            value: 1,
            total: 3,
            color: '#00CC66'
          },
          {
            name: 'Amethyst',
            id: 'amethyst',
            value: 0,
            total: 0,
            color: '#3C1642'
          },
          {
            name: 'Sapphire',
            id: 'sapphire',
            value: 0,
            total: 0,
            color: '#0A2463'
          },
          {
            name: 'Topaz',
            id: 'topaz',
            value: 0,
            total: 0,
            color: '#FFC43D'
          },
          {
            name: 'Ruby',
            id: 'ruby',
            value: 0,
            total: 0,
            color: '#D00A01'
          },
        ],
      }
    },
    methods: {
      crystalStyle() {
        this.crystals.forEach(function(crystalItem) {
          let crystalBg = crystalItem.color;
          let crystalId = crystalItem.id;
          // console.log('crystalBg: ' + crystalBg);

          const crystalInput = document.querySelectorAll('input');
            // console.log('crystalInput:' + crystalInput);

            crystalInput.forEach(function(inputItem) {

              // console.log('inputItem:' + inputItem);
              const inputId = inputItem.id;
              // console.log('inputId:' + inputId);

              const crystalStyles = getComputedStyle(inputItem);
              // console.log('crystalStyles:' + crystalStyles);

              const inputStyle = crystalStyles.getPropertyValue('--crystal-color');

              if (inputId == crystalId) {
                // console.log('inputStyle: ' + inputStyle);
                inputItem.style.setProperty('--crystal-color', crystalBg);
              }

            });

        });
      }
    },
    mounted() {
      this.crystalStyle();
    }
  }
</script>

<style>
.crystals {
  padding: 1rem 1rem 0;
  background: #111;
}

.crystal__header {
  display: flex;
  justify-content: space-between;
  max-width: 500px;
  font-weight: 700;
  margin-bottom: 0.5rem;
  padding: 0 0.25rem;
  background: black;
}

.crystal {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  padding: 0 0 0.5rem;
  max-width: 500px;
}

.crystal__label,
.crystal__total {
  font-size: 12px;
  text-transform: uppercase;
  font-weight: 700;
}

.crystal__total {
  margin-left: auto;
}

.crystal__image {
  margin-inline-end: 8px;
}

.crystal__slider {
  --crystal-color: red;
  flex: 1 0 100%;
  cursor: pointer;
  appearance: none;
  -webkit-appearance: none;
  width: 100%;
  max-width: 500px;
  overflow: hidden;
  height: 25px;
  background: var(--crystal-color);
  outline: none;
  border-radius: 12px;
}

/* Track: webkit browsers */
input[type="range"]::-webkit-slider-runnable-track {
  height: 15px;
  background: #222;
  border-radius: 16px;
}

/* Track: Mozilla Firefox */
input[type="range"]::-moz-range-track {
  height: 15px;
  background: #222;
  border-radius: 16px;
}

/* Thumb: webkit */
input[type="range"]::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  height: 15px;
  width: 15px;
  background-color: #fff;
  border-radius: 50%;
  border: 2px solid var(--crystal-color);
  /* slider progress trick, depends on input width of 500px */
  box-shadow: -407px 0 0 400px var(--crystal-color);
}

/* Thumb: Firefox */
input[type="range"]::-moz-range-thumb {
  height: 15px;
  width: 15px;
  background-color: #fff;
  border-radius: 50%;
  border: 1px solid var(--crystal-color,);
  /* slider progress trick, depends on input width of 500px */
  box-shadow: -407px 0 0 400px var(--crystal-color);
}

</style>


