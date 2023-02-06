//import { defineCustomElements as defineIonPhaser } from '@ion-phaser/core/loader';
import { createApp } from "vue";
import { createPinia } from "pinia"
import App from "./App.vue"


const pinia = createPinia()
//Vue.config.productionTip = false
//App.config.ignoredElements = [/ion-\w*/];

 let wrapper = window.document.querySelector('#module-name-game')
if (wrapper) {
  let app = window.document.createElement('div')

  app.setAttribute('id', 'client')
  wrapper.insertBefore(app, wrapper.childNodes[0])
}
//defineIonPhaser(window);
createApp(App).use(pinia).mount('#client');


