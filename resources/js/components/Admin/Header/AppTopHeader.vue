<template>
    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu"
                 class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here kt-menu__item--active"
                        data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;"
                                                                                   class="kt-menu__link kt-menu__toggle"><span
                        class="kt-menu__link-text">Profile</span></a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item " aria-haspopup="true">
                                    <a href="javascript:;" class="kt-menu__link ">
                                        <span class="kt-menu__link-icon">
                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </span><span class="kt-menu__link-text">Profile</span></a>
                                </li>

                                <li class="kt-menu__item " aria-haspopup="true">
                                    <a href="javascript:;" class="kt-menu__link ">
                                        <span class="kt-menu__link-icon">
                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </span><span class="kt-menu__link-text">Account</span></a>
                                </li>

                                <li class="kt-menu__item " aria-haspopup="true">
                                    <a href="javascript:;" class="kt-menu__link ">
                                        <span class="kt-menu__link-icon">
                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </span><span class="kt-menu__link-text">Settings</span></a>
                                </li>


                                <li class="kt-menu__item " aria-haspopup="true">
                                    <router-link class="kt-menu__link" to="/logout">
                                     <span class="kt-menu__link-icon">
                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </span><span class="kt-menu__link-text">Logout</span>
                                    </router-link>

                                </li>

                            </ul>
                        </div>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppTopHeader"
    }
</script>

<style scoped>
    .kt-header-menu {
        position: absolute;
        right: 30px;
    }

    .kt-header-menu .kt-menu__nav .kt-menu__item.kt-menu__item--hover .kt-menu__submenu {
        left: -205px;
    }

    .kt-menu__ver-arrow {
        display: block !important;
    }
</style>
