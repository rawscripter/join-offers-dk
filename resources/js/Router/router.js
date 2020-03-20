import Vue from 'vue';
import VueRouter from 'vue-router';
import AppHome from "../components/Admin/AppHome";

//importing components

Vue.use(VueRouter);


const routes = [
    {path: '/', component: AppHome},
];


const router = new VueRouter({
    routes,
    mode: 'history',
    hashbang: false
});

export default router;
