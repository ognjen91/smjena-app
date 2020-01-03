<template lang="html">
  <v-container fluid class="py-0 px-0 theAppContainer">
    <Header />
    <transition :name="transitionName"  mode="out-in"  >
      <router-view
      class="mainContent"
      :currentShift="currentShift"
      ></router-view>
    </transition>
    <Footer />
  </v-container>
</template>

<script>
import Header from './components/guest/Header.vue'
import Footer from './components/guest/Footer.vue'
export default {
  components : {
    Header,
    Footer
  },
  props : ['currentShift', 'locale'],

  data(){
    return {
      transitionName : "animated fadeIn"
    }
  },

  mounted(){
    this.$i18n.locale = this.locale
    this.$store.commit('locale/SET_LOCALE', this.locale)
  },

  watch: {
  '$route' (to, from) {
    const toDepth = to.path.split('/').length
    const fromDepth = from.path.split('/').length
    this.transitionName = toDepth < fromDepth ? 'fadeIn' : 'bounceIn'
  }
}
}
</script>

<style lang="css" scoped>
</style>
