<template>
    <abbr :title="utc">{{localized}}</abbr>
</template>

<script>
    var moment = require('moment-timezone');

    export default {
        props : {
            date: String,
        },

        data() {
            return {
                utc: moment.utc(this.date).format('YYYY-MM-DD HH:mm z'),
                localized: moment.tz(moment.utc(this.date), moment.tz.guess()).format('YYYY-MM-DD HH:mm z')
            }
        },
    }
</script>