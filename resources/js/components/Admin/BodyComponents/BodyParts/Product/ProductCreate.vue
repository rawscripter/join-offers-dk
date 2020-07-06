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
                            Add New Product
                        </h3>


                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <form @submit.prevent="saveFormData">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label">Product Name:</label>
                                <input required v-model="formData.name" class="form-control" for="category_name"
                                       type="text">
                            </div>
                            <div class="col-md-6">
                                <label for="categories" class="col-form-label">Select Category:</label>
                                <select required v-on:change="getSubCategories" v-model="formData.category_id"
                                        id="categories"
                                        class="form-control">
                                    <option>Select Category</option>
                                    <option v-for="category in categories" v-bind:value="category.id">
                                        {{category.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="subCategories" class="col-form-label">Select Sub Category:</label>
                                <select required v-model="formData.sub_category_id" id="subCategories"
                                        class="form-control">
                                    <option>Select Category</option>
                                    <option v-for="subCategory in subCategories" v-bind:value="subCategory.id">
                                        {{subCategory.name}}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="short_des" class="col-form-label">Short Description:</label>
                                <textarea required v-model="formData.short_des" rows="5" cols="5" class="form-control"
                                          id="short_des"
                                          type="text"></textarea>
                            </div>


                            <div class="col-md-12">
                                <label for="full_des" class="col-form-label">Full Description:</label>

                                <ckeditor :editor="editor" v-model="formData.full_des"
                                          :config="editorConfig"></ckeditor>
                            </div>


                            <div class="col-md-12">
                                <label class="col-form-label">Ordrenotat:</label>
                                <ckeditor :editor="editor" v-model="formData.order_note"
                                          :config="editorConfig"></ckeditor>
                            </div>

                            <div class="col-md-4">
                                <label for="market_price" class="col-form-label">Market Price:</label>
                                <input required
                                       v-model="formData.market_price" class="form-control" id="market_price"
                                       type="text" step="2">
                            </div>
                            <div class="col-md-4">
                                <label for="offer_price" class="col-form-label">Offer Price:</label>
                                <input required v-model="formData.offer_price" class="form-control" id="offer_price"
                                       type="text">
                            </div>

                            <div class="col-md-4">
                                <label for="last_price" class="col-form-label">Last Price:</label>
                                <input required v-model="formData.last_price" class="form-control" id="last_price"
                                       type="text">
                            </div>
                            <div class="col-md-4">
                                <label for="Join_price" class="col-form-label">Join Price (%):
                                    <strong>({{formData.join_price}}dkk)</strong></label>
                                <input required v-model="formData.join_price_percentage" class="form-control"
                                       id="Join_price"
                                       type="text">
                            </div>


                            <div class="col-md-4">
                                <label for="total_spots" class="col-form-label">Total Spots:</label>
                                <input required v-model="formData.total_offer_spots" class="form-control"
                                       id="total_spots"
                                       type="text">
                            </div>


                            <div class="col-md-4">
                                <label for="minus_price_user_price" class="col-form-label">Minus Per User:</label>
                                <input required v-model="formData.minus_price_user_price" class="form-control"
                                       id="minus_price_user_price"
                                       readonly
                                       type="text">
                            </div>

                            <div class="col-md-4">
                                <label for="max_unit_per_user" class="col-form-label">Maximum Order Unit Per
                                    User:</label>
                                <input required v-model="formData.max_unit_per_user" class="form-control"
                                       id="max_unit_per_user"
                                       type="text">
                            </div>

                            <div class="col-md-4">
                                <label for="offer_start_date" class="col-form-label">Offer Start
                                    Date:</label>
                                <input required v-model="formData.offer_start_date" class="form-control"
                                       id="offer_start_date"
                                       type="datetime-local">
                            </div>
                            <div class="col-md-4">
                                <label for="expire_date" class="col-form-label">Expire
                                    Date:</label>
                                <input required v-model="formData.expire_date" class="form-control" id="expire_date"
                                       type="datetime-local">
                            </div>
                            <div class="col-md-4">
                                <label for="xxxx" class="col-form-label">Product Type:</label>
                                <select v-model="formData.product_type" name="" class="form-control" id="xxxx"
                                        multiple="multiple">
                                    <option v-for="type in productTypes" :value="type">{{type}}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="product_image" class="col-form-label">Product Image:</label>
                                <div class="text-center m-2" v-if="formData.product_image">
                                    <img :src="formData.product_image" class="img-responsive" width="250px">
                                </div>

                                <input required v-on:change="onImageChange" class="form-control" id="product_image"
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
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        name: "ProductCreate",

        data() {
            return {
                productTypes: [
                    'All',
                    'Men',
                    'Women',
                    'Kids',
                ],
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the rich-text editor.
                },
                categories: [],
                subCategories: [],
                newProductVariation: null,
                formData: {
                    name: null,
                    category_id: null,
                    short_des: null,
                    order_note: null,
                    full_des: null,
                    sub_category_id: null,
                    market_price: 0,
                    join_price: 0,
                    join_price_percentage: 0,
                    offer_price: 0,
                    last_price: 0,
                    total_offer_spots: 1,
                    minus_price_user_price: 0,
                    expire_date: null,
                    offer_start_date: null,
                    product_image: null,
                    product_type: [],
                    product_variation: []
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
                axios.get(`${APP_URL}/api/admin/category`)
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
                // add new product
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
        },
        watch: {
            'formData.offer_price'(price) {
                let joinPrice = (price * this.formData.join_price_percentage) / 100;
                this.formData.join_price = joinPrice.toFixed(2);

                // to set the price
                let minusPrice = ( price - this.formData.last_price ) / this.formData.total_offer_spots;
                this.formData.minus_price_user_price = minusPrice.toFixed(2);
            },
            'formData.join_price_percentage'(percentage) {
                let joinPrice = (this.formData.offer_price * percentage) / 100;
                this.formData.join_price = joinPrice.toFixed(2);
            },
            'formData.total_offer_spots'(spot) {
                let minusPrice = (this.formData.offer_price - this.formData.last_price) / spot;
                this.formData.minus_price_user_price = minusPrice.toFixed(2);
            }
        }
    }
</script>

<style>
    .active {
        display: block;
    }
</style>

