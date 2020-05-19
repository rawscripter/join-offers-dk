<template>
    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                 style="background-image: url('/assets/media/bg/bg-2.jpg');" id="loginBackground">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="#">
                                <img src="/assets/media/logos/logo-5.png">
                            </a>
                        </div>
                        <div class="kt-login__signin">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Sign In To Admin</h3>
                            </div>

                            <div v-if="formErrors.text" class="text-center error invalid-feedback">
                                <b>{{formErrors.text}}</b>
                            </div>


                            <form class="kt-form" method="post" v-on:submit.prevent>
                                <div class="input-group">
                                    <input class="form-control" type="text" v-model="form.username"
                                           placeholder="Email"
                                           name="email"
                                           autocomplete="off">
                                    <div v-if="formErrors.username" id="email-error" class="error invalid-feedback">
                                        Please enter a valid email address.
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input class="form-control" type="password" v-model="form.password"
                                           placeholder="Password" name="password">
                                    <div v-if="formErrors.password" id="password-error" class="error invalid-feedback">
                                        This
                                        field is required.
                                    </div>
                                </div>
                                <div class="row kt-login__extra">
                                    <div class="col">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" name="remember"> Remember me
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col kt-align-right">
                                        <a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Forget
                                            Password ?</a>
                                    </div>
                                </div>
                                <div class="kt-login__actions">
                                    <button @click="submitLoginForm"
                                            class="btn btn-brand btn-pill kt-login__btn-primary">Sign In
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="kt-login__signup">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Sign Up</h3>
                                <div class="kt-login__desc">Enter your details to create your account:</div>
                            </div>
                            <form class="kt-form" action="#">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Fullname" name="fullname">
                                </div>
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Email" name="email"
                                           autocomplete="off">
                                </div>
                                <div class="input-group">
                                    <input class="form-control" type="password" placeholder="Password"
                                           name="password">
                                </div>
                                <div class="input-group">
                                    <input class="form-control" type="password" placeholder="Confirm Password"
                                           name="rpassword">
                                </div>
                                <div class="row kt-login__extra">
                                    <div class="col kt-align-left">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" name="agree">I Agree the <a href="#"
                                                                                               class="kt-link kt-login__link kt-font-bold">terms
                                            and conditions</a>.
                                            <span></span>
                                        </label>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_signup_submit"
                                            class="btn btn-brand btn-pill kt-login__btn-primary">Sign Up
                                    </button>&nbsp;&nbsp;
                                    <button id="kt_login_signup_cancel"
                                            class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="kt-login__forgot">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Forgotten Password ?</h3>
                                <div class="kt-login__desc">Enter your email to reset your password:</div>
                            </div>
                            <form class="kt-form" action="#">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Email" name="email"
                                           id="kt_email" autocomplete="off">
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_forgot_submit"
                                            class="btn btn-brand btn-pill kt-login__btn-primary">Request
                                    </button>&nbsp;&nbsp;
                                    <button id="kt_login_forgot_cancel"
                                            class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="kt-login__account">
					<span class="kt-login__account-msg">
						Don't have an account yet ?
					</span>
                            &nbsp;&nbsp;
                            <a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
</template>

<script>
    export default {
        name: "AppLogin",
        data() {
            return {
                form: {
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
            submitLoginForm() {
                if (this.validateForm()) {
                    axios.post(`${APP_URL}/api/login`, this.form)
                        .then(response => {
                            if (response.status === 200) {
                                User.responseAfterLogin(response, '/admin');
                            }
                            if (response.status === 400) {
                                this.formErrors.text = response.data
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
        created() {
            if (User.isAdmin()) {
                this.$router.push('/admin');
            }
        }
    }
</script>

<style scoped>
    #loginBackground {
        height: 100vh;
    }

    .invalid-feedback {
        display: block;
        font-size: 15px;
        margin-left: 10px;
    }
</style>
