const login = [
   
    {
        path: "/login",
        component: () => import("../layouts/login.vue"),
        children: [

           
        ]

    },
    {
        path: "/forgot-password",
        name: "forgot-password",
        component: () => import("../pages/login/forgot-password.vue"),
        
    },
    {
        path: "/reset-password",
        name: "reset-password",
        component: () => import("../pages/login/reset-password.vue"),
        
    },
    {
        path: "/password-new",
        name: "password-new",
        component: () => import("../pages/login/password-new.vue"),
        
    },
    
];


export default login
