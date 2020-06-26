<template>
    <div class="password-update-form shadow p-4">
        <loading :active.sync="isLoading"
                 :is-full-page="false"></loading>

        <h5>Opdater adgangskode</h5>
        <div v-if="hasError">
            <div>Has Error</div>
        </div>
        <form action="#" class="mt-5" @submit.prevent="updateUserPassword">
            <div class="form-group">
                <label for="new_password">Ny adgangskode</label>
                <input required minlength="5" id="new_password" type="password" class="form-control"
                       v-model="userPassword.newPassword"
                       placeholder="Ny adgangskode">
            </div>
            <div class="form-group">
                <label for="conform_password">Bekræft adgangskode</label>
                <input required id="conform_password" type="password" class="form-control"
                       v-model="userPassword.confirmPassword"
                       placeholder="Bekræft adgangskode">
            </div>
            <div class="form-group text-right">
                <input type="submit" class="btn btn-block btn-success rounded-0"
                       value="Ændre adgangskode">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "UpdateUserPassword",
        data() {
            return {
                userPassword: {
                    newPassword: null,
                    confirmPassword: null,
                },
                hasError: false,
                isLoading: false,
                errorText: null,
            }
        },
        methods: {
            updateUserPassword() {
                if (this.userPassword.newPassword !== this.userPassword.confirmPassword) {
                    Alert.showErrorAlert('Password didn\'t match.')
                } else {
                    this.sendUpdateRequest();
                }
            },
            sendUpdateRequest() {
                this.isLoading = true;
                axios.post(`${APP_URL}/api/user/update/password`, this.userPassword)
                    .then(response => {
                        this.isLoading = false;
                        if (response.data.status === 200) {
                            this.userPassword.newPassword = null;
                            this.userPassword.confirmPassword = null;
                            Alert.showSuccessAlert(response.data.message);
                        } else {
                            Alert.showErrorAlert(response.data.message);
                        }
                    })
                    .catch(error => {
                        Alert.showErrorAlert('Error');
                    })
            }
        }
    }
</script>

<style scoped>

</style>
