<template>
    <div class="page-wrapper wow bounceIn">
        <div class="container">
            <div class="row">
                <div class="col-md-4 m-auto">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <div class="login-form shadow shadow-sm p-5 mt-5">
                        <div class="login-header">
                            <h4>Ændre adgangskode</h4>
                        </div>

                        <div v-if="hasFormError" class="text-center mt-2 mb-2 error invalid-feedback">
                            <b>{{formErrors.text}}</b>
                        </div>

                        <form action="#" id="login" @submit.prevent="submitLoginForm">
                            <div class="form-group">
                                <input required type="text" v-model="form.email" name="email" class="form-control"
                                       placeholder="Indtast din e-mail" id="Email or username">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-0">Nulstil</button>
                            </div>

                            <br>
                            <div class="register text-left">
                                <p>Har du en konto?
                                    <router-link class="theme-color" :to="{name:'login'}">
                                        Logind
                                    </router-link>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "UserResetPassword",
        data() {
            return {
                isLoading: false,
                form: {
                    email: null,
                },
                formErrors: {
                    email: false,
                    text: ''
                },
                redirectUrl: '/',
            }
        },
        methods: {
            submitLoginForm() {
                this.isLoading = true;

                axios.post(`${APP_URL}/api/reset/password`, this.form)
                    .then(response => {
                            this.isLoading = false;
                            if (response.status === 200) {
                                // User.responseAfterLogin(response, this.redirectUrl);
                                Alert.showSuccessAlert('Password reset link has been sent to your Mail.')
                                this.form.email = '';
                            }
                            if (response.status === 400) {
                                Alert.showErrorAlert('No Record Found.')
                            }

                            if (response.status === 422) {
                                Alert.showErrorAlert('No Email Found.')
                            }
                        }
                    )
                    .catch(error => {
                        Alert.showErrorAlert('No Email Found.')
                    })

            },
        },
        created() {
            this.redirectUrl = this.$route.query.redirect;
            if (User.loggedIn()) {
                this.$router.push('/');
            }
        },
        computed: {
            hasFormError() {
                return this.formErrors.text !== '';
            }
        }
    }
</script>

