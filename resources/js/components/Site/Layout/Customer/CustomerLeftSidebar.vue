<template>
    <div class="main-sidebar shadow p-2 position-fixed1 " id="main_sidebar">
        <div class="profile-meu">
            <ul>

                <router-link tag="a" class="dropdown-item" :to="{name:'customer-dashboard'}">
                    Oversigt
                </router-link>
                <router-link tag="a" class="dropdown-item" :to="{name:'customer-profile'}">
                    Profil
                </router-link>
                <router-link tag="a" class="dropdown-item" exact :to="{name:'customer-orders',query:{type:'running'}}">
                    Aktive begivenheder
                </router-link>
                <router-link tag="a" class="dropdown-item" exact
                             :to="{name:'customer-completed-orders',query:{type:'completed'}}">
                    Fuldførte begivenheder
                </router-link>

                <router-link tag="a" class="dropdown-item" exact
                             :to="{name:'customer-canceled-orders',query:{type:'canceled'}}">
                    Annullerede begivenheder
                </router-link>

                <div class="dropdown-divider"></div>
                <router-link class="dropdown-item" to="/logout">
                    Log ud
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

    a.dropdown-item {
        font-weight: bold;
        color: #6c757d !important;
    }
    a.dropdown-item.router-link-exact-active.router-link-active:visited {
        background: #efefef;
    }
    a.dropdown-item.router-link-exact-active.router-link-active,
    a.dropdown-item.router-link-exact-active.router-link-active:visited,
    a.dropdown-item.router-link-exact-active.router-link-active:focus,
    a.dropdown-item.router-link-exact-active.router-link-active:checked {
        background: #efefef;
    }

    .dropdown-item {
        padding: 16px 20px;
    }

    div#main_sidebar {
        min-height: 45vh;
    }

</style>
