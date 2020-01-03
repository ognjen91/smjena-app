// ADMIN
import Homepage from './pages/Home.vue';
import DoesSheWork from './pages/DoesSheWork.vue';
import About from './pages/About.vue';
import PageNotFound from './pages/PageNotFound.vue';





export const routes = [
  {
    path : '/',
    component : Homepage,
    name : 'homepage',
  },
  {
    path : '/doesSheWork',
    component : DoesSheWork,
    name : 'doesSheWork',
  },
  {
    path : '/about',
    component : About,
    name : 'about',
  },

  { path: "*", component: PageNotFound }






]
