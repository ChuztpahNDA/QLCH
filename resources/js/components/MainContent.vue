<template>
    <div class="main-content">
      <router-view></router-view>
    </div>
  </template>

  <script>
  export default {
    name: 'MainContent',
  };
  </script>

  <style scoped>
  .main-content {
    padding: 20px;
    min-height: 100vh;
  }
  </style>
