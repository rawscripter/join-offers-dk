<template>
    <div>
        <SiteLayout>
            <router-view :key="this.$route.path"></router-view>
        </SiteLayout>
        <SiteModals></SiteModals>
    </div>
</template>

<script>
    import SiteLayout from "./Layout/SiteLayout";
    import SiteModals from "./Modals/SiteModals";

    export default {
        name: "AppHomeForSite",
        data() {
            return {}
        },
        components: {
            SiteLayout,
            SiteModals,
        },
        watch: {
            '$route': {
                handler: (to, from) => {
                    document.title = to.meta.title || 'Your Website'
                },
                immediate: true
            }
        },
    }
</script>

<style scoped>

</style>
