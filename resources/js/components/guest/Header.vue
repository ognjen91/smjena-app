<template lang="html">
<header class="">
<v-row class="logoHolder purple darken-4">
  <v-col cols='4' sm="2" class="logo ">
    <router-link
     :to="{ name: 'homepage', params: {} }"
      tag="img"
      class="theLogo cursor-pointer"
      src="/assets/logo-white.png"
      >
      </router-link>
  </v-col>
</v-row>
<v-row class="purple darken-2">
  <v-col cols="4" class="d-flex justify-center">
    <router-link
     :to="{ name: 'homepage', params: {} }"
      class="lime--text darken-2 text-center"
    >
    {{$t("header.home")}}
    </router-link>
  </v-col>
  <v-col cols="4" class="d-flex justify-center">
    <router-link
     :to="{ name: 'doesSheWork', params: {} }"
      class="lime--text darken-2 text-center"
    >
    {{$t("header.checkByDate")}}
    </router-link>
  </v-col>
  <v-col cols="4" class="d-flex justify-center">
    <router-link
     :to="{ name: 'about', params: {} }"
      class="lime--text darken-2 text-center"
    >
    {{$t("header.about")}}
  </router-link>
  </v-col>
  <LocaleSelect :locale='locale' />
</v-row>
</header>
</template>

<script>
import LocaleSelect from './Locale.vue'
export default {
  components : {
    LocaleSelect
  },
  props : ['locale'],

}
</script>

<style lang="css" scoped>
</style>
