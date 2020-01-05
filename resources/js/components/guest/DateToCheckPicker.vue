<template>
  <v-row class="guestPicker">
    <v-date-picker
     v-model="picker"
     color="purple darken-4"
      :allowed-dates="allowedDates"
      :first-day-of-week="1"
      :min="today"
      :locale="currentLocale == 'sr'? 'sr-Latn-CS' : 'en-US'"
     ></v-date-picker>
  </v-row>
</template>

<script>
  import moment from 'moment'
  export default {
    data () {
      return {
        // picker: new Date().toISOString().substr(0, 10),
        today: new Date().toISOString().substr(0, 10),
        picker : moment(new Date()).format("YYYY-MM-DD")
      }
    },
    methods: {
      allowedDates: val => ![0, 7].includes(new Date(val).getDay())
    },
    watch : {
      picker(newVal){
        this.$emit('dateSelected', newVal)
      }
    },
    mounted(){
      console.log(this.picker);
    }
  }
</script>
