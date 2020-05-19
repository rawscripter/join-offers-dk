<template>
    <div class="page-wrapper wow bounceIn">
        <div class="container">
            <div class="row">
                <div class="col-md-4 m-auto">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <div class="login-form shadow shadow-sm p-5 mt-5">
                        <div class="login-header">
                            <h4>Reset Password</h4>
                        </div>

                        <div v-if="hasFormError" class="text-center mt-2 mb-2 error invalid-feedback">
                            <b>{{formErrors.text}}</b>
                        </div>

                        <form action="#" id="login" @submit.prevent="submitLoginForm">
                            <div class="form-group">
                                <input required type="text" v-model="form.email" name="email" class="form-control"
                                       placeholder="Enter your email" id="Email or username">
                            </div>

                            <div class="form-group">
                                <input required type="password" v-model="form.password" name="password"
                                       class="form-control"
                                       placeholder="Enter your Password">
                            </div>
                            <div class="form-group">
                                <input required type="password" v-model="form.password_confirmation"
                                       name="confirmPassword"
                                       class="form-control"
                                       placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-0">Change Password
                                </button>
                            </div>

                            <br>
                            <div class="register text-left">
                                <p>Have an account?
                                    <router-link class="theme-color" :to="{name:'login'}">
                                        Login
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
        name: "UserChangePassword",
        data() {
            return {
                isLoading: false,
                form: {
                    email: null,
                    password: null,
                    password_confirmation: null,
                    token: null,
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

                axios.post(`${APP_URL}/api/confirm/password`, this.form)
                    .then(response => {
                            this.isLoading = false;
                            if (response.status === 200) {
                                Alert.showSuccessAlert(response.data.message)
                                setTimeout(function () {
                                    User.responseAfterLogin(response);
                                }, 500)
                            }
                            if (response.status === 400) {
                                Alert.showErrorAlert(response.data.message)
                            }

                            if (response.status === 422) {
                                Alert.showErrorAlert(response.data.message)

                            }
                        }
                    )
                    .catch(error => {
                        Alert.showErrorAlert(response.data.message)
                    })

            },
        },
        created() {
            this.form.email = this.$route.query.email;
            this.form.token = this.$route.params.token;
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

