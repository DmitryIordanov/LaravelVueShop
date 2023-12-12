import {createRouter, createWebHistory} from "vue-router";
import Main from "@/Pages/Main.vue";
import ProductTemplate from "@/Pages/ProductTemplate.vue";
import UpdateProduct from "@/Pages/UpdateProduct.vue";

const routes = [
    {
        path: '/',
        component: Main
    },
    {
        path: '/product/:id',
        component: ProductTemplate
    },
    {
        path: '/update/:id',
        component: UpdateProduct
    },
]

const router = createRouter({
    routes,
    history: createWebHistory()
})

export default router;
