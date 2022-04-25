import axios from "axios";

export const interventions = {
    namespaced: true,
    state: () => ({
        interventions: [],
    }),
    mutations: {
        setInterventions(state, interventions) {
            state.interventions = interventions;
        },
    },
    actions: {
        getAllInterventions({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/interventions")
                    .then((response) => {
                        commit("setInterventions", response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        newIntervention(_, intervention) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/interventions", intervention)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        updateIntervention(_, intervention) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/interventions/${intervention.id}`, intervention)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        deleteIntervention(_, intervention) {
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/interventions/${intervention.id}`)
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
        getAllInterventions: (state) => state.interventions,
    },
};
