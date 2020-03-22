import Vue from 'vue';
import VueRouter from 'vue-router';
import AppHome from "../components/Admin/AppHome";
import AppLogin from "../components/Admin/Auth/AppLogin";
import AppBody from "../components/Admin/BodyComponents/AppBody";
import AppLogOut from "../components/Admin/Auth/AppLogOut";
import UserIndex from "../components/Admin/BodyComponents/BodyParts/User/UserIndex";
import UserCreate from "../components/Admin/BodyComponents/BodyParts/User/UserCreate";

//importing components

Vue.use(VueRouter);


const routes = [
    {path: '/', component: AppBody},
    {path: '/login', component: AppLogin},
    {path: '/logout', component: AppLogOut},
    {path: '/users', component: UserIndex},
    {path: '/user/create', component: UserCreate},
];


const router = new VueRouter({
    routes,
    mode: 'history',
    hashbang: false
});

export default router;
