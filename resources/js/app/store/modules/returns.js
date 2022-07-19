import axios from "axios";

export const returns = {
    namespaced: true,
    state: () => ({
        returns: [],
        returnCreated: null
    }),
    mutations: {
        setReturns(state, returns) {
            state.returns = returns;
        },
        setReturnCreated(state, returnCreated) {
            state.returnCreated = returnCreated;
        }
    },
    actions: {
        getAllReturns({commit}) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/returns")
                    .then((response) => {
                        commit("setReturns", response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        newReturn({commit}, returnData) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/returns", returnData)
                    .then((response) => {
                        commit("setReturnCreated", response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        updateReturn(_, returnData) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/returns/${returnData.id}`, returnData)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        deleteReturn(_, returnData) {
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/returns/${returnData.id}`)
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
        getAllReturns: (state) => state.returns,
        getReturnCreated: (state) => state.returnCreated,
    },
};
