<template>
    <header class="header-area bg-white shadow-sm">
        <div class="header-top">
            <div class="header-top-nav text-center">
                <div class="row">
                    <div class="col-md-6  col-lg-6 offset-md-3 offset-lg-3">
                        <ul class="top-heading">
                            <li><a href="#"><i class="fas fa-eye"></i> <span>Certiceret</span></a></li>
                            <li><a href="#"><i class="fas fa-check"></i> <span>Contrary to popula</span></a></li>
                            <li><a href="#"><i class="fas fa-check"></i> <span>Contrary popula</span></a></li>
                            <li><a href="#"><i class="fas fa-check"></i> <span>Contrary popula</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-searcha-area shadow-sm bg-light">
            <div class="header_top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-md-6 col-lg-4 d-flex justify-content-between">
                                    <a href="#" class="hide-desktop"><i class="far fa-heart"></i> </a>
                                    <div class="header-logo" style="margin-top:0px ">
                                        <h4>
                                            <router-link to="/">
                                                <img src="/frontend/assets/img/site.png"
                                                     id="logo" alt="">
                                            </router-link>
                                        </h4>
                                    </div>
                                    <a href="#" class="hide-desktop"><i class="fas fa-sign-out-alt" id="login"></i></a>
                                </div>
                                <div class="col-md-6 col-lg-8 mt-4">
                                    <div class="main_search mt-0 mb-2"
                                         style="border: 1px solid #ced4da;border-radius: 5px;">
                                        <form @submit.prevent="searchFrom">
                                            <div class="input-group">
                                                <button type="button" class="btn btn-light rounded-0 pl-3 pr-3"><i
                                                    class="fas fa-search"></i></button>
                                                <input type="text" v-model="search" class="form-control rounded-0"
                                                       name="query"
                                                       style="border: 1px solid transparent; !important"
                                                       placeholder="Busca algo..." value="">
                                                <span class="input-group-btn">
                                            <button type="submit" class="btn btn-success rounded-0"
                                                    style="background-color: #078223;border-color:#078223">Go !</button>
                                            </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 mt-3">
                            <div class="header_top_button d-flex justify-content-center">
                                <router-link tag="div" to="/favourites" class="wishlist text-center">
                                    <a href="#">
                                        <i class="far fa-heart"></i>
                                        <br>
                                        <label>Favourite</label>
                                    </a>
                                </router-link>
                                <div class="login ml-4 text-center">
                                    <div v-if="userLoggedIn">
                                        <div class="user-login" v-on-clickaway="close"
                                             @click="showUserMenu = !showUserMenu">
                                            <i class="fas fa-user"></i>
                                            <br>
                                            Profile
                                        </div>
                                        <div class="dropdown-menu wow bounceIn" v-if="showUserMenu">
                                            <a class="dropdown-item" href="#">Favourites</a>
                                            <a class="dropdown-item" href="#">Dashboard</a>
                                            <a class="dropdown-item" href="#">Orders</a>
                                            <div class="dropdown-divider"></div>
                                            <router-link class="dropdown-item" to="/logout">
                                                Logout
                                            </router-link>

                                        </div>
                                    </div>
                                    <div class="user-login" v-if="!userLoggedIn">
                                        <router-link to="/login">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <br>
                                            Login
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- navbar area  -->
        <!--end of navbar area  -->
    </header>
</template>

<script>
    import {mixin as clickaway} from 'vue-clickaway';

    export default {
        name: "SiteTopHeader",
        mixins: [clickaway],
        data() {
            return {
                showUserMenu: false,
                search: null,
                tempSearch: null,
                userLoggedIn: User.loggedIn(),
                userName: User.name()
            }
        },
        methods: {
            searchFrom() {
                this.tempSearch = this.search.toLowerCase().trim();
                this.tempSearch = this.search.toLowerCase().trim().replace(' ', '-');
                this.search = null;
                if (this.tempSearch != null) {
                    this.$router.push({name: 'search-products', params: {search: this.tempSearch}})
                }
            },
            close() {
                this.showUserMenu = false;
            }
        }
    }
</script>

<style scoped>
    .top-heading {
        display: flex;
        justify-content: center;
        margin: 0px;
    }

    img#logo {
        width: 100px;
    }

    .user-profile a:hover {
        text-decoration: none;
    }

    .user-profile, .user-login {
        cursor: pointer !important;
        color: #ff7c3b !important;
    }

    .dropdown-menu {
        display: block !important;
        left: 50px;
        min-width: 180px;
    }
</style>
