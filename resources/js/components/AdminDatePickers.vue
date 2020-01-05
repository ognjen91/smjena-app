<template lang="html">
    <v-row>
      <v-col sm="12">
        <v-row class="py-0">
                <v-col cols="12" sm="4" class="py-0">
                  <p
                  class="text-center pickerChoice  selectComponent selectFreeDays green--text darken-2 title cursor-pointer"
                  :class="{'active font-weight-black' : activeComponent == 'FreeDays'}"
                  @click="activeComponent = 'FreeDays'"
                  >
                  <v-icon class="green--text darken-4">mdi-emoticon-happy-outline</v-icon>
                  Slobodni dani
                </p>
              </v-col>
              <v-col cols="12" sm="4" class="py-0">
                <p
                class="text-center pickerChoice  selectComponent selectFreeDays red--text darken-2 title cursor-pointer"
                :class="{'active font-weight-black' : activeComponent == 'FlippedShiftDays'}"
                @click="activeComponent = 'FlippedShiftDays'"
                >
                <v-icon class="red--text darken-2">mdi-rotate-3d-variant</v-icon>
                Izmjenjena smjena
              </p>
            </v-col>
            <v-col cols="12" sm="4" class="py-0">
              <p
              class="text-center pickerChoice selectComponent selectStartingDay purple--text darken-4 title cursor-pointer"
              :class="{'active font-weight-black' : activeComponent == 'StartingDay'}"
              @click="activeComponent = 'StartingDay'"
              >
              <v-icon class="purple--text darken-4">mdi-flag-checkered</v-icon>
              Početni parametri
            </p>
          </v-col>
        </v-row>
      </v-col>

      <v-col cols="12">
        <component
         :is='activeComponent'
         :free-days="freeDays"
         :flipped-shift-days="flippedShiftDays"
         :starting-date="startingDate"
         >
         </component>
      </v-col>

    </v-row>
</template>

<script>
import FreeDays from './pickers/FreeDays.vue'
import FlippedShiftDays from './pickers/FlippedShiftDays.vue'
import StartingDay from './pickers/StartingDay.vue'
export default {
  components : {
    FreeDays,
    FlippedShiftDays,
    StartingDay
  },

  props : ['freeDays', 'flippedShiftDays', 'startingDate'],

  data(){
    return {
      activeComponent : 'FlippedShiftDays'
      // activeComponent : 'FreeDays'
    }
  }
}
</script>

<style lang="css" scoped>
</style>
