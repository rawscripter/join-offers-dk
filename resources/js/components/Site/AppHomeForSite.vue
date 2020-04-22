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
        },
        watch: {
            '$route':{
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
