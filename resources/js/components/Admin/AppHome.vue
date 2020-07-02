<template>
    <div>
        <Layout v-if="userLoggedIn"></Layout>
        <AppLogin v-if="!userLoggedIn"></AppLogin>
    </div>
</template>

<script>
    import Layout from "./layout/Layout";
    import AppLogin from "./Auth/AppLogin";

    export default {
        name: "AppHome",
        data() {
            return {
                userLoggedIn: User.isAdmin()
            }
        },
        components: {
            Layout,
            AppLogin
        },
        created() {

        }
    }
</script>

<style scoped>

</style>
