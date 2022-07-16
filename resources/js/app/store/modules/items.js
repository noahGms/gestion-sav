import axios from "axios";

export const items = {
    namespaced: true,
    state: () => ({
        items: [],
    }),
    mutations: {
        setItems(state, items) {
            state.items = items;
        },
    },
    actions: {
        getAllItems({commit}) {
            return new Promise((resolve, reject) => {
                axios.get('/api/items')
                    .then(response => {
                        commit('setItems', response.data.data);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        getOneItem(_, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/items/${id}`)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        newItem(_, item) {
            return new Promise((resolve, reject) => {
                axios.post('/api/items', item)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        updateItem(_, item) {
            return new Promise((resolve, reject) => {
                axios.put(`/api/items/${item.id}`, item)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        deleteItem(_, id) {
            return new Promise((resolve, reject) => {
                axios.delete(`/api/items/${id}`)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
    },
    getters: {
        getAllItems: (state) => state.items,
    },
};
