<template>
    <div class="page-wrapper wow">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-10 m-auto">
                    <div class="main-content">
                        <div class="product-area" v-if="hasProducts">
                            <div class="row">
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
                        <div v-else>
                            <div class="text-center m-100 mt-5">
                                <h3 class="mt-6 big-error-font">
                                    <strong>
                                        Ingen resultater fundet
                                    </strong>
                                    <br>
                                    <router-link class="back-to-home" tag="a" to="/">
                                        Tilbage til forsiden
                                    </router-link>

                                </h3>
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
    import SubCategoryMenuBar from "../Layout/SubCategoryMenuBar";
    import SingleProduct from "../Layout/Product/Loop/SingleProduct";

    export default {
        name: "CustomerReminderProductPage",
        components: {
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
                axios.get(`${APP_URL}/api/reminders-events`)
                    .then(response => {
                        this.isLoading = false;
                        this.lastPage = response.data.lastPage;
                        $.each(response.data.products, function (key, value) {
                            let found = false;
                            for (let i = 0; i < vm.products.length; i++) {
                                if (vm.products[i].id === value.id) {
                                    found = true;
                                    break;
                                }
                            }

                            if (!found) {
                                vm.products.push(value);
                            }
                        });
                        $state.loaded();
                    });
                this.page = this.page + 1;
            },
        },
        created() {
            this.isLoading = true;
        },
        computed: {
            hasMorePages() {
                return this.lastPage >= this.page;
            },
            hasProducts() {
                return this.products.length > 0;
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

    .big-error-font {
        font-size: 48px;
        color: #3939396b;
        margin-top: 150px !important;
    }

    .page-wrapper.wow {
        overflow: hidden;
    }

    .back-to-home {
        font-size: 19px;
        font-weight: bold;
        text-decoration: underline;
        color: #3939396b;
        transition: 0.3s;
        font-family: 'Dosis', sans-serif;
    }

    .back-to-home:hover {
        color: #ea782a;
    }
</style>
