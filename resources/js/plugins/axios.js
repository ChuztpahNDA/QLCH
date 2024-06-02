import axios from 'axios';
import store from './store'; // Đường dẫn này có thể thay đổi tùy theo cấu trúc dự án của bạn

const api = axios.create({
  baseURL: 'http://your-laravel-app.test/api', // Thay thế URL này bằng URL API của bạn
  headers: {
    'Content-Type': 'application/json',
  },
});

api.interceptors.request.use(
  config => {
    const token = store.getters['auth/accessToken'];
    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
  },
  error => {
    return Promise.reject(error);
  }
);

api.interceptors.response.use(
  response => {
    return response;
  },
  async error => {
    const originalRequest = error.config;
    if (error.response.status === 401 && !originalRequest._retry) {
      originalRequest._retry = true;
      try {
        const refreshToken = store.getters['auth/refreshToken'];
        const response = await api.post('/refresh-token', { refresh_token: refreshToken });
        const newAccessToken = response.data.access_token;
        store.commit('auth/setAccessToken', newAccessToken);
        api.defaults.headers.common['Authorization'] = `Bearer ${newAccessToken}`;
        return api(originalRequest);
      } catch (err) {
        store.commit('auth/logout');
        return Promise.reject(err);
      }
    }
    return Promise.reject(error);
  }
);

export default api;
