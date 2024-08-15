<script setup>

import { onMounted, onUnmounted } from 'vue'
import { reactive } from 'vue'
import { launch } from '../../game/index.ts'

let gameInstance = null
const containerId = 'game-container'

onMounted(() => {
  gameInstance = launch(containerId)
})
onUnmounted(() => {
  gameInstance.destroy(false)
})

</script>
<template>
  <div>
    <div :id="containerId" />
  </div>
</template>
