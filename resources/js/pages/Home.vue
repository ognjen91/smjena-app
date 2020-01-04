<template lang="html">
  <main class='row homepage purple accent-4'>
    <v-col cols="12">
      <h3
       class="w-100 text-center yellow--text darken-1 font1"
       >{{$t('home.currentShiftTitle')}}</h3>
       <transition enter-active-class="animated bounceIn"
                 leave-active-class="lightSpeedOut"
                 mode="out-in"
                 :duration='500'>
                  <h1
                  v-if="theActiveShift"
                  class="currnetShiftValue text-center font2"
                  :class="{'light-green--text lighten-3' : theActiveShift == 'prva', 'amber--text darken-1' : theActiveShift == 'druga'}"
                  >
                  {{$t(`shifts.${this.theActiveShift}`)}}
                </h1>
    </transition
      <v-row class="">
        <v-col cols="12" class="shiftImage">
          <v-img
          :src="theActiveShift == 'prva'? '/assets/highSeal.png' : '/assets/afternoon.png'"
          lazy-src="/assets/logo.png"
          class="theImage"
          >
        </v-img>
        </v-col>
      </v-row>

    </v-col>
  </main>
</template>

<script>
export default {
  props : ['currentShift'],
  data(){
    return{
      theActiveShift : "",
      today: new Date().toISOString().substr(0, 10),
    }
  },
  methods : {
    checkShift(date){
      this.theActiveShift = ""

      if(this.checkIfTheDateIsSunday(date)){
        this.theActiveShift = 'Slobodan dan'
        return
      }


      // this.shiftValue = "druga"
      axios.post('/checkShift', {date : date})
        .then(({data})=> {
          // console.log(this.shiftValue);
          // console.log(data.value);
               // return otpSent(response)
               // this.success = true
               this.theActiveShift = data.value
               // this.datesChecked[date] = data.value
        })
        .catch( (error)=> {
              console.log(error);
              // this.error = true
              // setTimeout(()=>{this.error = false}, 3000)
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
  body{
    background-color: #AA00FF !important;
  }
</style>
