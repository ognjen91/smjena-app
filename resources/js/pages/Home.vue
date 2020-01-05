<template lang="html">
  <main class='row homepage purple accent-4' :class="{'freeDay' : theActiveShift == 'Slobodan dan'}">
    <v-col cols="12">
      <h3
       class="w-100 text-center yellow--text darken-1 font1 whichShiftQuestion" :class="{'freeDayQuestion' : theActiveShift == 'Slobodan dan'}"
       >{{$t('home.currentShiftTitle')}}</h3>
       <transition enter-active-class="animated bounceIn"
                 leave-active-class="lightSpeedOut"
                 mode="out-in"
                 :duration='500'>
                  <h1
                  v-if="theActiveShift"
                  class="currnetShiftValue text-center font2"
                  :class="{
                    'amber--text lighten-1' : theActiveShift == 'prva',
                     'amber--text darken-1' : theActiveShift == 'druga',
                     'onFreeDay light-green--text lighten-3' : theActiveShift == 'Slobodan dan' || theActiveShift == 'Slobodan dan danas'}"
                  >
                  {{$t(`shifts.${this.theActiveShift}`)}}
                </h1>
    </transition
      <v-row class="">
        <v-col cols="12" class="shiftImage">
          <v-img
          :src="theActiveShift == 'prva'? '/assets/highSeal.png' : theActiveShift == 'druga'? '/assets/afternoon.png' : '/assets/resting.png'"
          lazy-src="/assets/logo.png"
          class="theImage"
          :class="{'freeDayImg' : theActiveShift == 'Slobodan dan'}"
          >
        </v-img>
        </v-col>
      </v-row>

    </v-col>
  </main>
</template>

<script>
import moment from 'moment'

export default {
  props : ['currentShift'],
  data(){
    return{
      theActiveShift : "",
      // today: new Date().toISOString().substr(0, 10),
      picker : moment(new Date()).format("YYYY-MM-DD")

    }
  },
  methods : {
    checkShift(date){
      this.theActiveShift = ""

      let today =  moment(new Date()).format("YYYY-MM-DD")

      /*
      CHECK IF SUNDAY (1/2...CheckShit.php = 2/2)
       */
      if(this.checkIfTheDateIsSunday(today)){
        this.theActiveShift = 'Slobodan dan danas'
        return
      }


      // this.shiftValue = "druga"
      axios.post('/checkShift', {date : date})
        .then(({data})=> {
               this.theActiveShift = data.value
        })
        .catch( (error)=> {
              console.log(error);
         });
    },

    checkIfTheDateIsSunday(date){
      var myDate = new Date(date)
      return myDate.getDay() == 0;
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
