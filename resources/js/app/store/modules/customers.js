import axios from "axios";

export const customers = {
    namespaced: true,
    state: () => ({
        customers: [],
    }),
    mutations: {
        setCustomers(state, customers) {
            state.customers = customers;
        },
    },
    actions: {
        getAllCustomers({commit}, {page, pageSize, search}) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`/api/customers?page=${page}&pageSize=${pageSize}&search=${search}`)
                    .then((response) => {
                        commit("setCustomers", response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        getOneCustomer(_, customer) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`/api/customers/${customer.id}`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        newCustomer(_, customer) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/customers", customer)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        updateCustomer(_, customer) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/customers/${customer.id}`, customer)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        deleteCustomer(_, customer) {
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/customers/${customer.id}`)
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
        getAllCustomers: (state) => state.customers,
    },
};
