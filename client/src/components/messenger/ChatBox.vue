<template>
  <form class="chat-box" @submit.prevent="addItemAndClear(text)">
    <input v-model="text" placeholder="Write a message" type="text" />
    <button type="submit" :disabled="message === ''">Send</button>
  </form>
</template>

<script setup>
  import { ref } from "vue";
  const text = ref('');
  import { useChatMessageStore } from "../../stores/messages";
  const store = useChatMessageStore()

  function addItemAndClear(item) {

    if(item.length === 0) {
      return
    }
    store.addChatMessage(item)
    text.value = ''
  }
</script>

<style>
.chat-box {
  width: 100%;
  display: flex;
  background: var(--emc-teal-dark-rich);
  border-top: 2px solid var(--emc-teal-dark-rich);
}

.chat-box input {
  width: min(100%, 20rem);
  flex-grow: 1;
  color: white;
  border: 0;
  padding: 0.5rem;
  background: rgba(0, 0, 0, 0.1);
}

.chat-box input:focus-visible {
  border: 0;
  outline: 1px solid var(--emc-black);
  outline-offset: -1px;
  background: var(--emc-black-rich);
}

.chat-box button {
  border: 0;
  background: var(--emc-teal-dark);
  color: white;
  cursor: pointer;
  padding: 0.25rem 0.75rem;
  text-transform: uppercase;
  font-weight: bold;
  font-size: 12px;
}

.chat-box button:focus-visible {
  border: 0;
  outline: 1px solid var(--emc-teal);
  outline-offset: -1px;
}

.chat-box button:disabled {
  opacity: 0.3;
}
</style>
