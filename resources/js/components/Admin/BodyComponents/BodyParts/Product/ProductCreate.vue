<template>
    <div class="row mt-5 pl-2 pr-2 m-0 no-margin">
        <div class="col-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                        <h3 class="kt-portlet__head-title">
                            Add New Prodcut
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <form @submit.prevent="saveFormData">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label">Category Name:</label>
                                <input v-model="formData.name" class="form-control" for="category_name"
                                       type="text">
                            </div>
                            <div class="col-md-6">
                                <label for="categories" class="col-form-label">Select Category:</label>
                                <select v-on:change="getSubCategories" v-model="formData.category_id" id="categories"
                                        class="form-control">
                                    <option>Select Category</option>
                                    <option v-for="category in categories" v-bind:value="category.id">
                                        {{category.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="subCategories" class="col-form-label">Select Sub Category:</label>
                                <select v-model="formData.sub_category_id" id="subCategories" class="form-control">
                                    <option>Select Category</option>
                                    <option v-for="subCategory in subCategories" v-bind:value="subCategory.id">
                                        {{subCategory.name}}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="short_des" class="col-form-label">Short Description:</label>
                                <textarea v-model="formData.short_des" rows="5" cols="5" class="form-control"
                                          id="short_des"
                                          type="text"></textarea>
                            </div>


                            <div class="col-md-12">
                                <label for="full_des" class="col-form-label">Full Description:</label>
                                <textarea v-model="formData.full_des" rows="5" cols="5" class="form-control"
                                          id="full_des"
                                          type="text"></textarea>
                            </div>


                            <div class="col-md-4">
                                <label for="market_price" class="col-form-label">Market Price:</label>
                                <input
                                    v-model="formData.market_price" class="form-control" id="market_price"
                                    type="text" step="2">
                            </div>
                            <div class="col-md-4">
                                <label for="offer_price" class="col-form-label">Offer Price:</label>
                                <input v-model="formData.offer_price" class="form-control" id="offer_price"
                                       type="text">
                            </div>

                            <div class="col-md-4">
                                <label for="last_price" class="col-form-label">Last Price:</label>
                                <input v-model="formData.last_price" class="form-control" id="last_price"
                                       type="text">
                            </div>


                            <div class="col-md-4">
                                <label for="total_spots" class="col-form-label">Total Spots:</label>
                                <input v-model="formData.total_offer_spots" class="form-control"
                                       id="total_spots"
                                       type="text">
                            </div>


                            <div class="col-md-4">
                                <label for="minus_price_user_price" class="col-form-label">Minus Per User:</label>
                                <input v-model="formData.minus_price_user_price" class="form-control"
                                       id="minus_price_user_price"
                                       type="text">
                            </div>

                            <div class="col-md-4">
                                <label for="expire_date" class="col-form-label">Expire
                                    Date:</label>
                                <input v-model="formData.expire_date" class="form-control" id="expire_date"
                                       type="datetime-local">
                            </div>

                            <div class="col-md-12">
                                <label for="product_image" class="col-form-label">Product Image:</label>
                                <div class="text-center m-2" v-if="formData.product_image">
                                    <img :src="formData.product_image" class="img-responsive" width="250px">
                                </div>

                                <input v-on:change="onImageChange" class="form-control" id="product_image"
                                       type="file">
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-12">
                                <input class="btn btn-block btn-primary"
                                       type="submit"
                                       value="Add New Product"
                                >
                            </div>
                        </div>
                    </form>
                    <!--end: Datatable -->

                    <div v-if="errors_exist">
                        <div v-for="error in validationErrors" class="alert alert-outline-danger">
                            {{ error}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductCreate",
        data() {
            return {
                categories: [],
                subCategories: [],
                formData: {
                    name: null,
                    category_id: null,
                    short_des: null,
                    full_des: null,
                    sub_category_id: null,
                    market_price: null,
                    offer_price: null,
                    last_price: null,
                    total_offer_spots: null,
                    minus_price_user_price: null,
                    expire_date: null,
                    product_image: null,
                },
                errors_exist: false,
                formErrors: []
            }
        },
        created() {
            this.getCategories();
        },
        methods: {
            getCategories() {
                axios.get(`${APP_URL}/api/admin/category/`)
                    .then(res => {
                        this.categories = res.data.categories;
                    }).catch(error => {
                    console.error(error)
                })
            },
            getSubCategories() {
                if (this.formData.category_id != null) {
                    axios.get(`${APP_URL}/api/admin/category/${this.formData.category_id}/sub-categories`)
                        .then(res => {
                            this.subCategories = res.data.subCategories;
                        }).catch(error => {
                        console.error(error)
                    })
                }
            },
            // to add a new category
            saveFormData() {
                // add new category
                axios.post(`${APP_URL}/api/admin/product`, this.formData)
                    .then(res => {
                        if (!res.data.errors) {
                            Alert.showSuccessAlert(res.data.message);
                            this.$router.push({name: 'products'})
                        } else {
                            this.errors_exist = true;
                            this.formErrors = res.data.errors || {};
                            Alert.showErrorAlert(res.data.message);
                        }
                    }).catch(error => {
                })
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.formData.product_image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        },
        computed: {
            validationErrors() {
                let errors = Object.values(this.formErrors);
                errors = errors.flat();
                return errors;
            },
        }
    }
</script>

