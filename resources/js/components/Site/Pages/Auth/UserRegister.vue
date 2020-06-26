<template>
    <div class="page-wrapper wow bounceIn">
        <div class="container">
            <div class="row">
                <div class="col-md-4 m-auto">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <div class="login-form shadow shadow-sm p-5 mt-5">
                        <div class="login-header">
                            <h4>Register</h4>
                        </div>
                        <div class="social-login-button mb-3">
                            <SocialLogin :redirectUrl="redirectUrl"></SocialLogin>
                        </div>
                        <h6 class="mb-2">OR</h6>
                        <div v-if="hasFormError" class="text-center error invalid-feedback mb-3">
                            <b>{{formErrors.text}}</b>

                        </div>

                        <form action="#" id="login" @submit.prevent="submitLoginForm">
                            <div class="form-group">
                                <input required type="text" v-model="form.name" name="name" class="form-control"
                                       placeholder="Fuldenavn">
                            </div>
                            <div class="form-group">
                                <input required type="email" v-model="form.username" name="email" class="form-control"
                                       placeholder="Indtast din e-mail">
                            </div>
                            <div class="form-group">
                                <input required type="password" v-model="form.password"
                                       name="password" class="form-control"
                                       placeholder="Skriv dit kodeord"
                                       minlength="6"
                                       id="password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-0">Register</button>
                            </div>
                            <div class="register text-left">
                                <p>Har du allerede en bruger??
                                    <a href="javascript:void(0)" class="theme-color" @click="goToLogin"> Logind nu</a>
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
    import SocialLogin from "./SocialLogin";
    export default {
        name: "UserLogin",
        components: {
            SocialLogin
        },
        data() {
            return {
                isLoading: false,
                redirectUrl: '/',
                form: {
                    name: null,
                    username: null,
                    password: null
                },
                formErrors: {
                    username: false,
                    password: false,
                    text: ''
                },
            }
        },
        methods: {
            goToLogin() {
                if (this.redirectUrl !== '/') {
                    this.$router.push({name: 'login', query: {redirect: this.redirectUrl}});
                } else {
                    this.$router.push({name: 'login'});
                }
            },

            submitLoginForm() {
                this.isLoading = true;
                if (this.validateForm()) {
                    axios.post(`${APP_URL}/api/register`, this.form)
                        .then(response => {
                            this.isLoading = false;
                            if (response.status === 200) {
                                User.responseAfterLogin(response,this.redirectUrl);
                            }
                            if (response.status === 400) {
                                this.formErrors.text = response.data;
                            }
                        })
                        .catch(error => {
                            console.log(error)
                        })
                }
            },
            validateForm() {
                if (this.form.username && this.form.password) {
                    this.formErrors.username = false;
                    this.formErrors.password = false;
                    return true;
                }
                this.errors = [];
                if (!this.form.username) {
                    this.formErrors.username = true;
                }
                if (!this.form.password) {
                    this.formErrors.password = true;
                }
                return false;
            }
        },
        computed: {
            hasFormError() {
                return this.formErrors.text !== '';
            }
        },
        created() {
            this.redirectUrl = this.$route.query.redirect;
            if (User.loggedIn()) {
                this.$router.push('/');
            }
        }
    }
</script>
