<template>

</template>

<script>
    export default {
        name: "AppLogOut",
        created() {
            User.logOut();
            window.location.reload();
        }
    }
</script>

<style scoped>

</style>
