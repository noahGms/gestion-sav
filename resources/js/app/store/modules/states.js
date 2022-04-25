import axios from "axios";

export const states = {
    namespaced: true,
    state: () => ({
        states: [],
    }),
    mutations: {
        setStates(state, states) {
            state.states = states;
        },
    },
    actions: {
        getAllStates({commit}) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/states")
                    .then((response) => {
                        commit("setStates", response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        newState(_, state) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/states", state)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        updateState(_, state) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/states/${state.id}`, state)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        deleteState(_, state) {
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/states/${state.id}`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
    },
    getters: {
        getAllStates: (state) => state.states,
    },
};
