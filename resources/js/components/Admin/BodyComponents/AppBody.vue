<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    import Index from "./BodyParts/Index";

    export default {
        name: "AppBody",
        components: {
            'body-index': Index
        }
    }
</script>

<style scoped>

</style>
