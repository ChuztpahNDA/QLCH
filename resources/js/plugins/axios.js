import axios from 'axios';
import store from '../store'; // Đường dẫn này phụ thuộc vào cấu trúc thư mục của dự án
import router from '@/router';
// Cấu hình CSRF token cho axios nếu cần thiết
const csrfToken = document.querySelector('meta[name="csrf-token"]');
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
}


const api = axios.create({
    baseURL: window.location.origin + '/api/v1', // Thay thế URL này bằng URL API của bạn
    headers: {
        'Content-Type': 'application/json',
    },
});

api.interceptors.request.use(
    config => {
        const token = store.getters['access_token'];
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        } else {
            router.push({
                name: 'login'
            });
        }
        return config;
    },
    error => {
        return Promise.reject(error);
    }
);

export default api;
