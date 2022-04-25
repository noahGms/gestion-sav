import { createStore } from "vuex";
import { auth } from "./modules/auth";
import { users } from "./modules/users";
import { states } from "./modules/states";
import { brands } from "./modules/brands";

const store = createStore({
    modules: {
        auth,
        users,
        states,
        brands
    },
});

export default store;
