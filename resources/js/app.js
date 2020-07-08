/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
window.APP_URL = 'http://joinoffers.dan:8081';
// window.APP_URL = "http://laravu.test";
// window.APP_URL = "https://joinoffers.dk";
window.CURRENCY = "dkk";

import VueCookies from "vue-cookies";

Vue.use(VueCookies);

var SocialSharing = require("vue-social-sharing");

Vue.use(SocialSharing);

import axios from "axios";
import VueSocialauth from "vue-social-auth";

import VueAxios from "vue-axios";

import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

Vue.use(VueAxios, axios);
Vue.use(VueAxios, axios);

window.User = User;
window.Alert = Notification;

Vue.use(VueSocialauth, {
    providers: {
        github: {
            clientId: "5defb7b174f112bb4314",
            redirectUri: `${APP_URL}/auth/github/callback` // Your client app URL
        }
    }
});

//importing classes
import User from "./Helpers/User";
import Notification from "./Helpers/Notification";

import {ServerTable} from "vue-tables-2";
import VueSweetalert2 from "vue-sweetalert2";
import vueAwesomeCountdown from "vue-awesome-countdown";

import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

import CKEditor from "@ckeditor/ckeditor5-vue";
import Vuelidate from "vuelidate";

Vue.use(Vuelidate);
Vue.use(CKEditor);

Vue.use(ServerTable);
Vue.use(VueSweetalert2);
Vue.use(vueAwesomeCountdown, "vac");
Vue.component("Loading", Loading);
import InfiniteLoading from "vue-infinite-loading";
// Vue.component('', require('vue-infinite-loading'));
Vue.use(InfiniteLoading);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "app-admin-home",
    require("./components/Admin/AppHome.vue").default
);
Vue.component(
    "app-site-home",
    require("./components/Site/AppHomeForSite.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import router from "./Router/router";

const app = new Vue({
    el: "#app",
    router
});
