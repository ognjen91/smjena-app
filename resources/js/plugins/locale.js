export const localeSettings = {
  //making vue plugin
  install(Vue, options){
    //now inject the mixin
    Vue.mixin({

      data(){
        return {
          locales : [
            {name : 'Srpski', value : 'sr'},
            {name : 'English', value : 'en'}
          ]
        }
      },

      computed : {
        currentLocale : {
          get : function(){
            return this.$store.getters['locale/currentLocale']
          },
          set : function(newVal){
            // console.log(newVal);
            this.$i18n.locale = newVal
            this.$store.dispatch('locale/setLocale', newVal)
          }
        }
      },







    })
  }
}
