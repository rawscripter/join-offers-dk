<template>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <div class="nav-link">
                    <div class="profile-image">
                        <img src="assets/admin/images/faces/face5.jpg" alt="image"/>
                    </div>
                    <div class="profile-name">
                        <p class="name">
                            Shuvo Goswami
                        </p>
                        <p class="designation">
                            shuvogoswamii@gmail.com
                        </p>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <router-link class="nav-link" to="/">
                    <i class="fa fa-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </router-link>
            </li>


            <li class="nav-item">
                <router-link class="nav-link" to="/users">
                    <i class="fa fa-users menu-icon"></i>
                    <span class="menu-title">Users</span>
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "NavSideBar"
    }
</script>

<style scoped>
    .router-link-active.router-link-exact-active {
        border-left: 3px solid #27367f;
    }

    .router-link-active.router-link-exact-active .fa {
        color: #27367f !important;
    }
</style>
