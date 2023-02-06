<script>

</script>

<template>
<div class="building">
<div><h2> Bank : Royal Branch of Triton</h2></div>

<div id="left">
 <p>Your money: 0</p>
<p>My money: 0</p>

 </div>

 <div id="right">
  Current nation mood: 0
  Inflation: 0
  GDP: 0
 </div>
</div>
</template>

<style >
#app>form, .building {
    display: flex;
    flex-wrap: wrap;
  }
  .action-name {
    flex: 1 0 100%;
  }

  #left,
  #right {
    flex: 1 0 50%;
    width: 200px;
    border: 3px solid #73AD21;
    padding: 10px;
    font-size: xx-small;
  }
</style>




