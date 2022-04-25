import axios from "axios";

export const brands = {
    namespaced: true,
    state: () => ({
        brands: [],
    }),
    mutations: {
        setBrands(state, brands) {
            state.brands = brands;
        },
    },
    actions: {
        getAllBrands({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/brands")
                    .then((response) => {
                        commit("setBrands", response.data.data);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        newBrand(_, brand) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/brands", brand)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        updateBrand(_, brand) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/brands/${brand.id}`, brand)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        deleteBrand(_, brand) {
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/brands/${brand.id}`)
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
        getAllBrands: (state) => state.brands,
    },
};