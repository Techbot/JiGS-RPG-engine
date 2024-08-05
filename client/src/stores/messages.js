import { defineStore } from "pinia";

export const useChatMessageStore = defineStore("chatMessages", {
  persist: true,
  state: () => ({
    id: 0,
    chatMessages: [
      {
        id: 0,
        text: "I've got a job that might take yer fancy.",
        author: "Pope Turlock"
      },
      {
        id: 1,
        text: "A large zombie horde is heading up O'Connel Street",
        author: "World message"
      },
      {
        id: 2,
        text: "I see you have a soul. Care to sell it?",
        author: "Hades"
      },
      {
        id: 3,
        text: "Algae slimes numbers are increasing rapidly, especially in the Red District near the Liffey.",
        author: "World message"
      },
      {
        id: 4,
        text: "The subject is interpolated into a deconstructed theory of knowledge and experience as a totality.",
        author: "~~ waveylines ~~"
      },
      {
        id: 5,
        text: "Whad are ye lookin' at?! If ya wish to keep them eyes...",
        author: "Khan the Road Warrior"
      }
    ]
  }),
  getters: {

  },
  actions: {
    addChatMessage(message) {
      this.chatMessages.unshift({ id: this.id++, text: message, author: 'You' })
    }
  },
});
