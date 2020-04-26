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
import ProductEdit from "../components/Admin/BodyComponents/BodyParts/Product/ProductEdit";
import SearchPage from "../components/Site/Pages/SearchPage";
import UserLogin from "../components/Site/Pages/UserLogin";
import UserRegister from "../components/Site/Pages/UserRegister";
import FavouriteProudctsPage from "../components/Site/Pages/FavouriteProudctsPage";

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
    {path: '/admin/product/:product/edit', name: 'product.edit', component: ProductEdit},

    // routes for site
    {
        path: '/',
        component: SiteIndex,
        meta: {
            title: 'Welcome to Join Offer!'
        }
    },
    {
        path: '/login',
        component: UserLogin,
        meta: {
            title: 'Login!'
        }
    },
    {
        path: '/register',
        component: UserRegister,
        meta: {
            title: 'Register Now!'
        }
    },
    {
        path: '/product/:slug',
        name: 'product-details',
        component: ProductDetailsPage,
        meta: {
            title: 'Welcome to Join Offer!'
        }
    }, {
        path: '/favourites',
        name: 'favourites',
        component: FavouriteProudctsPage,
        meta: {
            title: 'Favourite Products'
        }
    },
    {
        path: '/category/:category', name: 'category-product', component: CategoryProducts,
        meta: {
            title: 'Check Category Products!'
        }
    },
    {
        path: '/products/:category/:subCategory',
        name: 'sub-category-product',
        component: CategoryProducts,
        meta: {
            title: 'Check Sub Category Products!'
        }
    },
    {
        path: '/search/query/:search',
        name: 'search-products',
        component: SearchPage,
        meta: {
            title: 'Search Products!'
        }
    },
];


const router = new VueRouter({
    routes,
    mode: 'history',
    hashbang: true
});

export default router;
