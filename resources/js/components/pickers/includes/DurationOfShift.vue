<template lang="html">
  <div>
    <v-text-field
          label="Regular"
          single-line
          v-model="theValue"
        >
    </v-text-field>
  </div>
</template>

<script>
  export default {
    props : ['value'],

    data () {
      return {
        theValue: '',
        counter : 0
      }
    },
    methods: {
      appendIconCallback () {},
      prependIconCallback () {},
    },

    mounted(){
      this.theValue = this.value
    },

    watch : {
      theValue(newVal){
        this.counter++
        if(!this.counter == 1) return

        axios.post('/update/durationOfShiftInDays', {durationOfShiftInDays : this.theValue})
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
