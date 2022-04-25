import { createRouter, createWebHashHistory, createWebHistory } from "vue-router";
const store = require("../store");

const router = createRouter({
    history: createWebHistory(),
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
        {
            path: "/parametres/utilisateurs",
            name: "usersSettings",
            component: () => import("../pages/settings/Users"),
            meta: { requiresAuth: true },
        },
        {
            path: "/parametres/etats",
            name: "statesSettings",
            component: () => import("../pages/settings/States"),
            meta: { requiresAuth: true },
        },
        {
            path: "/parametres/marques",
            name: "brandsSettings",
            component: () => import("../pages/settings/Brands"),
            meta: { requiresAuth: true },
        },
        {
            path: "/parametres/categories",
            name: "categoriesSettings",
            component: () => import("../pages/settings/Categories"),
            meta: { requiresAuth: true },
        },
        {
            path: "/parametres/types",
            name: "typesSettings",
            component: () => import("../pages/settings/Types"),
            meta: { requiresAuth: true },
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
