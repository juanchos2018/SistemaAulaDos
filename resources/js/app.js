//require('./bootstrap');

window.Vue = require('vue').default;
// import core styles
//require('../../resources/scss/core.scss')
//require('@resources/scss/core.scss')
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import Vuex from 'vuex'

Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons)
Vue.use(Vuex)

import FeatherIcon from './core/FeatherIcon.vue'
import "vue-select/dist/vue-select.css";
import "./scss/vue-select.scss";
//import EventBus from "./assets/js/EventBus";
Vue.component(FeatherIcon.name, FeatherIcon)


Vue.component('lista', require('./components/lista.vue').default);
Vue.component('vsemplox-list', require('./components/VsEmploxList.vue').default);
Vue.component('vssecmat-list', require('./components/VsSecmatList.vue').default);

const app = new Vue({
    el: '#app',
    
});