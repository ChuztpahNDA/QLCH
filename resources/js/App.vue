<template>
    <component :is="layout">
      <router-view />
    </component>
  </template>

  <script>
  import MainLayout from './layouts/MainLayout.vue';
  import AuthLayout from './layouts/AuthLayout.vue';

  export default {
    name: 'App',
    computed: {
      layout() {
        const layout = this.$route.meta.layout || 'main';
        return layout === 'auth' ? 'AuthLayout' : 'MainLayout';
      }
    },
    components: {
      MainLayout,
      AuthLayout,
    },
  };
  </script>

  <style>
  body, html, #app {
    margin: 0;
    padding: 0;
    height: 100%;
  }
  </style>
