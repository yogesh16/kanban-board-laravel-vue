import Vue from 'vue'
import App from './App.vue'
import VModal from 'vue-js-modal'
window.axios = require('axios');
import './assets/css/tailwind.css'

Vue.config.productionTip = false

//Plugins
Vue.use(VModal, { dialog: true })

new Vue({
  render: h => h(App),
}).$mount('#app')
