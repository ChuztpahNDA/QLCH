import { createApp } from 'vue';
import 'ant-design-vue/dist/reset.css';
import Antd from 'ant-design-vue';
import axios from 'axios';
import router from '/resources/js/router/index.js';
import App from '/resources/js/App.vue';
import store from './store';
import '/resources/js/index.css';

const app = createApp(App);

// Configure Axios to use the Vuex store
axios.interceptors.request.use(config => {
    const access_token = store.getters.getToken;
    if (access_token) {
        config.headers.Authorization = `Bearer ${access_token}`;
    }
    return config;
}, error => {
    return Promise.reject(error);
});

// Cấu hình CSRF token cho axios nếu cần thiết
const csrfToken = document.querySelector('meta[name="csrf-token"]');
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
}

app.config.productionTip = false;

// Sử dụng Antd, router và store
app.use(Antd);
app.use(router);
app.use(store);

// Gắn ứng dụng vào phần tử DOM có id là 'app'
app.mount('#app');
