<template>
    <div>
        <SiteLayout>
            <router-view :key="this.$route.path"></router-view>
        </SiteLayout>
    </div>
</template>

<script>
    import SiteLayout from "./Layout/SiteLayout";


    export default {
        name: "AppHomeForSite",
        data() {
            return {}
        },
        components: {
            SiteLayout,
        }

    }
</script>

<style scoped>

</style>
