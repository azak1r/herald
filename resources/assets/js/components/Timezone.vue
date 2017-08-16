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
                utc: moment.utc(this.date).format('Y-m-d H:mm z'),
                localized: moment.tz(moment.utc(this.date), moment.tz.guess()).format('Y-m-d H:mm z')
            }
        },
    }
</script>