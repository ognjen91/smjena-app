<template lang="html">
  <v-row justify="center">
    <v-col cols="8">

      <h3 class="text-center red--text darken-2 subtitle-2">
        Datumi za koje je zamjenjena smjena su označeni crvenom bojom. <br>
        Klikom na dan, dan će biti ubačen/skinut sa liste onih kojima je smjena izmjenjena. <br>
      </h3>
    </v-col>

    <v-col cols="12" md="8" class="d-flex justify-center">
      <v-date-picker
       multiple
       color="red darken-2"
       v-model="dates"
       :allowed-dates="allowedDates"
       :first-day-of-week="1"
       locale="sr-Latn-CS"
       >
       </v-date-picker>
    </v-col>


  </v-row>
</template>

<script>
  export default {
    props : ['flippedShiftDays'],
    data () {
      return {
          counter : 0,
          dates : [],
          success : false,
          error : false,
      }
    },


    methods: {
      allowedDates: val => ![0, 7].includes(new Date(val).getDay()),
      datePicked(date){
        console.log(date);
      }
    },


    mounted(){
      this.dates = [...this.dates, ...this.flippedShiftDays]
    },

    watch : {
      dates(newVal, oldVal){
        this.counter++
        if(this.counter == 1) return
        let difference;
        let dateToAdd = newVal.find(theDate => !oldVal.includes(theDate));
        let dateToChangeStatus = dateToAdd
        // console.log("to add " + dateToAdd);
        if(typeof dateToChangeStatus == 'undefined'){
          dateToChangeStatus = oldVal.find(theDate => !newVal.includes(theDate));
          // console.log("to remove " + dateToRemove);
        }

        axios.post('/update/flippedShiftDays', {date : dateToChangeStatus})
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
