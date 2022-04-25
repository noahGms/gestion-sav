import { createStore } from "vuex";
import { auth } from "./modules/auth";
import { users } from "./modules/users";
import { states } from "./modules/states";
import { brands } from "./modules/brands";
import { categories } from "./modules/categories";
import { types } from "./modules/types";
import { returns } from "./modules/returns";

const store = createStore({
    modules: {
        auth,
        users,
        states,
        brands,
        categories,
        types,
        returns
    },
});

export default store;
