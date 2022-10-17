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
import "./scss/vue-flatpicker.scss";
//import EventBus from "./assets/js/EventBus";
Vue.component(FeatherIcon.name, FeatherIcon)


Vue.component('lista', require('./components/lista.vue').default);
Vue.component('vsemplox-list', require('./components/VsEmploxList.vue').default);
Vue.component('vssecmat-list', require('./components/VsSecmatList.vue').default);
Vue.component('vstudent-list', require('./components/VstudentList.vue').default);
Vue.component('vsabsent-list', require('./components/VsAbsentList.vue').default);
Vue.component('vsnotify-list', require('./components/VsNotifyList.vue').default);
Vue.component('vschedul-list', require('./components/VsChedulList.vue').default);
Vue.component('vslibstd-list', require('./components/VsLibstdList.vue').default);
Vue.component('vslibsec-list', require('./components/VsLibsecList.vue').default);
Vue.component('vsactsav-list', require('./components/VsActsavList.vue').default);
Vue.component('vsactmat-list', require('./components/VsActmatList.vue').default);

const app = new Vue({
    el: '#app',
    
});