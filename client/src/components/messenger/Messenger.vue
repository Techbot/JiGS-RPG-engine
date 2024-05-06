<template>
  <div class="messages">
    <Message v-for="message in messages" :key="message.id" :class="[ 'message', { right: message.isMine } ]" :dark="message.isMine" :text="message.text" :author="message.author" />
  </div>
  <ChatBox class="chat-box" @submit="onSubmit" />
  <RegisterDialog v-if="!user" @submit="onRegister" />
</template>
<script>
import ChatBox from './ChatBox.vue';
import Message from './Message.vue';

export default {
  name: "Messenger",
  components: {
    ChatBox,
    Message
  },
  created() {
    this.getChat();
  },
  methods: {
    onRegister(event, name) {
      event.preventDefault();
      // Generate a uuid for now.
      this.user = { name, id: uid() };
    },
    getChat() {
      listenChat((chat) => {
        this.messages = chat.reverse().map(m => ({ ...m, isMine: m.uid && m.uid === this.user?.id }));
      });
    },
    onSubmit(event, text) {
      event.preventDefault();

      sendMessage({
        text,
        uid: this.user?.id,
        author: this.user?.name
      });
    }
  },
  data() {
    return {
      user: undefined,
      messages: [
        {
          text: "I've got a job that might take yer fancy.",
          author: "Pope Turlock"
        },
        {
          text: "A large zombie horde is heading up O'Connel Street",
          author: "World message"
        },
        {
          text: "I see you have a soul. Care to sell it?",
          author: "Hades"
        },
        {
          text: "Algae slimes numbers are increasing rapidly, especially in the Red District near the Liffey.",
          author: "World message"
        },
        {
          text: "The subject is interpolated into a deconstructed theory of knowledge and experience as a totality.",
          author: "~~ waveylines ~~"
        },
        {
          text: "Whad are ye lookin' at?! If ya wish to keep them eyes...",
          author: "Hades"
        },
        {
          text: "Algae slimes numbers are increasing rapidly, especially in the Red District near the Liffey.",
          author: "Khan the Road Warrior"
        }
      ]
    }
  }
}
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

/* .message + .message {
  margin-top: 0.25rem;
}

.message.right {
  margin-left: auto;
} */
</style>
