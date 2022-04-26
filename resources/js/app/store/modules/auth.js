import axios from "axios";

export const auth = {
    namespaced: true,
    state: () => ({
        user: null,
        loggedIn: false,
    }),
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setLoggedIn(state, loggedIn) {
            state.loggedIn = loggedIn;
        },
    },
    actions: {
        login({ commit, dispatch }, credentials) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/auth/login", credentials)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        commit("setUser", null);
                        commit("setLoggedIn", false);
                        reject(error);
                    });
            });
        },
        whoami({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/auth/whoami")
                    .then((response) => {
                        commit("setUser", response.data.data);
                        commit("setLoggedIn", true);
                        resolve(response);
                    })
                    .catch((error) => {
                        commit("setUser", null);
                        commit("setLoggedIn", false);
                        reject(error);
                    });
            });
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/auth/logout")
                    .then((response) => {
                        commit("setUser", null);
                        commit("setLoggedIn", false);
                        resolve(response);
                    })
                    .catch((error) => {
                        commit("setUser", null);
                        commit("setLoggedIn", false);
                        reject(error);
                    });
            });
        },
    },
    getters: {
        getAuthenticatedUser: (state) => state.user,
        isLoggedIn: (state) => state.loggedIn,
    },
};
