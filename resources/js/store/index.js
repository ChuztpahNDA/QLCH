// src/store.js
import { createStore } from 'vuex';

export default createStore({
    state: {
        access_token: null,
        isAuthenticated: false,
        refresh_token: null,
    },
    mutations: {
        setAccessToken(state, token) {
            state.access_token = token;
        },
        setRefreshToken(state, token) {
            state.refresh_token = token;
        },
        setAuth(state, access_token) {
            state.isAuthenticated = true;
            state.access_token = access_token;
        },
        logout(state) {
            state.isAuthenticated = false;
            state.access_token = null;
            state.refresh_token = null;
        }
    },
    actions: {
        login({ commit }, token) {
            commit('setAuth', token);
        },
        logout({ commit }) {
            commit('logout');
        }
    },
    getters: {
        isAuthenticated: state => state.isAuthenticated,
        access_token: state => state.access_token,
        refresh_token: state => state.refresh_token,
    }
});
