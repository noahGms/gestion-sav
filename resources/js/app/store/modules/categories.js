import axios from "axios";

export const categories = {
    namespaced: true,
    state: () => ({
        categories: [],
    }),
    mutations: {
        setCategories(state, categories) {
            state.categories = categories;
        },
    },
    actions: {
        getAllCategories({commit}) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/categories")
                    .then((response) => {
                        commit("setCategories", response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        newCategory(_, category) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/categories", category)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        updateCategory(_, category) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/categories/${category.id}`, category)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            })
        },
        deleteCategory(_, category) {
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/categories/${category.id}`)
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
        getAllCategories: (state) => state.categories,
    },
};
