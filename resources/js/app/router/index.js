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
            path: "/clients",
            name: "customers",
            component: () => import("../pages/customers/Customers"),
            meta: { requiresAuth: true },
        },
        {
            path: "/clients/:id",
            name: "customer",
            component: () => import("../pages/customers/Customer"),
            meta: { requiresAuth: true },
        },
        {
            path: "/parametres/utilisateurs",
            name: "usersSettings",
            component: () => import("../pages/settings/Users"),
            meta: { requiresAuth: true, requiresAdmin: true },
        },
        {
            path: "/parametres/etats",
            name: "statesSettings",
            component: () => import("../pages/settings/States"),
            meta: { requiresAuth: true, requiresAdmin: true },
        },
        {
            path: "/parametres/marques",
            name: "brandsSettings",
            component: () => import("../pages/settings/Brands"),
            meta: { requiresAuth: true, requiresAdmin: true },
        },
        {
            path: "/parametres/categories",
            name: "categoriesSettings",
            component: () => import("../pages/settings/Categories"),
            meta: { requiresAuth: true, requiresAdmin: true },
        },
        {
            path: "/parametres/types",
            name: "typesSettings",
            component: () => import("../pages/settings/Types"),
            meta: { requiresAuth: true, requiresAdmin: true },
        },
        {
            path: "/parametres/retours",
            name: "returnsSettings",
            component: () => import("../pages/settings/Returns"),
            meta: { requiresAuth: true, requiresAdmin: true },
        },
        {
            path: "/parametres/interventions",
            name: "interventionsSettings",
            component: () => import("../pages/settings/Interventions"),
            meta: { requiresAuth: true, requiresAdmin: true },
        },
        {
            path: "/parametres/depots",
            name: "depotsSettings",
            component: () => import("../pages/settings/Depots"),
            meta: { requiresAuth: true, requiresAdmin: true },
        },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        store.default.dispatch("auth/whoami").finally(() => {
            if (store.default.getters["auth/isLoggedIn"]) {
                if (to.meta.requiresAdmin) {
                    if (store.default.getters["auth/isAdmin"]) {
                        next();
                    } else {
                        next({ name: "home" });
                    }
                } else {
                    next();
                }
            } else {
                next({ name: "login" });
            }
        });
    } else {
        next();
    }
});

export default router;
