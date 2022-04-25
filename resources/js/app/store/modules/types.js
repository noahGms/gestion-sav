import axios from "axios";

export const types = {
    namespaced: true,
    state: () => ({
        types: [],
    }),
    mutations: {
        setTypes(state, types) {
            state.types = types;
        },
    },
    actions: {
        getAllTypes({commit}) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/types")
                    .then((response) => {
                        commit("setTypes", response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        newType(_, type) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/types", type)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        updateType(_, type) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/types/${type.id}`, type)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        deleteType(_, type) {
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/types/${type.id}`)
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
        getAllTypes: (state) => state.types,
    },
};
