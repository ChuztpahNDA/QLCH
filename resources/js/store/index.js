import { createStore } from 'vuex';
import api from '../plugins/axios';

export default createStore({
    state: {
        access_token: localStorage.getItem('access_token') || null,
        isAuthenticated: false,
    },
    mutations: {
        setAccessToken(state, access_token) {
            console.log('setAccessToken', access_token);
            state.access_token = access_token;
            localStorage.setItem('access_token', access_token);
        },
        setAuth(state, access_token) {
            console.log('setAuth', access_token);
            state.isAuthenticated = true;
            state.access_token = access_token;
            localStorage.setItem('access_token', access_token);

        },
        logout(state) {
            state.isAuthenticated = false;
            state.access_token = null;
            localStorage.removeItem('access_token');

        },
        updateToken(state, access_token) {
            console.log('updateToken', access_token);
            state.isAuthenticated = true;
            state.access_token = access_token;
            localStorage.setItem('access_token', access_token);
        }
    },
    actions: {
        login({ commit }, token) {
            commit('setAuth', token);
        },
        logout({ commit }) {
            commit('logout');
        },
        async refreshToken({commit}) {
            if (this.state.access_token) {
                await api.post('refresh-token').then((res) => {
                    console.log('refreshToken', res);
                    commit('updateToken', res.data.access_token);
                });
            }
        },
    },
    getters: {
        isAuthenticated: state => state.isAuthenticated,
        access_token: state => state.access_token,
    }
});
