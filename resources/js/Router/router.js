import Vue from 'vue';
import VueRouter from 'vue-router';
import AppLogin from "../components/Admin/Auth/AppLogin";
import AppBody from "../components/Admin/BodyComponents/AppBody";
import AppLogOut from "../components/Admin/Auth/AppLogOut";
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
import CheckoutPage from "../components/Site/Pages/CheckoutPage";
import CheckoutStatusPage from "../components/Site/Pages/CheckoutStatusPage";
import CustomerProfile from "../components/Site/Pages/Customer/CustomerProfile";
import CustomerOrders from "../components/Site/Pages/Customer/CustomerOrders";
import OrdersIndex from "../components/Admin/BodyComponents/BodyParts/Order/OrdersIndex";
import ArchiveProductsIndex from "../components/Admin/BodyComponents/BodyParts/Product/ArchiveProductsIndex";
import CustomerIndex from "../components/Admin/BodyComponents/BodyParts/Customer/CustomerIndex";
import OrderDetails from "../components/Admin/BodyComponents/BodyParts/Order/OrderDetails";
//importing components
Vue.use(VueRouter);
const routes = [
    // routes for admin dashboard
    {path: '/admin', component: AppBody},
    {path: '/admin/login', component: AppLogin},
    {path: '/logout', component: AppLogOut},
    {path: '/admin/category', component: CategoryIndex},
    {path: '/admin/customers', component: CustomerIndex},
    {path: '/admin/sub-category', component: SubCategoryIndex},
    {path: '/admin/products', name: 'products', component: ProductsIndex},
    {path: '/admin/products/archive', name: 'products', component: ArchiveProductsIndex},
    {path: '/admin/orders', name: 'orders', component: OrdersIndex},
    {path: '/admin/order/:order/details', name: 'admin-order-details', component: OrderDetails},
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
        name: 'login',
        meta: {
            title: 'Login!'
        }
    },
    {
        path: '/register',
        component: UserRegister,
        name: 'register',
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
    },
    {
        path: '/checkout/:slug',
        name: 'checkout',
        component: CheckoutPage,
        meta: {
            title: 'Checkout Now!'
        }
    },
    {
        path: '/order/payment',
        name: 'order-payment-status',
        component: CheckoutStatusPage,
        meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: false,
        }
    },
    {
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
            title: 'Search Products!',
        }
    },
    {
        path: '/customer/profile',
        name: 'customer-profile',
        component: CustomerProfile,
        meta: {
            title: 'Update Profile! ',
            requireAuth: true,
            requireAdmin: false,
        }
    },
    {
        path: '/customer/orders',
        name: 'customer-orders',
        component: CustomerOrders,
        meta: {
            title: 'Customer Orders! ',
            requireAuth: true,
            requireAdmin: false,
        }
    },
    {
        path: '/customer/complete/orders',
        name: 'customer-completed-orders',
        component: CustomerOrders,
        meta: {
            title: 'Customer Orders! ',
            requireAuth: true,
            requireAdmin: false,
        }
    },
    {
        path: '/customer/canceled/orders',
        name: 'customer-canceled-orders',
        component: CustomerOrders,
        meta: {
            title: 'Customer Orders! ',
            requireAuth: true,
            requireAdmin: false,
        }
    },

];
const router = new VueRouter({
    routes,
    mode: 'history',
    hashbang: true
});
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requireAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!User.loggedIn()) {
            next({
                path: '/login',
                query: {redirect: to.fullPath}
            })
        } else {
            next();
        }
    } else {
        next(); // make sure to always call next()!
    }
})

export default router;
