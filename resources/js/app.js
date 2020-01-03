/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import colors from 'vuetify/lib/util/colors'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import MainApp from './MainApp.vue'

// ===VueRouter===
import VueRouter from 'vue-router';
import {routes} from './routes'
Vue.use(VueRouter);
const router = new VueRouter({
  routes,
  mode : 'history'
})

// ===Vuetify===
import Vuetify from 'vuetify';
Vue.use(Vuetify);
// =====STORE========
import Vuex from 'vuex'
import storeData from './store/index'
const store = new Vuex.Store(storeData)

// ===Vue i18n===
import sr from './translations/sr.json'
import en from './translations/en.json'
const languages = {
  en, sr
}
const messages = Object.assign(languages)
const defaultLocale = 'sr'
import VueI18n from 'vue-i18n'
Vue.use(VueI18n)
var i18n = new VueI18n({
  locale: defaultLocale,
  fallbackLocale: 'sr',
  messages
})

// ===Plugins===
import {localeSettings} from './plugins/locale'
Vue.use(localeSettings)




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-date-pickers', require('./components/AdminDatePickers.vue'));
Vue.component('guest-date-to-check-picker', require('./components/guest/DateToCheckPicker.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store,
    i18n,

    components : {
      MainApp,
    },
    vuetify : new Vuetify({
      theme: {
          themes: {
            light: {
              primary: colors.red.darken1, // #E53935
              secondary: colors.red.lighten4, // #FFCDD2
              accent: colors.indigo.base, // #3F51B5
            },
          },
        },
        icons: {
           iconfont: 'mdi', // default - only for display purposes
         },
    }),

});
