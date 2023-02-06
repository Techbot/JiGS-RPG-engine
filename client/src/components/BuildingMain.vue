<script>
import ArmouryBuilding from './Buildings/ArmouryBuilding.vue';
import BankBuilding    from './Buildings/BankBuilding.vue';
import HangerBuilding  from './Buildings/HangerBuilding.vue';
import OutpostBuilding from './Buildings/OutpostBuilding.vue';
import ShopBuilding    from './Buildings/ShopBuilding.vue';
import TempleBuilding  from './Buildings/TempleBuilding.vue';
import PlayerMain from './PlayerMain.vue';

export default {
  components: {
    ArmouryBuilding,
    BankBuilding,
    HangerBuilding,
    OutpostBuilding,
    ShopBuilding,
    TempleBuilding,
    PlayerMain
  },
  props: {
    msg: []
  }
}
</script>

<template>
<div>
  <component :is="msg[0]" />
</div>

</template>


