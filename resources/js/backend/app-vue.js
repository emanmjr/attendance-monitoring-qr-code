
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import '../bootstrap';
import '../plugins';
import Vue from 'vue';
import Vuex from 'vuex'


window.Vue = Vue;

Vue.use(Vuex)

import storeData from "./store/transaction/index"

const store = new Vuex.Store(
   storeData
)




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('transactions', require('./components/Transaction.vue').default);
Vue.component('my-wu-enrollment', require('./components/MyWUEnrollment.vue').default);
Vue.component('kyc-lookup', require('./components/KYCLookUp.vue').default);
Vue.component('das-request', require('./components/DasRequest.vue').default);
Vue.component('my-wu-lookup', require('./components/MYWULookup.vue').default);

Vue.config.errorHandler = function(err, vm, info) {
  console.log(`Error: ${err.toString()}\nInfo: ${info}`);
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'Can you please try again.',
    footer: '' + err.toString()
  })
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app1',
    store
});