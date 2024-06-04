<template>
    <component :is="layout">
      <router-view />
    </component>
  </template>

  <script>
  import { defineComponent, onMounted, onUnmounted, computed } from 'vue';
  import MainLayout from './layouts/MainLayout.vue';
  import AuthLayout from './layouts/AuthLayout.vue';
  import { useStore } from 'vuex';
  import { useRouter } from 'vue-router';

  export default defineComponent({
    name: 'App',
    components: {
      MainLayout,
      AuthLayout,
    },
    setup() {
      const router = useRouter();
      const store = useStore();

      const layout = computed(() => {
        const layout = router.currentRoute.value.meta.layout || 'main';
        return layout === 'auth' ? 'AuthLayout' : 'MainLayout';
      });

      const startTokenRefreshInterval = () => {
        // setInterval(() => {
        //   store.dispatch('refreshToken');
        // }, 1 * 60 * 1000); // Refresh token mỗi phút
      };

      onMounted(() => {
        startTokenRefreshInterval();
      });

      onUnmounted(() => {
        clearInterval(startTokenRefreshInterval);
      });

      return {
        layout,
      };
    },
  });
  </script>

  <style>
  body,
  html,
  #app {
    margin: 0;
    padding: 0;
    height: 100%;
  }
  </style>
