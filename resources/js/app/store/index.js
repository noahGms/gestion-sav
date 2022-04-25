import { createStore } from "vuex";
import { auth } from "./modules/auth";
import { users } from "./modules/users";
import { states } from "./modules/states";
import { brands } from "./modules/brands";
import { categories } from "./modules/categories";

const store = createStore({
    modules: {
        auth,
        users,
        states,
        brands,
        categories
    },
});

export default store;
