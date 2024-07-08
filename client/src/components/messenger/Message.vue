<template>
  <div v-for="message in chatMessages" :key="message.id" class="message">
    <small>{{ message.author }}: </small>
    {{ message.text }}
  </div>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useChatMessageStore } from "../../stores/messages";

  const store = useChatMessageStore()
  const { chatMessages } = storeToRefs(store)

</script>

<style>
.message {
  display: flex;
  padding: 0.25rem;
  width: fit-content;
  align-items: center;
  font-size: 14px;
}

.message small {
  margin: 0 .25rem 0 0;
  flex: 1 0 auto;
  font-size: 12px;
  text-transform: uppercase;
  font-weight: bold;
  background: black;
  color: var(--emc-white-grey);
}
</style>
