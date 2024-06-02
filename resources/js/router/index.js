import {createRouter, createWebHistory} from 'vue-router';
import Home from '../views/Home.vue';
import Login from '../views/auth/Login.vue';
import Register from '../views/auth/Register.vue';


const routes = [
    {
      path: '/',
      name: 'Home',
      component: Home,
      meta: { layout: 'main' },
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: { layout: 'auth' },
    },
    {
      path: '/register',
      name: 'Register',
      component: Register,
      meta: { layout: 'auth' },
    },
    // Thêm các route khác ở đây nếu cần
  ];


const router = createRouter({
  history: createWebHistory(),
  routes
});

// Middleware kiểm tra authentication
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!store.state.isAuthenticated) {
        next({
          path: '/login',
          query: { redirect: to.fullPath }
        });
      } else {
        next();
      }
    } else {
      next();
    }
  });

export default router;
