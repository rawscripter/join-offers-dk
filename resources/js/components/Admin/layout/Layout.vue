<template>
    <div>
        <AppMobileHeader></AppMobileHeader>
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                <AppNavSideBar></AppNavSideBar>
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                    <AppTopHeader></AppTopHeader>
                    <router-view>

                    </router-view>
                    <!-- begin:: Footer -->
                    <AppFooter></AppFooter>
                    <!-- end:: Footer -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AppTopHeader from "../Header/AppTopHeader";
    import AppBody from "../BodyComponents/AppBody";
    import AppNavSideBar from "../SideBar/AppNavSideBar";
    import AppMobileHeader from "../Header/AppMobileHeader";
    import AppFooter from "../footer/AppFooter";
    import AppLogin from "../Auth/AppLogin";

    export default {
        name: "Layout",
        data() {
            return {}
        },
        components: {
            AppTopHeader,
            AppBody,
            AppNavSideBar,
            AppMobileHeader,
            AppFooter,
            AppLogin
        },
    }
</script>

<style scoped>

</style>
