<template>
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-4 m-auto">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <div class="login-form shadow shadow-sm p-5 mt-5">
                        <div class="login-header">
                            <h4>Login</h4>
                        </div>
                        <div class="social-login-button mb-3">
                            <button type="button" class="btn btn-primary btn-block"><i class="far fa-facebook"></i>
                                Login with facebook
                            </button>
                            <button type="button" class="btn btn-danger btn-block"><i class="far fa-google-plus"></i>
                                Login with google
                            </button>
                        </div>
                        <h6>OR</h6>

                        <div v-if="hasFormError" class="text-center error invalid-feedback">
                            <b>{{formErrors.text}}</b>
                        </div>
                        <br>
                        <form action="#" id="login" @submit.prevent="submitLoginForm">
                            <div class="form-group">
                                <input type="text" v-model="form.username" name="email" class="form-control"
                                       placeholder="Enter your email" id="Email or username">
                            </div>
                            <div class="form-group">
                                <input type="password" v-model="form.password"
                                       name="password" class="form-control"
                                       placeholder="Enter your password"
                                       id="password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block rounded-0">Login</button>
                            </div>
                            <div class="remember_forger_pass_option d-flex justify-content-between">
                                <label class="checkbox_container">Remember me
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <a href="#">Forget password ?</a>
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
        name: "UserLogin",
        data() {
            return {
                isLoading: false,
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
                this.isLoading = true;
                if (this.validateForm()) {
                    axios.post(`${APP_URL}/api/login`, this.form)
                        .then(response => {
                            this.isLoading = false;
                            if (response.status === 200) {
                                User.responseAfterLogin(response);
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
        }
    }
</script>

<style scoped>
    .login-form {
        text-align: center;
    }

    .login-form h6 {
        margin-bottom: 30px;
        position: relative;
        font-weight: bold;
    }

    .login-form h6:after {
        content: "";
        display: block;
        clear: both;
        background: #cccccc;
        height: 1px;
        width: 44%;
        position: absolute;
        top: 9px;
        left: 7px;
    }

    .login-form h6:before {
        content: "";
        display: block;
        clear: both;
        background: #cccccc;
        height: 1px;
        width: 44%;
        position: absolute;
        top: 9px;
        right: 7px;
    }

    .login-header h4 {
        font-weight: bold;
        margin-bottom: 30px;
    }

    .checkbox_container {
        display: block;
        position: relative;
        padding-left: 30px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 15px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-family: Roboto, sans-serif;
    }

    /* Hide the browser's default checkbox */
    .checkbox_container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: 1px solid #28a745;
    }

    /* On mouse-over, add a grey background color */
    .checkbox_container:hover input ~ .checkmark {
        background-color: #fff;
    }

    /* When the checkbox is checked, add a blue background */
    .checkbox_container input:checked ~ .checkmark {
        background-color: #fff;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .checkbox_container input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .checkbox_container .checkmark:after {
        left: 7px;
        top: 3px;
        width: 5px;
        height: 10px;
        border: solid #28a745;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .invalid-feedback {
        display: block !important;
        font-size: 100%;
    }
</style>
