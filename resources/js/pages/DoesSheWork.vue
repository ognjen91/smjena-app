<template lang="html">
  <v-row class="py-3">
    <v-col cols="12" sm="6">
      <guest-date-to-check-picker
      @dateSelected='checkShift'
      ></guest-date-to-check-picker>
    </v-col>
    <v-col cols="12" sm="6" class="doesSheWorkValue">
      <h4 class="purple--text darken-4 py-0 mb-1 shiftValueSubtitle">{{$t('doesSheWork.question')}}?</h4>
      <transition enter-active-class="bounceIn"
                leave-active-class="lightSpeedOut"
                mode="out-in"
                :duration='500'>
                <h3 class="shiftValueTitle py-0 my-0" id="shiftValue" v-if="shiftValue">
                    {{$t(`shifts.${shiftValue}`)}}
                    <span v-if="shiftValue == 'Slobodan dan'"> :)</span>
                </h3>
      </transition>
    </v-col>
  </v-row>
</template>

<script>
export default {
  props : ['currentShift'],

  data(){
    return{
      shiftValue : '',
      dateToCheck : null,
      datesChecked : {},
      today: new Date().toISOString().substr(0, 10),
    }
  },
  methods : {
    checkShift(date){
      this.shiftValue = ""

      if(this.checkIfTheDateIsSunday(date)){
        this.shiftValue = 'Slobodan dan'
        return
      }

      //check if the date is already checked
      if(typeof this.datesChecked[date] !== 'undefined'){
        this.shiftValue = this.datesChecked[date];
        return
      }



      // this.shiftValue = "druga"
      axios.post('/checkShift', {date : date})
        .then(({data})=> {
          console.log(this.shiftValue);
          // console.log(data.value);
               // return otpSent(response)
               this.success = true
               this.shiftValue = data.value
               this.datesChecked[date] = data.value
        })
        .catch( (error)=> {
              console.log(error);
              this.error = true
              setTimeout(()=>{this.error = false}, 3000)
         });
    },

    checkIfTheDateIsSunday(date){
      var myDate = new Date(date)
      return myDate.getDay() == 0;eturn
    }
  },

  mounted(){
    this.checkShift(this.today)
  }

}
</script>

<style lang="css" scoped>
</style>
