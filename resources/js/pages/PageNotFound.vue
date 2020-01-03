<template lang="html">
  <main class='row about deep-purple darken-2'>
    <v-col class="d-flex justify-center flex-column">
      <h3 class="text-center white--text darken-2">{{$t('pageNotFound.title')}}...</h3>
      <h4 class="text-center white--text darken-2">
        {{$t('pageNotFound.subtitle')}}
         <router-link :to="{ name: 'homepage', params: {} }"class="text-center yellow--text darken-2 font1 underline">
            {{$t('pageNotFound.here')}}
          </router-link>
      </h4>

    </v-col>

  </main>
</template>
