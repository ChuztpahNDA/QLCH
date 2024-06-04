import {createRouter, createWebHistory} from 'vue-router';
import Home from '../views/dashboard/Dashboard.vue';
import Login from '../views/auth/Login.vue';
import Register from '../views/auth/Register.vue';
import store from './store';
import product from './product';



const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
        path: '',
        redirect: '/login'
    },
    {
      path: '/home',
      name: 'home',
      component: Home,
      meta: { layout: 'main' },
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: { layout: 'auth' },
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      meta: { layout: 'auth' },
    },
    ...store,
    ...product
    // Thêm các route khác ở đây nếu cần
  ]
});

export default router;
