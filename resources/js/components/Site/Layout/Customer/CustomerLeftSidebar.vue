<template>
    <div class="main-sidebar shadow p-2" id="main_sidebar">
        <div class="profile-meu">
            <ul>
                <!--                <li><a href="#">Dashboard</a> </li>-->
                <!--                <li><a href="#">Profile</a> </li>-->
                <!--                <li><a href="#">Orders</a> </li>-->
                <!--                <li><a href="#">Favorites</a>  </li>-->

                <!--                <router-link tag="a" class="dropdown-item"  :to="{name:'favourites'}">-->
                <!--                    Favourites-->
                <!--                </router-link>-->

                <a class="dropdown-item" href="#">Dashboard</a>

                <router-link tag="a" class="dropdown-item" :to="{name:'customer-profile'}">
                    Profile
                </router-link>
                <router-link tag="a" class="dropdown-item" exact :to="{name:'customer-orders',query:{type:'running'}}">
                    Running Orders
                </router-link>

                <router-link tag="a" class="dropdown-item" exact
                             :to="{name:'customer-completed-orders',query:{type:'completed'}}">
                    Completed Orders
                </router-link>

                <router-link tag="a" class="dropdown-item" exact
                             :to="{name:'customer-canceled-orders',query:{type:'canceled'}}">
                    Canceled Orders
                </router-link>


                <div class="dropdown-divider"></div>
                <router-link class="dropdown-item" to="/logout">
                    Logout
                </router-link>


            </ul>
        </div>


    </div>
</template>

<script>
    export default {
        name: "CustomerLeftSidebar"
    }
</script>

<style scoped>
    div#main_sidebar {
        padding: 0px !important;
    }

    .profile-meu ul {
        padding: 0px !important;
    }

    a.dropdown-item.router-link-exact-active.router-link-active {
        background: #efefef;
    }

    .dropdown-item {
        padding: 16px 20px;
    }

    div#main_sidebar {
        height: 45vh;
    }
</style>
