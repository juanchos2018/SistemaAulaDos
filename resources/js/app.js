//require('./bootstrap');

window.Vue = require('vue').default;
// import core styles
//require('../../resources/scss/core.scss')
//require('@resources/scss/core.scss')
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
Vue.use(BootstrapVue);





Vue.component('lista', require('./components/lista.vue').default);

const app = new Vue({
    el: '#app',
    
});