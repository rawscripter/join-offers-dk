<template>
    <div>
        <app-header></app-header>
        <div class="container-fluid page-body-wrapper">
            <app-sidebar></app-sidebar>
            <div class="main-panel">
                <app-body></app-body>
                <app-footer></app-footer>
            </div>
        </div>
    </div>
</template>

<script>
    import Header from "../Header/Header";
    import NavSideBar from "../Header/NavSideBar";
    import FooterBar from "../footer/FooterBar";
    import AppBody from "../BodyComponents/AppBody";

    export default {
        name: "Layout",
        components: {
            'app-sidebar': NavSideBar,
            'app-header': Header,
            'app-footer': FooterBar,
            'app-body': AppBody
        }
    }
</script>

<style scoped>

</style>
