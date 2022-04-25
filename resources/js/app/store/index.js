import { createStore } from "vuex";
import { auth } from "./modules/auth";
import { users } from "./modules/users";
import { states } from "./modules/states";
import { brands } from "./modules/brands";
import { categories } from "./modules/categories";
import { types } from "./modules/types";

const store = createStore({
    modules: {
        auth,
        users,
        states,
        brands,
        categories,
        types
    },
});

export default store;
