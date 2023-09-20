//import { defineCustomElements as defineIonPhaser } from '@ion-phaser/core/loader';
import { createApp } from "vue"
import { createPinia } from "pinia"
import App from "./App.vue"

// Import Bootstrap and BootstrapVue CSS files (order is important)
//import 'bootstrap/dist/css/bootstrap.min.css'
// Import all of Bootstrap's JS
//import * as bootstrap from 'bootstrap'

/* import LogRocket from 'logrocket';
LogRocket.init('dfigai/jigs');
// This is an example script - don't forget to change it!
LogRocket.identify('THE_USER_ID_IN_YOUR_APP', {
  name: 'James Morrison',
  email: 'jamesmorrison@example.com',
  // Add your own custom user variables here, ie:
  subscriptionType: 'pro'
}); */
const pinia = createPinia()
//Vue.config.productionTip = false
//App.config.ignoredElements = [/ion-\w*/];
 let wrapper = window.document.querySelector('#module-name-game')
 if (wrapper) {
  let app = window.document.createElement('div');
  app.setAttribute('id', 'client');
  app.setAttribute("class", "client");
  wrapper.insertBefore(app, wrapper.childNodes[0])
}
//defineIonPhaser(window);
createApp(App).use(pinia).mount('#client');
