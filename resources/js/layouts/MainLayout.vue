<template>
    <div>
      <Navbar />
      <div class="main-layout">
        <LeftSidebar />
        <MainContent />
      </div>
    </div>
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
