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
import FavouriteProudctsPage from "../components/Site/Pages/FavouriteProudctsPage";
import CheckoutPage from "../components/Site/Pages/CheckoutPage";
import CheckoutStatusPage from "../components/Site/Pages/CheckoutStatusPage";
import CustomerProfile from "../components/Site/Pages/Customer/CustomerProfile";
import CustomerOrders from "../components/Site/Pages/Customer/CustomerOrders";
import OrdersIndex from "../components/Admin/BodyComponents/BodyParts/Order/OrdersIndex";
import ArchiveProductsIndex from "../components/Admin/BodyComponents/BodyParts/Product/ArchiveProductsIndex";
import CustomerIndex from "../components/Admin/BodyComponents/BodyParts/Customer/CustomerIndex";
import OrderDetails from "../components/Admin/BodyComponents/BodyParts/Order/OrderDetails";
import CustomerDashboard from "../components/Site/Pages/Customer/CustomerDashboard";
import UserLogin from "../components/Site/Pages/Auth/UserLogin";
import UserRegister from "../components/Site/Pages/Auth/UserRegister";
import UserResetPassword from "../components/Site/Pages/Auth/UserResetPassword";
import UserChangePassword from "../components/Site/Pages/Auth/UserChangePassword";
import FilterPage from "../components/Site/Pages/FilterPage";
import RequestsIndex from "../components/Admin/BodyComponents/BodyParts/Request/RequestsIndex";
import PrroductGraph from "../components/Site/Pages/Customer/PrroductGraph";
import FinalCheckoutPage from "../components/Site/Pages/FinalCheckoutPage";
import CustomerReminderProductPage from "../components/Site/Pages/CustomerReminderProductPage";
//importing components
Vue.use(VueRouter);


const routes = [
    // routes for admin dashboard
    {
        path: '/admin/login',
        component: AppLogin
    },
    {
        path: '/logout',
        component: AppLogOut
    },
    {
        path: '/admin',
        meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        component: AppBody
    },
    {
        path: '/admin/category', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },

        component: CategoryIndex
    },
    {
        path: '/admin/customers', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        component: CustomerIndex
    },
    {
        path: '/admin/sub-category', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        component: SubCategoryIndex
    },
    {
        path: '/admin/products', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'products',
        component: ProductsIndex
    },
    {
        path: '/admin/products/archive', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'admin.products',
        component: ArchiveProductsIndex
    },
    {
        path: '/admin/orders', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'orders',
        component: OrdersIndex
    }, {
        path: '/admin/requests', meta: {
            title: 'Offer Requests!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'requests',
        component: RequestsIndex
    },
    {
        path: '/admin/order/:order/details', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'admin-order-details',
        component: OrderDetails
    },
    {
        path: '/admin/product/create', meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'product.create',
        component: ProductCreate
    },
    {
        path: '/admin/product/:product/edit',
        meta: {
            title: 'Order Details!',
            requireAuth: true,
            requireAdmin: true,
        },
        name: 'product.edit',
        component: ProductEdit
    },

    {
        path: '/auth/:provider/callback',
        component: {
            template: '<div class="auth-component"></div>'
        }
    },


    // routes for site
    {
        path: '/',
        component: SiteIndex,
        meta: {
            title: 'Welcome to Join Offer!'
        }
    },  // routes for site
    {
        path: '/filter',
        component: FilterPage,
        name: 'filter',
        meta: {
            title: 'Filter Products.'
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
        path: '/reset/password',
        component: UserResetPassword,
        name: 'reset-password',
        meta: {
            title: 'Reset Password!'
        }
    },

    {
        path: '/password/reset/:token',
        component: UserChangePassword,
        name: 'reset-password-token',
        meta: {
            title: 'Change Password!'
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
    }, {
        path: '/final/checkout/:order',
        name: 'final-checkout',
        component: FinalCheckoutPage,
        meta: {
            title: 'Final Checkout Now!'
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
    }, {
        path: '/reminder-events',
        name: 'reminder-events',
        component: CustomerReminderProductPage,
        meta: {
            title: 'Reminder Products'
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
        path: '/customer/dashboard',
        name: 'customer-dashboard',
        component: CustomerDashboard,
        meta: {
            title: 'Dashboard! ',
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
    }, {
        path: '/product/:product/graph',
        name: 'product.graph',
        component: PrroductGraph,
        meta: {
            title: 'Price fall graph.',
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
    scrollBehavior(to, from, savedPosition) {
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        return {x: 0, y: 0};
    },
    mode: 'history',
    hashbang: true,
    routes,
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

            if (to.matched.some(record => record.meta.requireAdmin)) {
                if (!User.isAdmin()) {
                    next({
                        path: '/admin/login',
                        query: {redirect: to.fullPath}
                    })
                } else {
                    next();
                }

            } else {
                next();
            }

        }
    } else {
        next(); // make sure to always call next()!
    }
})


export default router;
