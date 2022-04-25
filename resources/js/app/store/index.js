import { createStore } from "vuex";
import { auth } from "./modules/auth";
import { users } from "./modules/users";
import { states } from "./modules/states";

const store = createStore({
    modules: {
        auth,
        users,
        states
    },
});

export default store;
