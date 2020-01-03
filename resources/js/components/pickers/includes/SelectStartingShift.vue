<template lang="html">
  <v-row>
    <v-col cols="12" sm="8"></v-col>
          <v-select
          :items="shifts"
          v-model="currentShift"
          label="Smjena"
          >
        </v-select>
        
    <v-col cols="12" sm="8">
      <v-col cols="8">
          <p class="red--text" v-if="error">
             Došlo je do greške. <br>
             Obratite se autoru aplikacije.
           </p>
          <p class="red--text" v-if="success">
             Početni datum ažuriran
           </p>
      </v-col>
    </v-col>
  </v-row>
</template>

<script>
export default {
  props : ['shift'],
  data(){
    return{
      shifts : ['prva', 'druga'],
      currentShift : 'first',
      success : false,
      error : false
    }
  },
  mounted(){
    this.currentShift = this.shift
  },
  watch : {
    currentShift(newVal){
      axios.post('/update/startingShift', {shift : newVal})
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
