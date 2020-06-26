<template>
    <div class="page-wrapper wow" id="product_area">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-3">
                    <ProductFilter @filterProduct="eventHandler"></ProductFilter>
                </div>
                <div class="col-md-10 col-lg-9">
                    <div class="main-content">
                        <div class="product-area" v-if="runningProducts.length > 0">
                            <div class="running-products">
                                <div class="alert alert-secondary text-center">
                                    <strong>Kørere Tilbud</strong>
                                </div>
                                <div class="row">
                                    <div
                                        v-for="product in runningProducts"
                                        :key="product.id"
                                        class="col-md-4 bounceInUp wow col-lg-4 col-sm-6 shadow-sm ml-0 pl-0 mr-0 pr-0"
                                    >
                                        <!-- product single  -->
                                        <SingleProduct :product="product"></SingleProduct>
                                        <!-- end of product single  -->
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <a href="" class="btn btn-default"></a>
                                        <router-link class="btn btn-default" :to="{name: 'filter', query: {
                                                                gender: 'all',
                                                                short: 'running_product'
                                                            }}" tag="a">
                                            Vis alle
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-area mt-5" v-if="comingSoonProducts.length > 0">
                            <div class="running-products">
                                <div class="alert alert-secondary text-center">
                                    <strong>Kommende tilbud</strong>
                                </div>
                                <div class="row">
                                    <div
                                        v-for="product in comingSoonProducts"
                                        :key="product.id"
                                        class="col-md-4 bounceInUp wow col-lg-4 col-sm-6 shadow-sm ml-0 pl-0 mr-0 pr-0"
                                    >
                                        <!-- product single  -->
                                        <SingleProduct :product="product"></SingleProduct>
                                        <!-- end of product single  -->
                                    </div>

                                    <div class="col-12 text-center mt-3">
                                        <a href="" class="btn btn-default"></a>
                                        <router-link   class="btn btn-default" :to="{name: 'filter', query: {
                                                                gender: 'all',
                                                                short: 'coming_soon'
                                                            }}" tag="a">
                                            Vis alle
                                        </router-link>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="product-area mt-5" v-if="expiredProducts.length > 0">
                            <div class="running-products">
                                <div class="alert alert-secondary text-center">
                                    <strong>For nylig udløbne tilbud</strong>
                                </div>
                                <div class="row">
                                    <div
                                        v-for="product in expiredProducts"
                                        :key="product.id"
                                        class="col-md-4 bounceInUp wow col-lg-4 col-sm-6 shadow-sm ml-0 pl-0 mr-0 pr-0"
                                    >
                                        <!-- product single  -->
                                        <SingleProduct :product="product"></SingleProduct>
                                        <!-- end of product single  -->
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <a href="" class="btn btn-default"></a>
                                        <router-link  class="btn btn-default" :to="{name: 'filter', query: {
                                                                gender: 'all',
                                                                short: 'expired'
                                                            }}" tag="a">
                                            Vis alle
                                        </router-link>
                                    </div>
                                </div>
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
        name: "SiteIndex",
        components: {
            ProductFilter,
            SubCategoryMenuBar,
            SingleProduct
        },
        data() {
            return {
                errorText: "Loading...",
                isLoading: false,
                products: [],
                runningProducts: [],
                comingSoonProducts: [],
                expiredProducts: [],
            };
        },
        methods: {
            eventHandler(data) {
                this.$router.push({
                    name: 'filter', query: {
                        gender: data.gender,
                        short: data.short,
                        minPrice: data.priceRange[0],
                        maxPrice: data.priceRange[1],
                    }
                });
            },
            getUpcomingProducts() {
                axios.get(`${APP_URL}/api/coming-soon/products`)
                    .then(res => {
                        this.comingSoonProducts = res.data.products;
                        this.isLoading = false;
                    })
            },
            getRunningProducts() {
                axios.get(`${APP_URL}/api/running/products`)
                    .then(res => {
                        this.runningProducts = res.data.products;
                    })
            },
            getExpiredProducts() {
                axios.get(`${APP_URL}/api/expired/products`)
                    .then(res => {
                        this.expiredProducts = res.data.products;
                    })
            },

        },
        created() {
            this.isLoading = true;
            this.getUpcomingProducts();
            this.getRunningProducts();
            this.getExpiredProducts();
        },

    };
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
