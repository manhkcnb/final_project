import store from '../store';
import router from './index';
const AuthMiddleware = (to, from, next) => {
    if (store.getters.getEmail=='') {
        router.push({ path: '/login' });
    } else {
        next();
    }
};
const admin = [
    {
        path: "/admin",
        component: () => import("../layouts/admin.vue"),
        beforeEnter: AuthMiddleware,
        children: [
            {
                path: "users",
                name: "admin-users",
                component: () => import("../pages/admin/users/index.vue")
            },
            {
                path: "test",
                name: "admin-test",
                component: () => import("../pages/admin/users/test.vue")
            },
            {
                path: "users-create",
                name: "admin-users-create",
                component: () => import("../pages/admin/users/create.vue")
            },
            {
                path: "users/update/:id",
                name: "admin-users-update",
                component: () => import("../pages/admin/users/update.vue")
            },
            {
                path: "category",
                name: "admin-category",
                component: () => import("../pages/admin/category/index.vue")
            },
            {
                path: "category-create",
                name: "admin-category-create",
                component: () => import("../pages/admin/category/create.vue")
            },
            {
                path: "category/update/:id",
                name: "admin-category-update",
                component: () => import("../pages/admin/category/update.vue")
            },
            {
                path: "products",
                name: "admin-products",
                component: () => import("../pages/admin/products/index.vue")
            },
            {
                path: "products-allsoftdeleted",
                name: "admin-products-allsoftdeleted",
                component: () => import("../pages/admin/products/allsoftdeleted.vue")
            },

            {
                path: "products-create",
                name: "admin-products-create",
                component: () => import("../pages/admin/products/create.vue")
            },
            {
                path: "products/update/:id",
                name: "admin-products-update",
                component: () => import("../pages/admin/products/update.vue")
            },
            {
                path: "products/detai/:id",
                name: "admin-products-detail",
                component: () => import("../pages/admin/products/detail.vue")
            }

            , {
                path: "sizes",
                name: "admin-sizes",
                component: () => import("../pages/admin/sizes/index.vue")
            },
            {
                path: "size-create",
                name: "admin-size-create",
                component: () => import("../pages/admin/sizes/create.vue")
            },
            {
                path: "size/update/:id",
                name: "admin-size-update",
                component: () => import("../pages/admin/sizes/update.vue")
            }
            , {
                path: "colors",
                name: "admin-colors",
                component: () => import("../pages/admin/colors/index.vue")
            },
            {
                path: "color-create",
                name: "admin-color-create",
                component: () => import("../pages/admin/colors/create.vue")
            },
            {
                path: "color/update/:id",
                name: "admin-color-update",
                component: () => import("../pages/admin/colors/update.vue")
            },

        ]
    }
];

export default admin;


