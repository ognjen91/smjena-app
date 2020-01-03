<template lang="html">
  <v-row justify="center">
    <v-col cols="8">

      <h3 class="text-center green--text darken-4 subtitle-2">
        Slobodni datumi su označeni zelenom bojom. <br>
        Klikom na dan, status dana će biti izmjenjen. <br>
        Nedelje su automatski slobodni dani i nije ih potrebno označavati!
      </h3>
    </v-col>

    <v-col cols="12" md="8" class="d-flex justify-center">
      <v-date-picker
       multiple
       color="green darken-4"
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
    props : ['freeDays'],
    data () {
      return {
          dates : [],
          success : false,
          error : false,
      }
    },


    methods: {
      allowedDates: val => ![0, 7].includes(new Date(val).getDay())
    },


    mounted(){
      this.dates = [...this.dates, ...this.freeDays]
    },

    watch : {
      dates(newVal, oldVal){
        let difference;
        let dateToAdd = newVal.find(theDate => !oldVal.includes(theDate));
        let dateToChangeStatus = dateToAdd
        // console.log("to add " + dateToAdd);
        if(typeof dateToChangeStatus == 'undefined'){
          dateToChangeStatus = oldVal.find(theDate => !newVal.includes(theDate));
          // console.log("to remove " + dateToRemove);
        }

        axios.post('/update/freeDays', {date : dateToChangeStatus})
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
