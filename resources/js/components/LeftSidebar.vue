<template>
    <div class="left-sidebar">
      <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Sales</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">Customers</a></li>
        <li><a href="#">Reports</a></li>
        <li><a href="#">Settings</a></li>
      </ul>
    </div>
  </template>

  <script>
  export default {
    name: 'LeftSidebar',
  };
  </script>

  <style scoped>
  .left-sidebar {
    width: 250px;
    background-color: #2c3e50;
    color: #ecf0f1;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    padding: 20px;
  }

  .left-sidebar ul {
    list-style: none;
    padding: 0;
  }

  .left-sidebar ul li {
    margin: 20px 0;
  }

  .left-sidebar ul li a {
    color: #ecf0f1;
    text-decoration: none;
  }

  .left-sidebar ul li a:hover {
    text-decoration: underline;
  }
  </style>
