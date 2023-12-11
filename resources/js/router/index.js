import {createRouter, createWebHistory} from "vue-router";
import Main from "@/Pages/Main.vue";
import ProductTemplate from "@/Pages/ProductTemplate.vue";

const routes = [
    {
        path: '/',
        component: Main
    },
    {
        path: '/product/:id',
        component: ProductTemplate
    },
]

const router = createRouter({
    routes,
    history: createWebHistory()
})

export default router;
