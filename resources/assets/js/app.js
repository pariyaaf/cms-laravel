
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding comppnents to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('payment', require('./components/Payment.vue'));
const app = new Vue({
    el: '#app'
});


Echo.private('articles.admin')
    .listen('ArticleEvent' , function (e) {
       console.log(e);
    });