import { createRouter, createWebHashHistory } from "vue-router";
const store = require("../store");

const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: "/",
            name: "home",
            component: () => import("../pages/Home"),
            meta: { requiresAuth: true },
        },
        {
            path: "/se-connecter",
            name: "login",
            component: () => import("../pages/auth/Login"),
            meta: { requiresAuth: false },
        },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        store.default.dispatch("auth/whoami").finally(() => {
            if (store.default.getters["auth/isLoggedIn"]) {
                next();
            } else {
                next({ name: "login" });
            }
        });
    } else {
        next();
    }
});

export default router;