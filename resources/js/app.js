
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import routes from './routes.js';
import router from './routes.js';
import StoreData from './store.js';
import Vue from 'vue';
import axios from 'axios';
import Vuex from 'vuex'
import VeeValidate from 'vee-validate';
import {initialize} from './helpers/general';
import BootstrapVue from 'bootstrap-vue'
import LoginNavComponent from './components/Navbars/LoginNavComponent.vue';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(Vuex); 
Vue.use(VeeValidate);
Vue.use(BootstrapVue)

const store= new Vuex.Store(StoreData);

// initialize(store, router);

window.axios = axios;
window.Vue = require('vue');
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
// Vue.component('haha', LoginNavComponent);
Vue.component('login-component', require('./components/LoginComponent.vue').default);

Vue.component('ads', require('./components/Ads.vue').default);
Vue.component('categories', require('./components/Categories.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
export default store;
const app = new Vue({
    el: '#app',
    store,
    router:routes
});
