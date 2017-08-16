
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


const flatpickr = require("flatpickr");

flatpickr(".flatpickr", {
    enableTime: true,
    time_24hr: true,
    minDate: 'today',
    altInput: true,
    altFormat: 'Y-m-d H:i',

    onChange: function(selectedDates, dateStr, fp) {
        if (!selectedDates.length)
            return;
        const ISODate = selectedDates[0].toISOString(); // iso date str
        $('#due').val(ISODate);
    },
    onReady: function (selectedDates, dateStr, instance) {
        var moment = require('moment-timezone');

        instance.setDate(moment.tz(moment.utc(dateStr), moment.tz.guess()).format());
        $('#due').val(moment.utc(dateStr).format());
    }


});

Vue.component('countdown', require('./components/Countdown.vue'));
Vue.component('timezone', require('./components/Timezone.vue'));

const app = new Vue({
    el: '#vue'
});