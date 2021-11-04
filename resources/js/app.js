/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        { path: '/', component:  require('./components/BooksNavigator.vue').default },
        { path: '/book/:isbn', component:  require('./components/BookDetails.vue').default },
    ],
    mode: 'history',
})

const app = new Vue({
    router,
}).$mount('#app');
