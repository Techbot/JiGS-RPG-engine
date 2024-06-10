<template>
  <div class="chat-box-wrapper">
    <form class="chat-box" @submit="onSubmit($event)">
      <input v-model="text" placeholder="Write a message" type="text" />
      <button type="submit" :disabled="text === ''">Send</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "ChatBox",
  data() {
    return {
      // To keep the state of the input content
      text: ""
    }
  },
  methods: {
    // We will call this when the form is submitted
    onSubmit(event) {
      // This fires an event which we will handle
      // in the parent component
      this.$emit("submit", event, this.text, this.author);
      this.text = "";
    }
  }
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
