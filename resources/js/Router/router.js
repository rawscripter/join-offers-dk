import Vue from 'vue';
import VueRouter from 'vue-router';

//importing components
import Index from "../components/Admin/BodyComponents/BodyParts/Index";
import UserIndex from "../components/Admin/BodyComponents/BodyParts/User/UserIndex";

Vue.use(VueRouter);


const routes = [
    {path: '/', component: Index},
    {path: '/users', component: UserIndex},
];


const router = new VueRouter({
    routes,
    mode: 'history',
    hashbang: false
});

export default router;
