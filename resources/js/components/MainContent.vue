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
    margin-left: 250px;
    padding: 20px;
    background-color: #ecf0f1;
    min-height: 100vh;
    margin-top: 60px; /* Độ cao của navbar */
  }
  </style>
