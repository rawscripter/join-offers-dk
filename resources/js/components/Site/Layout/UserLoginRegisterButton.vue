<template>
    <div class="checkout-billing-area  mt-4">
        <div class="row">
            <div class="m-auto col-md-5 col-lg-5">
                <div class="checkout-customer-info">
                    <div class="cards shadow">
                        <div class="card-header-title">
                            <h5 class="text-center"><strong>Log ind eller Tilmeld for at fortsætte ordren.</strong>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <button @click="goToLogin" class="btn btn-block btn-theme">
                                    Logind nu
                                </button>
                                <button @click="goToRegister" class="btn btn-block btn-theme">
                                    Registrer nu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserLoginRegisterButton",
        props:['productSlug'],
        data() {
            return {}
        }, methods: {
            goToLogin() {
                this.$router.push({name: 'login', query: {redirect: `/checkout/${this.productSlug}`}});
            },
            goToRegister() {
                this.$router.push({name: 'register', query: {redirect: `/checkout/${this.productSlug}`}});
            },
        }
    }
</script>

<style scoped>

</style>
