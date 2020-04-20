<template>
    <div>
        <SiteTopHeader></SiteTopHeader>
        <hr class="m-0 p-0">
        <SiteNavBar></SiteNavBar>
        <!--to load body-->
        <slot></slot>
    </div>
</template>

<script>
    import SiteNavBar from "./SiteNavBar";
    import SiteTopHeader from "./SiteTopHeader";

    export default {
        name: "SiteLayout",
        components: {
            SiteNavBar,
            SiteTopHeader
        }
    }
</script>

<style scoped>

</style>
