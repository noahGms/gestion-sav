import axios from "axios";

export const depots = {
    namespaced: true,
    state: () => ({
        depots: [],
    }),
    mutations: {
        setDepots(state, depots) {
            state.depots = depots;
        },
    },
    actions: {
        getAllDepots({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/depots")
                    .then((response) => {
                        commit("setDepots", response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        newDepot(_, depot) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/depots", depot)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        updateDepot(_, depot) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/depots/${depot.id}`, depot)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        deleteDepot(_, depot) {
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/depots/${depot.id}`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    },
    getters: {
        getAllDepots: (state) => state.depots,
    },
};
