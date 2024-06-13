<template>
  <div class="messages">
    <Message />
  </div>
  <ChatBox class="chat-box-wrapper" />
</template>
<script setup>
import ChatBox from './ChatBox.vue';
import Message from './Message.vue';
import axios from 'axios';

  // function onSubmit(event, id, text, author = 'player id') {
  //   event.stopPropagation();
  //   axios.post(
  //     'https://my-json-server.typicode.com/left23/json-server/messages',
  //     chatMessages
  //   ).then(function (response) {
  //     console.log('Response', response)
  //   })
  //   .catch(function (err) {
  //     console.log('Error', err)
  //   })
  // }
</script>
<style>
.messenger {
  width: 100%;
  border: 2px solid var(--emc-teal-dark-rich);
  position: relative;
}
.messenger::after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  background: linear-gradient(to bottom, #000, transparent);
  width: 100%;
  height: 4rem;
}

.messages {
  display: flex;
  flex-direction: column-reverse;
  flex-grow: 1;
  overflow: auto;
  padding: 0.25rem;
  background: var(--emc-black);
  height: 180px;
}
</style>
