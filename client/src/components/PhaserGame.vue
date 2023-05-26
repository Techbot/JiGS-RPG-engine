<script setup>

import PhaserContainer from './PhaserContainer'

</script>

<template>
  <Suspense>
    <PhaserContainer />

    <template #fallback>
      <div class="placeholder">
        Downloading ...
      </div>
    </template>
  </Suspense>
</template>

