import axios from 'axios'
// import  i18n  from  'vue-i18n'

export default {
  namespaced: true,

  state : {
    currentLocale : "sr",
    locales : {
      "en" : "English",
      "sr" : "Srpski",
    }
  },

  getters : {
    currentLocale : (state) => state.currentLocale,
    currentLocaleFullName : (state) => {
      return state.locales[state.currentLocale]
    }
  },

  mutations : {
    SET_LOCALE : (state, payload) => {
      state.currentLocale = payload
    },

  },

    actions : {
     async  setLocale(context, payload){
        // console.log(payload.locale);
        await axios.post('/setLocale', {
            locale : payload
          })
          .then(function (response) {
            context.commit('SET_LOCALE', payload)
            // console.log(response);
          })
          .catch(function (error) {
            // console.log(error);
          });

      }
    }


}
