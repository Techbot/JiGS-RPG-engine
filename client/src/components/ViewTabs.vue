<script>
import Quests    from './tabs/Quests.vue';
import Character  from './tabs/Character.vue';
import Skills     from './tabs/Skills.vue';
import Inventory  from './tabs/Inventory.vue';
import Log        from './tabs/Log.vue';

export default {
  components: {
    Quests,
    Character,
    Skills,
    Inventory,
    Log
  },
  props: {
    msg: String
  }
}
</script>

<template>
<div class="tab-panels">
  -----------------------
  <component :is=msg />
</div>
</template>


