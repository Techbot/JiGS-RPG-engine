<template>
  <div
    v-for="option in options"
      :key="option.value"
      class="weapon"
      :class="{ active: modelValue === option.value }"
      >
    <BaseRadio
      :label="option.label"
      :value="option.value"
      :image="option.image"
      :name="name"
      :modelValue="modelValue"
      @update:modelValue="$emit('update:modelValue', $event)"
    />
    {{ image }}
</div>
</template>
<script>
import BaseRadio from './BaseRadio.vue';
  export default {
    name: 'BaseRadioGroup',
    components: {
      BaseRadio
    },
    props: {
      options: {
        type: Array,
        required: true
      },
      name: {
        type: String,
        required: true
      },
      modelValue: {
        type: [String, Number],
        required: true
      }
    }
  }
</script>
<style>

</style>
