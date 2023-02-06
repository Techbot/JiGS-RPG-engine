<script>

</script>


<template>
<div class="building">
  <h2> Shop : Ye Olde Shop of Neo Tokyo</h2>
    <div id="left">
      <p>xxxxxx: 0</p>
      <p>yyyyyy: 0</p>
    </div>
    <div id="right">
      xxxxxx: 0
      yyyyyy: 0
      zzzzzz: 0
    </div>
</div>
</template>


<style >
#app>form,
.building {
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
}
</style>

