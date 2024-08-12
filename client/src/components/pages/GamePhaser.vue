<script setup>
import { onMounted, onUnmounted } from 'vue'
import { reactive } from 'vue'

let gameInstance = null
const containerId = 'game-container'

import launch from '../../game/index.ts';

onMounted(() => {
  if (!gameInstance) {
    gameInstance = launch(containerId)
  }
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
