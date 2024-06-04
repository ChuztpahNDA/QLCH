<template>
    <a-layout>
    <a-layout-header class="header">
      <Navbar />
    </a-layout-header>
    <a-layout-content style="padding: 0 50px">
      <a-layout style="padding: 24px 0; background: #fff">
        <a-layout-sider width="200" style="background: #fff">
            <LeftSidebar />
        </a-layout-sider>
        <a-layout-content :style="{minHeight: '280px' }">
            <MainContent />
        </a-layout-content>
      </a-layout>
    </a-layout-content>
  </a-layout>
  </template>

  <script>
  import Navbar from '../components/Navbar.vue';
  import LeftSidebar from '../components/LeftSidebar.vue';
  import MainContent from '../components/MainContent.vue';

  export default {
    name: 'MainLayout',
    components: {
      Navbar,
      LeftSidebar,
      MainContent,
    },
  };
  </script>

  <style scoped>
  .main-layout {
    display: flex;
    margin-top: 60px; /* Độ cao của navbar */
  }
  </style>
