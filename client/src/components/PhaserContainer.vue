<script setup>

  import { onMounted, onUnmounted } from 'vue'
  import { reactive } from 'vue'

  let gameInstance = null
  const containerId = 'game-container'

  const game = await import( '@/game/index.ts')

  onMounted(() => {
    gameInstance = game.launch(containerId)
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
