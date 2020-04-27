<template>
    <div class="page-wrapper wow">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-3 ">
                    <ProductFilter @filterProduct="eventHandler"></ProductFilter>
                </div>
                <div class="col-md-10 col-lg-9">
                    <div class="main-content">
                        <loading :active.sync="isLoading"
                                 :is-full-page="true"></loading>
                        <div v-if="totalProducts" class="product-area">
                            <div class="row">
                                <div v-for="product in products" :key="product.id"
                                     class="col-md-4 bounceIn wow col-lg-4 col-sm-6 shadow-sm ml-0 pl-0 mr-0 pr-0">
                                    <!-- product single  -->
                                    <SingleProduct :product="product"></SingleProduct>
                                    <!-- end of product single  -->
                                </div>

                            </div>
                        </div>
                        <div v-else>
                            <div class="text-center mt-5">
                                <h3 class="big-error-font">
                                    <strong>
                                        No Product Found
                                    </strong>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <infinite-loading :identifier="infiniteId" v-if="hasMorePages" @distance="1"
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
                products: [],
                page: 1,
                lastPage: 2,
                infiniteId: +new Date(),
                query: {
                    gender: 'All',
                    short: 'New',
                    minPrice: 0,
                    maxPrice: 99999,
                }
            }
        },
        methods: {
            eventHandler(data) {
                this.query.gender = data.gender;
                this.query.short = data.short;
                this.query.minPrice = data.priceRange[0];
                this.query.maxPrice = data.priceRange[1];
                this.resetState();
            },
            resetState() {
                this.page = 1;
                this.lastPage = 1;
                this.products = [];
                this.infiniteId += new Date();
            },
            infiniteHandler($state) {
                let vm = this;
                if (this.lastPage >= this.page) {
                    axios.get(`${APP_URL}/api/products?page=` + this.page, {
                        params: {
                            gender: vm.query.gender,
                            short: vm.query.short,
                            minPrice: vm.query.minPrice,
                            maxPrice: vm.query.maxPrice,
                        }
                    })
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
            },
            totalProducts() {
                return this.products.length > 0;
            }
        },

    }
</script>

<style scoped>

    .product-area {
        background: #fafafa;
        padding: 5px;
        min-height: 70vh;
    }


    .big-error-font {
        font-size: 48px;
        color: #3939396b;
        margin-top: 150px !important;
    }
</style>
