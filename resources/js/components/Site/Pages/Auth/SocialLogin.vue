<template>
  <div>
      <button @click="AuthProvider('github')" class="btn btn-theme btn-block">Login with Github</button>
      <button type="button" class="btn btn-theme btn-block"><i class="fab fa-facebook-f"></i>
          Login with facebook
      </button>
      <button type="button" class="btn btn-theme btn-block"><i class="fab fa-google"></i>
          Login with google
      </button>
  </div>
</template>

<script>
    export default {
        name: "SocialLogin",
        props: ['redirectUrl'],
        methods: {
            AuthProvider(provider) {
                var self = this
                this.$auth.authenticate(provider).then(response => {
                    self.SocialLogin(provider, response)
                }).catch(err => {
                    console.log({err: err})
                })
            },

            SocialLogin(provider, response) {
                this.$http.post('/sociallogin/' + provider, response).then(response => {
                    User.responseAfterLogin(response, this.redirectUrl);
                }).catch(err => {
                    console.log({err: err})
                })
            },
        }
    }
</script>

<style scoped>

</style>
