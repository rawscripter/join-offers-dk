<template>
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">

                <h3 class="kt-subheader__title">{{this.header}}</h3>

                <span class="kt-subheader__separator kt-subheader__separator--v"></span>


                <div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
                    <input type="text" class="form-control" placeholder="Search order..."
                           id="generalSearch">
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                        <span><i class="flaticon2-search-1"></i></span>
                                    </span>
                </div>
            </div>
            <!--            <div class="kt-subheader__toolbar">-->
            <!--                <div class="kt-subheader__wrapper">-->
            <!--                    <a href="#" class="btn kt-subheader__btn-secondary">Today</a>-->

            <!--                    <a href="#" class="btn kt-subheader__btn-secondary">Month</a>-->

            <!--                    <a href="#" class="btn kt-subheader__btn-secondary">Year</a>-->

            <!--                    <a href="#" class="btn kt-subheader__btn-daterange"-->
            <!--                       id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip"-->
            <!--                       title="Select dashboard daterange" data-placement="left">-->
            <!--                                        <span class="kt-subheader__btn-daterange-title"-->
            <!--                                              id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;-->
            <!--                        <span class="kt-subheader__btn-daterange-date"-->
            <!--                              id="kt_dashboard_daterangepicker_date">Aug 16</span>-->
            <!--                        <i class="flaticon2-calendar-1"></i>-->
            <!--                    </a>-->


            <!--                </div>-->
            <!--            </div>-->

            <div id="kt_header_menu"
                 class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here kt-menu__item--active"
                        data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;"
                                                                                   class="kt-menu__link kt-menu__toggle"><span
                        class="kt-menu__link-text btn btn text-white p-2 btn-custom btn-bold btn-upper btn-font-sm  btn-success">
                        <i class="fa fa-user-alt"></i> Shuvo Goswami
                        </span></a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item " aria-haspopup="true">
                                    <a href="javascript:;" class="kt-menu__link ">
                                        <span class="kt-menu__link-icon">
                                    <i class="fa fa-user-alt"></i>
                                    </span>
                                        <span class="kt-menu__link-text">Profile</span></a>
                                </li>

                                <li class="kt-menu__item " aria-haspopup="true">
                                    <a href="javascript:;" class="kt-menu__link ">
                                        <span class="kt-menu__link-icon">
                                        <i class="fas fa-sliders-h"></i>
                                    </span><span class="kt-menu__link-text">Settings</span></a>
                                </li>


                                <li class="kt-menu__item " aria-haspopup="true">
                                    <a href="javascript:;" class="kt-menu__link ">
                                        <span class="kt-menu__link-icon">
                                  <i class="fas fa-sign-out-alt"></i>
                                    </span><span class="kt-menu__link-text">Logout</span></a>
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
        name: "AppTopSubHeader",
        props: ['header']
    }
</script>

<style scoped>
    .kt-header-menu {
        position: absolute;
        right: 30px;
    }

    .kt-header-menu .kt-menu__nav .kt-menu__item.kt-menu__item--hover .kt-menu__submenu {
        left: -40px;
        width: 200px;
    }

    .kt-menu__ver-arrow {
        display: block !important;
    }

    #kt_subheader {
        top: 0px;
    }
</style>
