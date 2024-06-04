<template>
    <div class="navbar">
      <div class="navbar-left">
        <a-button
            @click="(() => {
                $router.push({
                    name: 'Home'
                });
            })"
        >
            {{ 'Dashboard' }}
        </a-button>
      </div>
      <div class="navbar-right">
        <!-- <a-select style="width: 300px;"
            v-model:value="currentStore"
        >
          <a-select-option
          v-for="store in stores"
          :key="store.id" :value="store.id"> {{ store.name }}</a-select-option>
        </a-select> -->
      </div>
    </div>
  </template>

  <script>

  import {HomeOutlined} from '@ant-design/icons-vue';
  import {ref, onMounted, watch} from 'vue';
  import axios from '../plugins/axios';
  export default {
    name: 'Navbar',
    components: {
        HomeOutlined,
    },
    setup() {

        const stores = ref([]);
        const currentStore = ref(undefined);

        onMounted(() => {
            // axios.get(`stores`).then((res) => {
            //     stores.value = res.data;
            //     if (localStorage.getItem('store_id') != res.data[0].id) {
            //         currentStore.value = localStorage.getItem('store_id');
            //     }
            //     else {
            //         currentStore.value = res.data[0].id;
            //     };
            // });
        });

        watch(() => currentStore.value,
            (newVal, oldVal) => {
                if (localStorage.getItem('store_id') != newVal) {
                    localStorage.setItem('store_id', newVal);
                }
            }
        );

        return {
            stores,
            currentStore,
        };
    },
  };
  </script>

  <style scoped>
  .navbar {
    width: 100%;
    height: 60px;
    background-color: #282d2b;
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
