<template>
    <div>
        <div v-if="productRequestModal" class="modal fade bd-example-modal-sm show"
             tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel"
             :class="productRequestModal?'active':''"
             style="margin-right: 0rem;">
            <div class="modal-dialog" style="margin-top: 100px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productRequestModals">Anmodning om favorit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span @click="productRequestModal=false" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submitProductRequest">
                            <div class="form-group">
                                <label for="product">E-mail:</label>
                                <input type="email" required v-model="productRequest.email" class="form-control"
                                       id="product">
                            </div>

                            <div class="form-group">
                                <label for="note">Bemærk:</label>
                                <textarea v-model="productRequest.note" class="form-control" id="note" cols="10"
                                          rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-theme btn-block">Indsend anmodning</button>
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
        name: "SiteModals",
        data() {
            return {
                productRequestModal: false,
                product: null,
                productRequest: {
                    email: null,
                    note: null,
                    type: 'favourite'
                }
            }
        },
        methods: {
            submitProductRequest() {
                axios.post(`/api/product/${this.product.slug}/make/request`, this.productRequest)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.productRequestModal = false;
                            Alert.showSuccessAlert(res.data.message);
                            this.productRequest.email = null;
                            this.productRequest.note = null;
                        } else {
                            alert(res.data.message);
                        }
                    }).catch(err => console.log(err));
            },
        },
        mounted() {
            this.$root.$on('callProductRequestModal', (product) => {

                this.product = product;
                this.productRequestModal = true;
            })
        }

    }
</script>

<style scoped>
    .active {
        display: block;
    }
</style>
