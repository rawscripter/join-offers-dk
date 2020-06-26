<template>
    <div class="main-profile-update shadow p-4">
        <h5>Opdater profiloplysninger</h5>
        <hr>
        <form action="#" @submit.prevent="updateUserInfo">
            <div class="form-group">
                <label for="f_name">E-mail</label>
                <input required v-model="userInfo.email" readonly id="email" type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="f_name">Fuldenavn</label>
                <input required v-model="userInfo.name" id="f_name" type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="phone">Telefonnummer</label>
                <input required v-model="userInfo.phone" id="phone" type="text" class="form-control" name="phone">
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <textarea required v-model="userInfo.address" name="address" id="address"
                          class="form-control"></textarea>
            </div>
             <div class="form-group">
                <label for="zip_code">Postnummer</label>
                <input v-model="userInfo.zip_code" id="zip_code" type="text" class="form-control" name="zip">
            </div>

            <div class="form-group">
                <label for="city">By</label>
                <input v-model="userInfo.city" id="city" type="text" class="form-control" name="city">
            </div>
           
            
            <div class="form-group">
                <label for="companyName">Firmavan (Kun for virksomheder)</label>
                <input id="companyName" v-model="userInfo.company_name" type="text" class="form-control" name="company">
            </div>

            <div class="form-group">
                <label for="cvrNum">CVR nummer (Kun for virksomheder)</label>
                <input id="cvrNum" v-model="userInfo.cvr_number" type="text" class="form-control" name="cvr">
            </div>
            <div class="form-group">
                <label for="eanNum">CVR nummer (Kun for virksomheder)</label>
                <input id="eanNum" v-model="userInfo.ean_number" type="text" class="form-control" name="ean">
            </div>

            <div class="form-group text-right">
                <input type="submit" class="btn btn-block btn-success rounded-0"
                       value="Opdater">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CustomerProfileInfo",
        data() {
            return {
                userInfo: {
                    name: null,
                    company_name: null,
                    cvr_number: null,
                    ean_number: null,
                    address: null,
                    city: null,
                    zip_code: null,
                    phone: null,
                },
                isLoading: false,
            }
        },
        methods: {
            updateUserInfo() {
                this.isLoading = true;
                axios.post(`${APP_URL}/api/user/update/info`, this.userInfo)
                    .then(response => {
                        this.isLoading = false;
                        if (response.data.status === 200) {
                            Alert.showSuccessAlert(response.data.message);
                        } else {
                            Alert.showErrorAlert(response.data.message);
                        }
                    })
                    .catch(error => {
                        Alert.showErrorAlert('Error');
                    })
            },

            getUserInfo() {
                this.isLoading = true;
                axios.get(`${APP_URL}/api/user/get/info`)
                    .then(response => {
                        this.isLoading = false;
                        this.userInfo = response.data
                    })
                    .catch(error => {
                        Alert.showErrorAlert('Error');
                    })
            },
        },
        created() {
            this.getUserInfo();
        }
    }
</script>

<style scoped>

</style>
