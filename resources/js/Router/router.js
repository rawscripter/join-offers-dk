import Vue from 'vue';
import VueRouter from 'vue-router';
import AppHome from "../components/Admin/AppHome";
import AppLogin from "../components/Admin/Auth/AppLogin";
import AppBody from "../components/Admin/BodyComponents/AppBody";
import AppLogOut from "../components/Admin/Auth/AppLogOut";
import UserIndex from "../components/Admin/BodyComponents/BodyParts/User/UserIndex";
import UserCreate from "../components/Admin/BodyComponents/BodyParts/User/UserCreate";
import CategoryIndex from "../components/Admin/BodyComponents/BodyParts/Category/CategoryIndex";
import SubCategoryIndex from "../components/Admin/BodyComponents/BodyParts/SubCategory/SubCategoryIndex";
import ProductsIndex from "../components/Admin/BodyComponents/BodyParts/Product/ProductsIndex";
import ProductCreate from "../components/Admin/BodyComponents/BodyParts/Product/ProductCreate";
import SiteIndex from "../components/Site/Pages/SiteIndex";
import ProductDetailsPage from "../components/Site/Pages/ProductDetailsPage";
import CategoryProducts from "../components/Site/Pages/CategoryProducts";

//importing components

Vue.use(VueRouter);


const routes = [
    // routes for admin dashboard
    {path: '/admin', component: AppBody},
    {path: '/admin/login', component: AppLogin},
    {path: '/logout', component: AppLogOut},
    {path: '/admin/users', component: UserIndex},
    {path: '/admin/user/create', component: UserCreate},
    {path: '/admin/category', component: CategoryIndex},
    {path: '/admin/sub-category', component: SubCategoryIndex},
    {path: '/admin/products', name: 'products', component: ProductsIndex},
    {path: '/admin/product/create', name: 'product.create', component: ProductCreate},

    // routes for site
    {path: '/', component: SiteIndex},
    {path: '/product/:slug', name: 'product-details', component: ProductDetailsPage},
    {path: '/category/:category', name: 'category-product', component: CategoryProducts},
    {path: '/products/:category/:subCategory', name: 'sub-category-product', component: CategoryProducts},
];


const router = new VueRouter({
    routes,
    mode: 'hash',
    hashbang: false
});

export default router;
