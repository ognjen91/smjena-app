<template lang="html">
    <v-row>
      <v-col sm="12">
        <v-row class="py-0">
            <v-col cols="12" sm="6" class="py-0">
              <p
              class="pickerChoice selectComponent selectStartingDay purple--text darken-4 title cursor-pointer"
              :class="{'active font-weight-bold' : activeComponent == 'StartingDay'}"
              @click="activeComponent = 'StartingDay'"
              >
              <v-icon class="purple--text darken-4">mdi-flag-checkered</v-icon>
              Početni parametri
            </p>
          </v-col>
          <v-col cols="12" sm="6" class="py-0">
            <p
            class="pickerChoice  selectComponent selectFreeDays green--text darken-4 title cursor-pointer"
            :class="{'active font-weight-bold' : activeComponent == 'FreeDays'}"
            @click="activeComponent = 'FreeDays'"
            >
            <v-icon class="green--text darken-4">mdi-owl</v-icon>
            Dodaj slobodne dane
          </p>
          </v-col>
        </v-row>
      </v-col>

      <v-col cols="12">
        <component
         :is='activeComponent'
         :free-days="freeDays"
         :starting-date="startingDate"
         >
         </component>
      </v-col>

    </v-row>
</template>

<script>
import FreeDays from './pickers/FreeDays.vue'
import StartingDay from './pickers/StartingDay.vue'
export default {
  components : {
    FreeDays,
    StartingDay
  },

  props : ['freeDays', 'startingDate'],

  data(){
    return {
      activeComponent : 'StartingDay'
      // activeComponent : 'FreeDays'
    }
  }
}
</script>

<style lang="css" scoped>
</style>
