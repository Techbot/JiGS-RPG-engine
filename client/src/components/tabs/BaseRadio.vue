<template>

  <label>
    <input
      type="radio"
      :checked="modelValue === value"
      :value="value"
      @change="$emit('update:modelValue', value, label)"
      v-bind="$attrs"
      class="visually-hidden"
    />
    <img :src="image" :alt="label" />
    <span v-if="label">{{ label }}</span>
  </label>

</template>
<script>
export default {
  name: 'BaseRadio',
  props: {
    label: {
      type: String,
      default: ''
    },
    modelValue: {
      type: [String, Number],
      default: ''
    },
    value: {
      type: [String, Number],
      required: true
    },
    image: {
      type: String,
      default: ""
    }
  }
}
</script>
<style>

</style>
