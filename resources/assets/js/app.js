
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


const flatpickr = require("flatpickr");

flatpickr(".flatpickr", {
    enableTime: true,
    enableSeconds:true
});

Vue.component('countdown', require('./components/Countdown.vue'));

const app = new Vue({
    el: '#countdown'
});