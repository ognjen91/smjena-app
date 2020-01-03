  <template lang="html">
  <v-row justify="center">

      <v-col cols="8" class='my-0 py-0'>
        <h3 class="text-center purple--text darken-4">Odabir početne smjene</h3>
        <SelectStartingShift :shift='startingDate.shift' />
      </v-col>

      <v-col cols="8" class='mt-0 mb-1 py-0'>
        <h3 class="text-center purple--text darken-4 my-0 py-0">Broj dana do promjene smjene</h3>
        <DurationOfShift :value="startingDate.durationOfShiftInDays" />
      </v-col>


      <v-col cols="8" class='my-0 py-0'>
        <h3 class="text-center purple--text darken-4">Odabir prvog dana smjene</h3>
      </v-col>
      <v-col cols="12" md='8' class="d-flex justify-center">
        <v-date-picker
        color="purple darken-4"
         v-model="picker"
        :allowed-dates="allowedDates"
        :first-day-of-week="1"
        locale="sr-Latn-CS"
        >
        </v-date-picker>
      </v-col>


  </v-row>
  </template>

  <script>
    import SelectStartingShift from './includes/SelectStartingShift'
    import DurationOfShift from './includes/DurationOfShift'
    export default {
      components : {
        SelectStartingShift,
        DurationOfShift
      },
      props : ['startingDate'],
      data () {
        return {
          picker: new Date().toISOString().substr(0, 10),
          success : false,
          error : false
        }
      },

      methods: {
        allowedDates: val => ![0, 7].includes(new Date(val).getDay())
      },


      mounted(){
        this.picker = this.startingDate.date
      },

      watch : {
        picker(newVal){
          axios.post('/update/startingDate', {date : this.picker})
            .then(function (response) {
                   // return otpSent(response)
                   this.success = true
                   setTimeout(()=>{this.success = false}, 3000)
            })
            .catch(function (error) {
                  console.log(error.response);
                  this.error = true
                  setTimeout(()=>{this.error = false}, 3000)
             });
      }
    }
  }
  </script>

  <style lang="css" scoped>
  </style>
