<script>
import Armoury from './Buildings/ArmouryBuilding.vue';
import Bank    from './Buildings/BankBuilding.vue';
import Hanger  from './Buildings/HangerBuilding.vue';
import Outpost from './Buildings/OutpostBuilding.vue';
import Shop    from './Buildings/ShopBuilding.vue';
import Temple  from './Buildings/TempleBuilding.vue';
import PlayerMain      from './PlayerMain.vue';

export default {
  components: {
    Armoury,
    Bank,
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
<div>
  -----------------------
  <component :is="msg" />
</div>

</template>


