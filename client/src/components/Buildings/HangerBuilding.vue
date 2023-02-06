<script>

</script>


<template>
<div class="building">
  <h2> Hanger : Royal Hanger of Shropshire</h2>
  <table>
    <tr>
      <td>Hi, I'm your first cell.</td>
      <td>I'm your second cell.</td>
      <td>I'm your third cell.</td>
      <td>I'm your fourth cell.</td>
    </tr>
    <tr>
      <td>Second row, first cell.</td>
      <td>Cell 2.</td>
      <td>Cell 3.</td>
      <td>Cell 4.</td>
    </tr>
  </table>
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

