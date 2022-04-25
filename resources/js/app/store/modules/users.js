import axios from "axios";

export const users = {
    namespaced: true,
    state: () => ({
        users: [],
    }),
    mutations: {
        setUsers(state, users) {
            state.users = users;
        },
    },
    actions: {
        getAllUsers({commit}) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/users")
                    .then((response) => {
                        commit("setUsers", response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        newUser(_, user) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/users", user)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        updateUser(_, user) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/users/${user.id}`, user)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        deleteUser(_, user) {
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/users/${user.id}`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        toggleAdmin(_, user) {
            return new Promise((resolve, reject) => {
                axios
                    .post(`/api/users/${user.id}/toggle-admin`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        }
    },
    getters: {
        getAllUsers: (state) => state.users,
    },
};
