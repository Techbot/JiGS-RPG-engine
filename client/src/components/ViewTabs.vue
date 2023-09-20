<script>
import Armoury    from './tabs/ArmouryBuilding.vue';
import Character  from './tabs/Character.vue';
import Hanger     from './tabs/HangerBuilding.vue';
import Outpost    from './tabs/OutpostBuilding.vue';
import Shop       from './tabs/ShopBuilding.vue';
import Temple     from './tabs/TempleBuilding.vue';
import PlayerMain from './tabs/PlayerMain.vue';

export default {
  components: {
    Armoury,
    Character,
    Hanger,
    Outpost,
    Shop,
    Temple,
    PlayerMain
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


