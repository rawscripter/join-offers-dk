<template>
    <div>
        <SiteTopHeader></SiteTopHeader>
        <hr class="m-0 p-0">
        <HeaderVideoSection></HeaderVideoSection>
        <SiteNavBar></SiteNavBar>
        <!--to load body-->
        <slot></slot>
    </div>
</template>

<script>
    import HeaderVideoSection from "./HeaderVideoSection";
    import SiteNavBar from "./SiteNavBar";
    import SiteTopHeader from "./SiteTopHeader";

    export default {
        name: "SiteLayout",
        components: {
            SiteNavBar,
            SiteTopHeader,
            HeaderVideoSection
        }
    }
</script>

<style scoped>

</style>
