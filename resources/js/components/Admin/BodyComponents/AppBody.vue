<template>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <AppTopSubHeader :header="headerTitle"></AppTopSubHeader>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <!-- body contents goes here -->
            <h1>Hello world</h1>
            <!-- body contents ends here -->
        </div>
    </div>
</template>

<script>

    import AppTopSubHeader from "../Header/AppTopSubHeader";

    export default {
        name: "AppBody",
        components: {
            AppTopSubHeader
        },
        data() {
            return {
                headerTitle: 'Dashboard'
            }
        },


    }
</script>

<style>
    .kt-header--fixed.kt-subheader--fixed.kt-subheader--enabled .kt-wrapper {
        padding-top: 60px;
    }
</style>
