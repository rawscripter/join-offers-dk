<template>
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-3">
                    <ProductFilter></ProductFilter>
                </div>
                <div class="col-md-10 col-lg-9" style="background:#fff">
                    <div class="main-content">
                        <SubCategoryMenuBar :categorySlug="categorySlug"
                                            :subCategories="subCategories"></SubCategoryMenuBar>
                        <div class="product-area" v-if="totalProducts">
                            <div class="row">
                                <loading :active.sync="isLoading"
                                         :is-full-page="false"></loading>
                                <div v-for="product in products" :key="product.id"
                                     class="col-md-4 col-lg-4 col-sm-6 shadow-sm ml-0 pl-0 mr-0 pr-0">
                                    <!-- product single  -->
                                    <SingleProduct :product="product"></SingleProduct>
                                    <!-- end of product single  -->
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="text-center mt-5">
                                <h3>
                                    <strong>
                                        No Product Found
                                    </strong>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import ProductFilter from "../SideBar/ProductFilter";
    import SubCategoryMenuBar from "../Layout/SubCategoryMenuBar";
    import SingleProduct from "../Layout/Product/Loop/SingleProduct";

    export default {
        name: "CategoryProducts",
        components: {
            ProductFilter,
            SubCategoryMenuBar,
            SingleProduct,
        },
        data() {
            return {
                isLoading: false,
                products: [],
                subCategories: [],
                categorySlug: null
            }
        },
        methods: {
            getCategoryProducts(categorySlug) {
                axios.get(`${APP_URL}/api/category/${categorySlug}/products`)
                    .then(res => {
                        this.isLoading = false;
                        this.products = res.data.products;
                    }).catch(error => {
                    console.error(error)
                })
            },
            getSubCategoryProducts(subCategorySlug) {
                axios.get(`${APP_URL}/api/sub-category/${subCategorySlug}/products`)
                    .then(res => {
                        this.isLoading = false;
                        this.products = res.data.products;
                    }).catch(error => {
                    console.error(error)
                })
            },

            getSubCategories(categorySlug) {
                axios.get(`${APP_URL}/api/category/${categorySlug}/sub-categories`)
                    .then(res => {
                        this.subCategories = res.data.subCategories;
                    }).catch(error => {
                    console.error(error)
                })
            },
        },
        computed: {
            totalProducts() {
                return this.products.length > 0;
            }
        },
        created() {

            this.categorySlug = this.$route.params.category;
            this.getSubCategories(this.$route.params.category);

            if (this.$route.params.category && !this.$route.params.subCategory) {
                this.getCategoryProducts(this.$route.params.category);
            }
            if (this.$route.params.subCategory) {
                this.getSubCategoryProducts(this.$route.params.subCategory);
            }
            this.isLoading = true;
        }
    }
</script>

<style scoped>

</style>
