<template>
  <div :class="[ 'message', { dark } ]">
    <small>{{ author }}: </small>
    {{ text }}
  </div>
</template>
<script>
export default {
  name: "Message",
  props: [
    "text", // Content of the message
    "author", // Author of the message
    "dark" // Background variant of the box
  ]
}
</script>
<style>
.message {
  display: flex;
  padding: 0.25rem;
  width: fit-content;
  align-items: center;
  font-size: 14px;
}

small {
  margin: 0 .25rem 0 0;
  flex: 1 0 auto;
  font-size: 12px;
  text-transform: uppercase;
  font-weight: bold;
  background: black;
  color: var(--emc-white-grey);
}
</style>
