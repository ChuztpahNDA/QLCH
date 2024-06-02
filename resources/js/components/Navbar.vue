<template>
    <div class="navbar">
      <div class="navbar-left">
        <h1>POS System</h1>
      </div>
      <div class="navbar-right">
        <a-button @click="switchStore">Switch Store</a-button>
      </div>
    </div>
  </template>

  <script>
  export default {
    name: 'Navbar',
    methods: {
      switchStore() {
        // Logic để chuyển đổi cửa hàng
        alert('Switch Store clicked!');
      },
    },
  };
  </script>

  <style scoped>
  .navbar {
    width: 100%;
    height: 60px;
    background-color: #34495e;
    color: #ecf0f1;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
  }

  .navbar-left h1 {
    margin: 0;
  }

  .navbar-right {
    display: flex;
    align-items: center;
  }

  .navbar-right button {
    margin-left: 20px;
  }
  </style>
