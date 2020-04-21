<template>
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-3">
                    <ProductFilter></ProductFilter>
                </div>
                <div class="col-md-10 col-lg-9">

                    <div class="main-content">
                        <div class="product-area">
                            <div class="row wow">
                                <loading :active.sync="isLoading"
                                         :is-full-page="false"></loading>

                                <div v-for="product in products" :key="product.id"
                                     class="col-md-4 bounceInUp wow col-lg-4 col-sm-6 shadow-sm ml-0 pl-0 mr-0 pr-0">
                                    <!-- product single  -->
                                    <SingleProduct :product="product"></SingleProduct>
                                    <!-- end of product single  -->
                                </div>

                            </div>
                        </div>
                    </div>

                    <infinite-loading v-if="hasMorePages" @distance="1"
                                      @infinite="infiniteHandler"></infinite-loading>

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
        name: "SiteIndex",
        components: {
            ProductFilter,
            SubCategoryMenuBar,
            SingleProduct
        },
        data() {
            return {
                isLoading: false,
                page: 1,
                products: [],
                lastPage: 2,
            }
        },
        methods: {
            infiniteHandler($state) {
                let vm = this;
                if (this.lastPage >= this.page) {
                    axios.get(`${APP_URL}/api/products?page=` + this.page)
                        .then(response => {
                            this.isLoading = false;
                            this.lastPage = response.data.lastPage;
                            $.each(response.data.products, function (key, value) {
                                vm.products.push(value);
                            });
                            $state.loaded();
                        });
                }
                this.page = this.page + 1;
            },

        },
        created() {
            this.isLoading = true;
            // this.getProducts();
        },
        computed: {
            hasMorePages() {
                return this.lastPage >= this.page;
            }
        }
    }
</script>

<style scoped>
    .padding-top-30 {
        padding-top: 30px;
    }

    .product-area {
        background: #fafafa;
        padding: 5px;
        min-height: 50vh;
    }
</style>
