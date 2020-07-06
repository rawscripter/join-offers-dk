<template>
  <div class="page-wrapper wow bounceIn">
    <div class="container">
      <div class="row">
        <div class="col-md-4 m-auto">
          <loading :active.sync="isLoading" :is-full-page="false"></loading>
          <div class="login-form shadow shadow-sm p-5 mt-5">
            <div class="login-header">
              <h4>Login</h4>
            </div>

            <div class="social-login-button mb-3">
              <SocialLogin :redirectUrl="redirectUrl"></SocialLogin>
            </div>
            <h6 class="mb-3">OR</h6>

            <div v-if="hasFormError" class="text-center mt-2 mb-2 error invalid-feedback">
              <b>{{formErrors.text}}</b>
            </div>

            <form action="#" id="login" @submit.prevent="submitLoginForm">
              <div class="form-group">
                <input
                  required
                  type="text"
                  v-model="form.username"
                  name="email"
                  class="form-control"
                  placeholder="Indtast din e-mail"
                  id="Email or username"
                />
              </div>
              <div class="form-group">
                <input
                  required
                  type="password"
                  v-model="form.password"
                  name="password"
                  class="form-control"
                  placeholder="Skriv dit kodeord"
                  id="password"
                />
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-block rounded-0">Log ind</button>
              </div>
              <div class="remember_forger_pass_option d-flex justify-content-between">
                <label class="checkbox_container">
                  Husk mig
                  <input type="checkbox" />
                  <span class="checkmark"></span>
                </label>
                <router-link :to="{name:'reset-password'}" class="theme-color">Glem adgangskode ?</router-link>
              </div>
              <br />
              <div class="register text-left">
                <p>
                  Har ikke en konto?
                  <a
                    href="javascript:void(0)"
                    class="theme-color"
                    @click="goToRegister"
                  >Registrer nu</a>
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
      form: {
        username: null,
        password: null
      },
      formErrors: {
        username: false,
        password: false,
        text: ""
      },
      redirectUrl: "/"
    };
  },
  methods: {
    goToRegister() {
      if (this.redirectUrl !== "/") {
        this.$router.push({
          name: "register",
          query: { redirect: this.redirectUrl }
        });
      } else {
        this.$router.push({ name: "register" });
      }
    },
    submitLoginForm() {
      this.isLoading = true;
      if (this.validateForm()) {
        axios
          .post(`${APP_URL}/api/login`, this.form)
          .then(response => {
            this.isLoading = false;
            if (response.status === 200) {
              User.responseAfterLogin(response, this.redirectUrl);
            }
            if (response.status === 400) {
              this.formErrors.text = response.data;
            }
          })
          .catch(error => {
            console.log(error);
          });
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
    this.redirectUrl = this.$route.query.redirect;
    if (User.loggedIn()) {
      this.$router.push("/");
    }
  },
  computed: {
    hasFormError() {
      return this.formErrors.text !== "";
    }
  }
};
</script>

