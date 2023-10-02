<script>
import Armoury    from './tabs/ArmouryBuilding.vue';
import Bank       from './tabs/BankBuilding.vue';
import Skills     from './tabs/SkillsTab.vue';
import Inventory  from './tabs/InventoryTab.vue';
import Shop       from './tabs/ShopBuilding.vue';
import Temple     from './tabs/TempleBuilding.vue';
import PlayerMain from './PlayerMain.vue';

export default {
  components: {
    Armoury,
    Bank,
    Skills,
    Inventory,
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
<div>
  -----------------------
  <component :is=msg />
</div>

</template>


